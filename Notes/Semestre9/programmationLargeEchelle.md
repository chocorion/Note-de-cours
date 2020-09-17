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

Tout est orienté sur le débit. Le but, c'est de lire le plus rapidement les données. Fonctionne par block de 128Mo