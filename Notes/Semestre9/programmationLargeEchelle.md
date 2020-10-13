# Programmation Large Échelle



[Site du prof](https://www.labri.fr/perso/auber/BigDataGL/index.html)



## Pour les td

Installation particulière en 203 (data node)

* Allumer les machines à distance (site du cremi > service numérique > démarrage à distance)
* Les machines s'éteignent au bout de 5 min, script pour rester connecter `/espace/Auber_PLE-203/run_xtems.sh` (il faut s'être connécté avec -X)

Redirection de port avec ssh, peut être utile dans certain td : `ssh -L 50070:localhost:50070 -J <login>@jaguar.emi.u-bordeaux.fr <login>@data`



Les principes d'un system big data:

1. Robustness and fault-tolerance (especially human-fault tolerant)
2. Low latency reads and updates
3. Scalability
4. Generalization
5. Extensibility
6. Ad hoc queries
7. Minimal maintenance
8. Debuggability



Master Dataset: L'idée c'est de ne pas modifier les données :

1. Data is raw
2. Data is immutable
3. Data is eterally true



Fact-based Model : A fact is atomic and timestamped

1. Queryable at any time in its history
2. Tolerant to human errors
3. handles partial information
4. Advantages of both normalized and denormalized from



Storage requirements

1. Efficient appends of new data
2. Scalable storage
3. Support for parallel processing
4. Tunability
5. Enforce immutability

*HDFS* Garantit tout ça.

Batch view : Extraction de données du Master Dataset. Les batch views sont créés par le Batch Layer. C'est un truc qui tourne tout le temps pour générer les batch layers. Les Serving Layer contiennent des batch view, ils représentent un service pour le client. C'est eux qui vont recevoir les requêtes, et y répondre.



Donc, quand on a une nouvelle donnée, deux possibilitées. Soit on l'ajoute dans le master dataset, et le batch doit reparcourire tout le master dataset. Soit on l'ajoute directement dans le batch pour générer une nouvelle view.

On préfèrera la première option. Ce que ça apporte, c'est d'être plus tolérant aux erreurs. Il suffit de relancer le calcul, plutot que réfléchir pour mettre à jour (exemple de la moyenne, formule différente quand on met à jour). On va utiliser la permière option, avec Map Reduce.



C'est moins performant, mais fiable et facile.



### Serving Layer : (ElephantDB, *HBase*, Cassandra)

Role : Provide fast random access to the batch views

1. Batch writable
2. Scalable (la taille des données dans le batch view peut évoluer)
3. Random reads 
4. Fault-tolerant
5. No random writes !



Il existe des évolutiosn de cette architecture : *Lambda architecture*

On ajoute le speed layer, qui en temps réel fabrique des view (real time view), qui ne seront calculée qu'à partir du speed layer, pas du master dataset. Le serving layer va donc merge les batch view, et l'information partielle stockée dans les real-time view..



### Speed layer 

Role : Compensate the batch layer update latency.

Storage requirements :

1. random reads
2. random writes
3. scalability
4. fault tolerance 

Tout ce qui est dans le speed layer va être recalculé dans le master dataset. Le speed layer utilise donc du nosql



* Master Dataset : HDFS
* Calcul: Map/reduce, puis spark
* Speed layer: Spark streaming
* Serving layer: HBase



## Hadoop

### HDFS

Tout est orienté sur le débit. Le but, c'est de lire le plus rapidement les données. Fonctionne par block de 128Mo. 



```java
public class MonApplication {
    public static class MonProg extends Configured implements Tool {
        public int run(String[] args throws Exception) {
            // Code du programme ici
            return 0;
        }
    }
    
    public static void main(String[] args) throws Exception {
        ToolRunner.run(new MonApplication.MonProg(), args);
    }
}
```

On lance avec `hadoop jar MonAplication.jar args...` Le classe *Configured* permet de récupérer la configuration du serveur automatiquement. Ce programme est appelé un *Driver*. On peut l'envoyer sur une machine du cluster, mais il peut aussi rester sur la machine avec un mode hybride. Avec MapReduce, on enverra le programme sur toutes les machines du cluster.

### Exemple - Copie de fichier

```java
public int run(String[] args) throws Exception {
    String localInputPath = arg1[0];
    URI uri = new URI(args[1]);
    uri = uri.normalize();
    
    Configuration conf = getConf();
    FileSystem fs = FileSystem.get(uri, conf, "hadoop");
    Path outputPath = new Path(uri.getPath());
    
    OutputStream os = fs.create(outputPath);
    InputSteam is = new BufferedInputStream(new FileInputStream(localInputPath));
    IOUtils.copyBytes(is, os, conf);
    os.close();
    is.close();
    
    return 0;
}
```



