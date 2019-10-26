

# Approche Objet



[TOC]



## Plan

* Bases java (4 semaines)
* Domain Driven Design (3 semaines)
* Architecture objet (3 semaines)
* Notion avancées (le reste)

## Objet

### L'objet

Il se définit par trois notions :

* Idantifiant ( $\ne$ référence)
* Données (il peut ne pas y en avoir)
* Traitemants (Il y en a au moins par défaul)

> Ce qui défini vraiment un objet, c'est les échanges de messages pour réaliser un traitement.



### Responsabilité et encapsulation



L'objet est responsable des traitements qu'il propose. Il doit donc disposer de tous les éléments (suite d'instruction, paramètre, résultat) pour réaliser ce traitement.

Si l'objet utilise ses données pour un traitement, il doit les protéger (*$\rightarrow$ encapsulation*)

### Couplage et cohérence

Deux notions antagonistes.

Plus un objet à besoin d'autres objet, plus il est couplé.Un peut alors se dire que tout mettre dans le même objet réduit ce couplage. C'est en effet le cas, mais cela réduit également fortement la cohérence.

> Ne pas être cohérent, c'est proposer des traitements qui n'ont rien à voir entre eux. 
>
> Un objet cohérent est *inssécable*.

L'idéal est un couplage faigle pour une fort cohérence (dure à attendre).

Question d'analyse d'objet:

- L'objet possède t'il des données ?

  - Non 

    - Pas de problème d'encapsulation puisque pas de données
    - Traitement stateless (static, singleton)

  - Oui

    - A t'il que des données constantes ?

      - Oui

        - Les données constantes n'ont pas à être protégées, l'objet doit donc être immutable

      - Non

        * Problème d'encapsulation

        - Couplage ?
        - Cohérence ?

### Cycle de vie

* Création
* Réception de messages
* Destruction



## Les classes

### C'est quoi une classe ?



Deux éléments important définissent une classe :

* un moule (new)
* un contrat (conformité)

Pour chaque objet, il y a uniquement une classe constructrice. Tout objet construit est conforme. Il y a donc, entre un objet et sa classe, une relation de construction, et une relation de typage (conformité).

### La class comme contrat/moule





|                             Data                             |                         Traitements                          |
| :----------------------------------------------------------: | :----------------------------------------------------------: |
|                    `visibilité type nom`                     |     `visibilité type nom(paramètre) exception { code }`      |
| Conforme : L'objet possède les données définies par la classe. | Conforme : L'objet est responsable des traitements définis par la classe |





> *Duck-typing* : Si ça fait coin-coin comme un canard, c'est un canard.



Conformité = typage. Avoir un typage correcte nous permet de détécter les erreurs dans le code.

$ Code \underbrace{ \rightarrow}_{Premier\ contrôle\ de\ typage\\1.\ Prévenir\ les\ erreurs\\2.Aide\ IDE} Code\ Compilé \underbrace{\rightarrow}_{Second\ contrôle\ de\ typage} VM $ 

### Visibilité et encapsulation



|               |                      Public                       |                          Privé                           |
| :-----------: | :-----------------------------------------------: | :------------------------------------------------------: |
|    *Data*     | Pas de verrour, on s'en fiche de l'encapsulation. |       Verrour, sauf pour les objets de même classe       |
| *Traitements* |                      Normal                       | Pas normal. Personne ne pourra utiliser les traitements. |

### L'héritage

C'est une relation entre 2 classes qui a un impacte sur les objets instances des classes en relations.

<img src="images/BasicIllustration.png" style="zoom:100%;" />

```java
public class Shape {
    private List<Point> pointList;
    
    public Shape() {
        pointList = new ArrayList<Point>();
    }
    
    public List<Point> getPointList() {
        return pointList;
    }
}
```

Le getteur brise l'encapsulation !



#### Quand faut-il utiliser l'héritage ?

1. Si vous êtes en train de dupliquer du code dans deux classes.
2. Si vous voulez réutiliser une classe sans la changer.
3. Vous êtes en train de définir un contrat qui devra être complété par un autre développeur.

### Polymorphisme et surcharge

Contrat des classes sur les objets (Typage) ne porte jamais sur le code. Que sur les éléments de typage.

* *Polymorphisme* : Change le code dans une sous-classe.
* *Surcharge* : Change le type $ \rightarrow $ Ajoute des contraintes de typage (moins d'individus).

Covariance : On a le droit de sous-typer les paramètre.

```java
public class Transformer {
    public Shape transform(Shape in) {}
}

// Extends autorisé par covariance. Ici Rectangle hérite de Shape.
public class RectangleTransformer extends Transformer { 
    public Rectangle transform(Rectangle in) {}
}
```

Ici la compilation est accépté, les types sont réspéctés. Mais des problèmes peuvent être générés à l'éxécution :

```java
Transformer t = new RectangleTransformer(); //Autorisé
t.transforme(new Square()); //Square hérite de shape
```

La dernière ligne produit une erreur dans la VM.



*Contravariance* (pas au programme) : Propose d'inverser l'héritage sur les entrées, et utilise la covariance sur les sorties.

Comment être sur que la sortie est du même type que l'entrée dans `transformer` ? Utiliser des classe générique (`T`).

## Délégation et interfaces

Réutiliser du code sans héritage $\rightarrow$ délégation.

|       | Héritage                                                     | Délégation                                                   |
| :---: | ------------------------------------------------------------ | ------------------------------------------------------------ |
| **+** | Moins d'objets<br>Moins d'appels de méthodes<br>Moins de dépendances directes | On ne dépends pas du code grâce à l'interface                |
| **-** |                                                              | Plus d'objets<br>Plus d'appels de méthodes<br>Pas du substitution |

### L'interface

Définition d'un ensemble *cohérent* de méthodes. Pas de code (sauf depuis java 1.8)

Séparation de la définition des méthodes (signatures) de la façon dont elles sont implémentés.

*Peut-on déléguer le new ?*

Oui, avec le pattern factory.

```java
public class PointFactory {
    public Point createPoint(int x, int y) {
        return new Point(x, y);
    }
}
```

#### PNJ version héritage

```java
public class PNJ extends PlayerFinder {
    public void findAndKill() {
        findPlayer();
    }
    
    public void findAndRun() {
        findPlayer();
    }
}
```

Ici, on réutilise bien le code `findPlayer()`.

#### PNJ version interface

```java
public interface PlayerFinderItf{
    public void findPlayer();
}
```

Nous avons deux manières d'utiliser cette interface :

Instanciation :

```java
public class PNJ {
    private PlayerFinderItf pf;
    
    public PNJ(PlayerFinderItf pf) {
        this.pf = pf;
    }
}
```

N'importe quand :

```java
public class PNJ {
    private PlayerFinderItf pf;
    
    public void setPlayerFinder(PlayerFinderItf pf) {
        this.pf = pf;
    }
}
```

### Inversion de dépendance

Dans le cas de l'héritage, nous avons :

```java
public class PNJ extends Savable {
    ...
    public void Save(){
        ...
    }
}
```

PNJ dépends de la base de donnée. Utilisons maintenant la délégation :

```java
public interface SavableItf {
    public void save();
}

public class PNJ {
    SavableItf bdd;
    
    public void setBdd(SavableItf bdd) {
        this.bdd = bdd;
    }
}

public class SavableSQL implements SavableItf {
    public void save() {
        ...
    }
}
```

Dans ce cas, c'est SavableSQL qui dépends de PNJ. Les dépendences ont étés inversées.

## Test et Clean Code

### Les Tests

Tester, ce n'est pas vérifier que ça marche, mais vérifier que ça ne marche pas. Il faut donc avoir une définition de ce qui marche (*oracle*) et montrer l'inverse.

Comme il est difficile de trouver ce qui ne marche pas dans un code que l'on a conçu pour marcher, il est préférable d'écrire les tests avant de coode (*TDD*), ou faire tester son code par quelqu'un qui ne l'a pas écrit.

*Quand a-t-on terminé de tester ?*

Dans l'absolue, jamais ! Mais on va définir le périmètre des tests, et on va le partitionner en classe d'équivalence. On fait un test par partition.

Pour tester :

1. Avoir l'oracle
2. Définir votre partition
3. Un test par partition

Tester `String[] sort(String[])` :

1. Fonction qui vérifie que le tableau est trié.
2. Aléatoire (*Monkey testing*)

### Bien coder

Lire le livre clean code :)



### Domain Driven Design

E.Evans - 2003 - Blue Book

Vaughn - Red Book

Le principe fondamental: *Le code fait autorité !*

* CdC : Besoin exprimé par un *owner* (celui qui paye)
* Spécification du futur/présent du logiciel (UML)
* Code
* Données

Où est la vérité ?

D'après DDD, elle est dans le code, plus présicement dans la partie *domain*. (IHM/Save/Network/... pas dans domain). On commence le développement par le domain. Pas par la base de données, par par l'UML (trop abstrait).

**Exemple :** Application de gestion de compétitions

Plusieurs concepts : 

* Joueur : nom, prénom (immutable)

* Matche : 2 joueurs, début/fin, ajout de points, gagnant

* Compétition: ouvert inscription, joueurs, gagnant..

  


#### Value Object

```java
// Joueur : Value Object
public class Joueur {
    // public final String nom; Pas assez métier
    public final ChaineAlphabétique nom; //Français car pour marché français
    public final ChaineAlphabétique prénom;
    
    public Joueur(ChaineAlphabétique nom, ChaineAlphabétique prénom) {
        this.nom = nom;
        this.prénom = prénom;
    }
}

public class ChaineAlphabétique {
    public final String valeur;
    
    public ChaineAlphabétique (String val) {
        if (regex[a-zA-Z]*)		this.valeur = val;
        else return RuntimeException
    }
}
```



Objet défini par la valeur de ses propriétés (= immutable). (Bob l'éponge != Bob the sponge)

Redéfinir equals :

```java
public boolean equals(Object o) {
    if !(other instance of Joueur)
        return false;
    
    Joueur otherJoueur = (Joueur) other;
    
    return nom.equals(otherJoueur.nom) && prenom.equals(otherJoueur.prenom);
}
```

Ce code est faux, car imaginons que nous avons une nouvelle classe :

```java
public class JoueurClasse extends Joueur {
    
}
```

Comme l'égalité doit être réflexive, un `Joueur` et `JoueurClasse` peuvent ne pas être égaux. (equals à l'examen)

#### Entity Object



```java
public class Match {
    public final Joueur j1, j2;
    		// On peut faire un getter, joueur immutable
    
    private EtatDuMatch etatMatch;
    private Score nbPointJ1, nbPointJ2;
    
    public void demarrer() {}
    
    //Flag parameter, on doit splitter en deux
    public void majScore(int numJoueur, Score ..) {
        if (numJoueur) {
            ...
        } else {
            ...
        }
    }
}
```

Il manque l'Id, qui permet d'identifier le match. Qui donne l'Id ? Si on créé la matche dans un championnat, c'est le championnat qui donne l'Id au match.



#### Aggregate Object

Donne du sens à un ensemble d'entitées. 

```java
public class Competition {
    // On "agrege" les joueurs et les matchs
    Set<Joueur>
    Set<Match>
        
    inscrire(Joueur j)
    fermerInscription() {
        ...;
        // Création des matchs
    }
}
```





#### Tactical Pattern

Value Object : Immutable

Entity : State, eq by id

Aggregate : Groupe, attention à l'encapsulation des entitées

Ces éléments constituent le domain.

(Application de gestion des stats : Nouveau context, nouvelle application, nouvelle classes.)


### Aggregate, Entity, Value object + Service

#### Rappels:

Value object :
* Immutable
* Equals by value
* (Typage plus fort que java (entier posirif), pas de problème d'encapsulation)

Entity :
* Un état
* Un id ( à définir )

Aggregate :
* Composite (Contient des entity) | (gestion des entitys)

**Exemple jeu d'échec**


| Aggregate | Entity  | Value Object |
| :-------: | :-----: | :----------: |
|  (Vue utilisateur) | Joueur | Location|
| Game | | Color (Enum) |
| | | Piece |

*Une méthode va dans la classe qui possède ou peut obtenir toutes les infos pour exécuter la méthode.*

```java
public class Location {
    public final char column;
    public final int line;

    public Location(char col, int line) {
        if (col not in ["A-H"]) {
            throw new IllegalParameterException();
        } else {
            this.column = col;
        }
    }
}
```

```java
public class Case {
    Piece p;
    Location l; // Id unique
}
```

```java
public class Game {
    List<Case> caseList;
    public Game() {}

    // On ne peut passer que des value object en param, pas d'entity
    public void move(Location from, Location to) {
        case case = getCaseFromLocation(from);

        // Violation loi Demeter
        //boolean isLegal = case.getPiece().isLegalMove(from, to);
    }
}
```

```java
public abstract class Piece {
    public abstract boolean isLegalMove(Location from, Location to);
}

public class King extends Piece {
    private Color color;
    
    public boolean isLegalMove(Location from, Location to) {
        if (Math.abs(from.getLine() - to.getLine()) > 1) {
            return false;
        }

        if (Math.abs(from.getColumn() - to.getColumn()) > 1) {
            return false;
        }
    }
}
```

`List<Location> getIntermediaryLocation(Location from, Location to)`

`List<Location> getAccessibleLocation(Piece p, Location at)` (peut-être à mettre dans pièce plutôt)

Ce sont des fonctions *stateless*, appellées *Service* en DDD. Il est conseillé de faire une classe par service.

### DDD Tactiques en pratique

1. Value Object (Service)
2. Aggrgate $\rightarrow $ méthode métier (param Value Object)
3. Structuration de l'Aggregate $\rightarrow$ Entity

### Factory

Quand le constructeur est grand(compliqué), il vaut mieux le déplacer dans une *factory*.
Dans cette classe, on soigne le code de construction. (Essentiellement sur les aggregates).

Autre exploitation des factory, c'est pour limiter le nombre d'objets Value Object égaux dans la VM.

# Architecture Hexagonale (La couche Infra)

## Rappels 

La couche domain (le métier) :
* Le typage (value object)
* les règles métiers, la sémantique (entity, aggregate)

Il faut donc dans le code un `package domain`. 
* Pas d'IHM
* Pas de sauvegarde
* Aucune dépendance vers aucune autre classe.

### Sans approche DDD

Schéma des données (SQL/Mongo...) $\rightarrow$ génération de classes qui font le pont vers la VM. On créé ensuite nos propre classes qui héritent de ces classes générées.

1. Où mettre le code de sauvegarde
2. Quel shéma
3. Quelle signature (Quelle méthode on va appeller pour sauvegarder)

#### Exemple Game

3. save dans Game / `save(Game g)` et `Game load(id)` dans une classe GameSaver.
    FindAll $\rightarrowtail$ `SELECT *` $\rightarrowtail$ Pas bien. `FindGameById` $\rightarrowtail$ mieux.

### Avec DDD: Le repository (dans Domain)

C'est soit une interface, soit une classe abstraite.
Repository n'a de sens que pour les aggegates. 

```java
public interface GameRepository {
    public void save(Game g);

    public Game load(int gameId);

    // findBy
    // update
}
```

----------
```java

public class Game {
    GameRep rep;
    
    public void move(Location from, Location to) {
        ...
        rep.update(this);
    }
}

```

2. Quel schéma ?

*Comment est sauvegardé mon aggregate ?*

Quel format ? sql, csv...

La définition du schéma va dans la couche infra.

3. Où mettre le code

```java
public void save(Game g) {
    "INSERT INTO GAME" + ...;
}
```

Ce code va dans la couche infrastructure

------

```java
package domain;

public interface GameRepository {
    public void save(Game g);
    public Game load(int gameId);
    ...
}
```

```java
package infra;

public class GameSQLRepository implements GameRepository {
    public void save(Game g) {
        "INSERT INTO GAME"...
    }
    ...
}
```

1. On définit d'abord les méthodes
2. On écrit le schéma
3. On écrit le code

GameRepository compile sans GameSQLRepository $\rightarrow$ Oui

GameSQLRepository compile sans GameRepository $\rightarrow$ Non

### L'exécution

1. Qui où comment est appelé le repository
2. Comment échanger la référence du repository

1 Quand on veut (dans les aggregates, les services, à l'extérieur...)
```java
//Exemple dans l'aggregate
public class Game {
    GameRepository rep;

    // Qui appel cette fonction ?
    public void setRepository(GameRepository rep) {
        this.rep = rep;
    }

    public void move() {
        ...
        rep.update(this);
    }
}
```

----------

Domain/infra $\Rightarrow$ Inversion de dépendances

## Cours numéro 8: Synthèse DDD(Domain + infra)

**Exemple :** L'agenda

* Ajouter des rendez-vous

$\Rightarrow$ Trouver les *Value Object*, *Entity*, *Aggregate*, *Service*, *Factory*, *Repository*

|**Concept métier**| DDD **Techno**(abstrait) |
| :--: | :--: |
| Agenda | VO (1) |
| Rendez-vous| Aggregate (2) |
| Date | Entity (3) |
| Sujet | Factory |
| Lieux | Repository |
| etc | Service |



| VO   | Aggregate | Entity |
| :--: | :--: | :--: |
| Date | Agenda | Rdv |
| Sujet | | |
| Lieux | | -

```java
public class Date {
    private int numMois; //Pour les puristes : type particulier, [1-12]
    private int numJour;

    public Date(int numMois, int numJour) {
        ...
    }

    public boolean equals(Object other) {
        ...
    } 

    //hashCode à faire. Faut faire ces trois fonctions pour avoir les points en exam
}

public class Rdv {
    private int id;
    private Sujet sujet;
    private Lieux lieux;

    public Rdv(int id, Sujet sujet, Lieux lieux) {
        this.id = id;
        this.sujet = sujet;
        this.lieux = lieux;
    }

    // Dans ce cas, lieux est un valueObject
    public void changeLieux(Lieux nouveauLieux) {
        this.lieux = nouveauLieux;
    }

    // Dans ce cas, lieux est une entitée. On préfèr la première version.
    public void changeLieux(String nouveauLieux) {
        this.lieux.setValue(nouveauLieux);
    }

    // equals et hashcode en fonction de l'id !
    
}

public class Agenda {
    private Set<Rdv> rdvSet;
    private int id;

    // C'est l'aggregat qui créé l'objet. Ici implémentation stupide, si on retire un rdv du Set les id sont faux.
    public int ajouterRdv(Date date, Sujet sujet, Lieux lieux) {
        Rdv rdv = new Rdv(rdvSet.size()...);
    }

    // Pas le droit d'avoir de référence vers un rendez-vous en dehors de l'agenda
    public void modifierSujetRdv(Sujet nouveauSujet, int numeroRdv)
}
```

**Service**

Méthode métier sans état qu'on ne peut pas ranger dans les aggregate/entity/vo qu'on a.

```java
Date creneauLibre(Set<Agenda>, Date debut, int durée);
```

On créé une nouvelle class :
```java
public class AgendaService {
    // Pas d'attribut, stateless
    
    Date creneauLibre(Set<Agenda>, Date debut, int durée) {
        ...
    }
}
```

**Repository(save/load) / Factory**

**DAO** version des entity avec seulement les datas, dans le domain.

```java
package domain;

public interface AgendaRepository {
    void Save(Agenda agenda);

    
}
```

```java
package infra;

public class AgendaRepositoryImpl implements AgendaRepository {
    void save(Agenda agenda) {
        // On a besoin de l'état du rendez-vous, dans une forme qu'on ne peut changer
        // DAO, data access objet
    }
}
```