## Map/Reduce



Par exemple pour la recherche d'un mot dans un fichier, comme le fichier est découpé en bloc de taille fixe, partagés sur différentes machines, on peut lancer les recherche en parallèle sur chaque bloc. Au lieux d'être en $\mathcal{O}(n) $, on est en $\mathcal{O}(n/nb \_bloc)$.

Pour pouvoir faire ce type de calcul parallèle, il faut simplement deux opérations : 

1.  $map$, qui permet d'appliquer une opération sur les fichiers. C'est pas exactement le même map qu'en fonctionnel. Il y a trois étapes : 
   1. L'initialisation : Avant de lire le bloc, on peut faire ce qu'on veut.
   2. Le Mapper : Il reçoit les lignes du fichiers, doit renvoyer des couples `<key, value>`. On peut renvoyer autant de couple qu'on veut par ligne.
   3. Le cleanup : la fin des opérations.
2. $reduce$, qui récupère ce qui est calculé par l'opération map.

Avant que le reduce ne récupère les couples générés par le Mapper, on a le *shuffling*. Il fait un *group by key* de tous les messages.



On peut faire un reduce à la fin des mapper pour moins utiliser le réseau. C'est ce qu'on appel les *Combiner*.



Read, Map, Combine, Shuffle, Reduce, Write



Ces différents éléments ont les noms suivant dans hadoop : 

* Le reader : appelé *InputFormat*
* map : *Mapper*
* combine: *Combiner*
* shuggling: *Partitionner*
* reduce: *Reducer*
* writer: *OutputFormat*

Ou peut suivre l'exécution des jobs avec YARN via l'interface web :8088

### Writable

Hadoop utilise son propre système de type. Ces types sont des surcouches qui permettent de sérialiser/deserialiser sur le réseau. On peut bien sure créer nos propre types. Il suffet d'étendre de `Writable`.

Il faut les deux méthodes suivantes : 

```java
public void write(DataOutput out) throws IOException;
public void readFields(DataInput in) throws IOException;
```

Il faut bien penser à lire dans l'ordre dans lequel on a envoyé les champs. Sinon, inversion des valeurs. Il n'y a pas de vérification par hadoop.



### Combiner

Les combiners sont des reducer, mais qui tirent partie de la scalabilité horizontale. Ils sont présents à la sorti du mapper sur un bloc.

### Distributed Cache

Il est possible de partager un fichier entre les différentes machines.

```java
public static class AMapper extends Mapper<KeyIn, ValueIn, KeyOut, ValueOut> {
    protected void setup(Context context) {
        URI[] files ) context.getCacheFiles(context.getConfiguration());
        DataInputStream strm = new DataInputStream(new FileInputStream(files[0].getPath()));
        MyDataWritable data = new MyDataWritables();
        data.readFields(strm);
        strm.close();
    }
}
```

On verra des exemples en td.



### Modèle de Partionner



```java
public abstract class Partitioner<KEY, VALUE> {
    public abstract int getPartition(KEY key, VALUE value, int numPartitions);
}

public class HashPartitioner<K, V> extends Partitioner<K, V> {
    public int getPartition(K key, V value, int numReduceTasks) {
        return (key.hashCode() & Integer.MAX_VALUE) % numReduceTasks;
    }
}
```

On peut avoir un nombre de reducer variable. Mais alors il faut équilibrer la charge entre nos différents reducer. C'est la que le partionner intervient. Imaginons qu'on fasse une opération sur des lettres. On a par exemple bien plus de *e* que de *z*. On peut donc utiliser cette information pour mieux utiliser nos différents reducers.



> Petit devoir sur Map Reduce ! L'objectif, c'est de faire un truc qui compile et qui marche, histoire d'avancer.



### Input format

Ce qu'on fesait pour le moment, c'était utiliser un *FileInputFormat*. Ça nous permet de recevoir dans le mapper les lignes d'un fichier. Mais on ne va pas toujours vouloire travailler avec des fichiers en entrée. 

Un InputFormat, ça génère les inputSplits, il construit le recordReader. Le recordReader, il reçoit les inputSplit et il créé les couples clef/valeurs pour le mapper.

L'inputsplit représente les sous-ensemble de données qui sront traitées par un unique Mapper. Il donne une vue binaire des données, c'est au recordreader de donner une vue clé/valeur aux données.

FileSplit est l'inputSplit par défaut. Il positionne la variable mapreduce.map.input.file sur le path du fichier découpé.

Le recordReadr lit des <key, value> à partir de l'inputsplit. Généralement, le recordreader convertit les données de l'inputsplit pour qu'elles puissent être traitées par les mappers. Il a donc la responsabilité de redécouper les inputsplit en bloc keys and values. Mais on peut générer autre chose.



#### Exemple inputFormat : Pi

Méthode de Monté Carlo: On tire un des pints au  hasard dans le quart de cercle supérieur. Pour chaque point, on test s'il est dans le cercle $x^2 + y^2 < 1$. Le ratio entre le nombre de points dans le cercle et celui en dohors du cercle est égal à $\frac{\pi}{4}$. Pour gagner en précision, il faut tirer énormément de points.



Un première méthode : On génère des points avec notre inputFormat, puis à chaque fois si un point est dans p, on incrémente un compteur. Pas très opti, car on génère les points sur une machine, puis on les balances sur le réseau pour les envoyer sur les datanodes.



> Le nombre de reducer, c'est le nombre de fichier part-r-000 à la fin. Si on a des gigas de données, mais qu'on seul reducer, on a un reducer qui va se tapper les 100Go, il faut donc que le nombre de reducer soit proportionnel.



### Output format

Il décrit les sorties d'un job MapReduce. Il fournit un RecordWriter, utilisé pour écrire <key, value> dans la sortie.

Exemple de format existant:

1. SequenceFileInputFormat/SequenceFileOutputFormat: Format binaire de stockage <key, value>, beaucoup plus performant que le format texte. A privilégier pour stocker les données dans HDFS.
2. TableOuputFormat/TableInputFormat: Format d'entrée sortie poru lire et écrire dans la base de données NoSQL HBase fournit dans l'écosystème hadoop.
3. DBInputFormat/DBOuputFormat : Format d'entrée sortie vers des bases de données SQL.



## Patterns

### Résumé

Ce pattern simple conciste à envoyer un *résumé* des informations aux reducers, c'est à dire un couple `<clé, résuméTemporaire>`. Les reducers s'occupent de faire le calcul finale. Ça fonctionne bien pour des trucs style moyennes, max, min. Mais dans certain cas ce n'est pas possible de faire un résumé, par exemple dans le cas de la médiane. Dans ce cas les mappers *compressent* les données, avec par exemple un histogramme.



### Filtrage

#### Simple

Le mapper peut être utilisé directement comme un filtre. Il suffit de ne pas renvoyer les `<key, value>` qu'on ne veut pas garder. Ni besoin de combiner, ni de reducer pour ce type de filtrage simple. 



#### Top K

On veut sélectionner les K plus grands/petits/... éléments d'un ensemble. On attends de tout recevoir, puis dans le cleanup on envoit les données intéressantes



#### Element distinct

Pour supprimer les doublons, il suffit de tirer parti du *shuffling* réalisé par hadoop.

```java
public static class DistincMapper extends Mapper<Object, Text, Text, NullWritable> {
    public void Map(Object key, Text value, Context context) throws Exception {
        context.write(value, NullWritable.get());
    }
}

public static class DistinctReducer extends Reducer<Text, NullWritable, Text, NullWritable> {
    public void reduce(Text key, Iterable<NullWritable> values, Context context) throws Exception {
        context.write(key, NullWritable.get());
    }
}
```



### Jointures

(voire diapo du prof, y'a des jolies shémas)



Pour pouvoir faire ces jointures dans hadoop, nous allons utiliser les **Multiple InputFormat**.

```java
public static void main(String[] args) throws Exception {
    Configuration conf = getConf();
    Job job = Job.getInstance(conf, "MultipleInputExemple");
    job.setJarByClass(PostCommentBuildingDriver.class);
    
    MultipleInputs.addInputPath(
    	job,
    	new Path(args[0], InputFormat1.class, MapperA.class)
    );
    
    MultipleInputs.addInputPath(
    	job,
    	new Path(args[1], InputFormat2.class, MapperB.class)
    );
    
    MultipleInputs.addInputPath(
    	job,
    	new Path(args[2], InputFormat3.class, MapperC.class)
    );
    
    job.setReducerClass(Reducer.class);
    job.setOutputFormatClass(OutputFormat.class);
    TextOutputFormat.setOutputPath(job, new Path(args[N + 1]));
    job.setOutputValueClass(Text.class);
    job.setOutputValueClass(Text.class);
    
    System.exit(job.waitForCompletion(true)? 0:2);
}
```



#### Reduce side join

Le principe du reduce side join est de se servir d'un MultipleInput pour lire simultanément plusieurs fichiers et utiliser le mécanisme de distribution de message pour regrouper les entrées qui partagent une même clé. La jointure est ensuite faite complètement dans le reducer. Toutes les données sont donc transférées sur les reducers.

```java
public static class MapperA extends Mapper<Object, Text, Text, Text> {
    private Text outkey = new Text();
    private Text outvalue = new Text();
    
    public void map(Object key, Text value, Context context) throws Exception {
        outkey.set(GETKEY(value));
        outvalue.set("A" + GETVALUE(value));
        
        context.write(outkey, outvalue);
    }
}

public static class MapperB extends Mapper<Object, Text, Text, Text> {
    private Text outkey = new Text();
    private Text outvalue = new Text();
    
    public void map(Object key, Text value, Context context) throws Exception {
     	outkey.set(GETKEY(value));
        outvalue.set("B" + GETVALUE(value));
        
        context.write(outkey, outvalue);
    }
}
```

```java
if (joinType.equalsIgnoreCase("inner")) {
    if (!listA.isEmpty() && !listB.isEmpty()) {
        for (Text A : listA)
            for (Text B : listB)
                context.write(A, B);
    }
}

else if (joinType.equalsIgnoreCase("leftouter")) {
    for (Text A : listA) {
        if (!listB.isEmpty()) {
            for (Text B : listB) {
                context.write(A, B);
            }
        } else {
            context.write(A, EMPTY_TEXT);
        }
    }
}
```



#### Replicated Join

Le principe du replicated join est d'effectuer la jointure uniquement dans les mappers. Pour cela, il faut impérativement que toutes les tables à joindre sauf une rentre en mémoire des mappers. Cette technique ne s'applique qu'à l'inner join ou au left outer join.

```java
public static class ReplicatedJoinMapper extends Mapper<Object, Text, Text, Text> {
    private HashMap<String, String> userIdToInfo = new HashMap<>();
    private String joinType = null;
    
    public void setup(Context context) throws Exception {
        Path[] files = DistributedCache.getLocalCacheFiles(context.getConfiguration());
      
        for (Path p : files) {
            BufferedReader rdr = new BufferedReader(new InputStreamReader(new GZIPInputStream(new FileInputStream(new File(p.toString())))));
            String line = null;
            
            while ((line = rdr.readLine()) != null) {
                // Parse the line...
                String userId = pared.get("id");
                userIdToInfo.put(userId, line); // Attention, dans ce cas clef unique.
            }
        }
    }
    
    public void map(Object key, Text value, Context context) throws Exception {
        parsed = // split the line;
        String userId = parsed.get("UserId");
        String userInformation = userIdToInfo.get(userId);
        
        if (userInformation != null) {
            outvalue.set(userInformation);
            context.write(value, outvalue);
        } else if (joinType.equalsIgnoreCase("leftouter")) {
            context.write(value, new Text());
        }
    }
}
```



#### Composite join

> Plein de trucs bizarre, pas sure que ce soit à jour tout ça

Le principe du composite join est de préparer les données avant le split. Chaque table doit être triée et découpée en un même nombre de partitions. Ce pattern permet de faire des Inner join et des full join très efficaces. On utilise ensuite un CompositeInputFormat pour faire la jointure. Le composite input format fait le merge des deux inputs splits et renvoie les RecordReader qui renvoient un tuple au mapper.



```java
public static void main(String[] args) throws Exception {
    Path userPath = new Path(args[0]);
    Path commentPath = new Path(args[1]);
    Path outputDir = new Path(args[2]);
    
    String joinType = args[3];
    
    JobConf conf = new JobConf("CompositeJoin");
    conf.setJarByClass(CompositeJoinDriver.class);
    conf.setMapperClass(CompositeMapper.class);
    conf.setNumReduceTasks(0);
    conf.setInputFormat(CompositeInputFormat.class);
    conf.set("mapred.join.expr", CompositeInputFormat.compose(joinType, KeyValueTextInputFormat.class, userPath, commentPath));
    TextOutputFormat.setOutputPath(conf, outputDir);
    conf.setOutputKeyClass(Text.class);
    conf.setOutputValueClass(Text.class);
    RunningJob job = JobClient.runJob(conf);
    
    while(!job.isComplete()) {
        Thread.sleep(1000);
    }
    
    System.exit(job.isSuccessfull()? 0:1);
}

public static class CompositeMapper extends MapReduceBase implements Mapper<Text, TupleWritable, Text, Text> {
    public void map(Text key, TupleWritable value, OuputCollector<Text, Text> output, Reporter reporter) throws Exception {
        output.collect((Text) value.get(0), (Text) value.get(1));
    }
}
```

