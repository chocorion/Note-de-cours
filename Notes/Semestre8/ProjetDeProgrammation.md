# Projet de Programmation



> Si vous voulez un exemple de projet, [voici celui de mon groupe](https://github.com/chocorion/ia-capture-the-flag). Nous avons eu  14/20. Vous pouvez trouvez plein d'autre projet de pdp sur savanne.

[TOC]

## Règles pour le projet
### Règle 1 : Dépôt git Savanne CREMI

Chaque groupe de projet doit créer un dépôt git sur le serveur Savanne du CREMI. Le nom du projet doit être clair et proche du nom du projet qui apparaît sur le site PdP (par ex. ne pas utiliser d'acronymes). Le lien du dépôt sera envoyé au chargé de TD et au client.

### Règle 2 : Identifiants Git

Chacun des membres d'un groupe de projet n'utilisera que son identifiant d'étudiant en *@etu.u-bordeaux.fr* pour commiter (les pseudonumes sont proscrits).

### Règle 3 : Structure du dépôt git des projets

Les dépots git devront nécessairement avoir l'arborescence suivante :
```
.
|
+- organiz/
   |
   +- meeting_reports/  # Compte-rendus des TD
|     |
|     +- 20_01_26-meeting.txt # TD du 26 janvier 2020
      +- ...
|  +- backlog_tasks   # Fichiers avec tâches à faire et en réalisation
|  +- architecture/   # Description/diagrammes du projet.
|
+- docs/  # Documents à produire pendant le PdP
|  |
|  +- requirements /  # Analyse des besoins et des contraintes
|  +- report/         # Mémoire 
|  +- slides/
      |
      +- audit/      # slides de l'audit de mi-parcours
      +- defense/    # slides de la soutenance 
|
+- data/ # Contient les données du projet
|
+- src/ # Contient les fichiers sources du projet
```

**N.B :** Il faut ajouter le fichier `.gitkeep` pour pouvoir push des dossiers vides.

### Règle 4 : Contributions obligatoires

Au cours du semestre, chacun des membres d'un groupe de projet doit commiter sur le dépôt une part suffisamment importante de code, de données, de modifications consistantes. Si la contribution globale d'un des membres est jugée trop peu importante, sa note de projet sera révisée à la baisse.

À ce titre, l'historique git fait également partie des éléments qui font partie du rendu global d'un projet.

### Règle 5 : Workflow git

Au minimum, l'état du projet doit être mergé dans la branche *master* puis poussé sur le dépôt Savanne du CREMI avant chaque TD et pour chaque rendu. Les travaux qui se trouvent dans d'autres branches que *master* ne seront considétés que si cela est notifié au chargé de TD et discuté avec lui au préalable.

### Règle 6 : Cohérence du dépôt git

Ne jamais inclure dans un dépôt git des fichiers qui peuvent être générés à partir des autres. Par exemple, on n'y inclura aucun code objet issu d'une compilation du code source inclus dans le dépôt, ou d'un .pdf issu d'un fichier latex.

### Règle 7 : Ajout de contributions extérieures

Tout code extérieur au projet ou données qui n'ont pas été produits au cours du projet doivent être commités séparemment et tels quels **avant tout autre modification**. Le commentaire du commit devra décrire clairement l'origine de ce code ou de ces données.

### Règle 8 : Compte-rendus de TD

À l'issue de chaque TD, les groupes de projet devront rédiger un compte-rendu dans un fichier .txt qui explicite les éléments importants (questions, problèmes, tâches, tests, etc.) qui y on été discutées avec le chargé de TD.
Le nom de chaque fichier sera du type *20_02_16-meeting.txt*, et sera déposé dans le répertoire `organiz/meeting_reports/` du dépôt git.

## Processus de développement de programmes

### Références bibliographiques

* *Software Engineering (10th ed.)* Sommerville. Pearson, 2015.
* *Software Engineering : A practitioner's Approach (8th ed)*, Pressman, McGraw-Hill, 2014.
* *Software Engineering : Theaory and Practice (4th ed)*, Pfleeger, Atlee, Hall, 2009.
* *Software Engineering*, Naur, Randell, NATO conf report, 1968.
* *Analyse des besoins pour le développement logiciel* J. Lonchamp. Dunod



### Génie Logiciel

*Le génie logiciel* est l'ensemble des principes, méthodes et techniques qui permettent de *passer à l'échelle* :

1. **Faire en sorte qu'un logiciel soit adéquat à la demande :** Analyse du domaine et des besoins, spécification en termes de fonctionnalités, de performance, fiabilité, sécurité, etc...
2. **Faire en sorte qu'un logiciel ait des qualités lui assurant de la pérennité :** lisible, analysable, débuggable, testable, maintenable, modifiable, extensible, documenté, protable, etc...
3. **Faire en sorte qu'un logiciel soit développé dans de bonnes conditions :** processus de développement, utilisation d'outils d'aide, transmission d'informations, etc...

> Génie logiciel = Adéquation + Qualités + Développement rationalisé



Mais, la situation générale du génie logiciel est fondée et déterminée par le fait que :

>  La plupart des propriétés de fonctionnement des logiciels sont indécidables.

Ce point est la conséquence du *théorème de Rice* qui dit essentiellement que toute propriété non triviale d'un programme est indécidable.



La construction d'un logiciel adéquat passe par :

* *Une analyse du domain*e.
* *Une analyse des besoins*, en particulier par des listes de besoins fonctionnels et non fonctionnels.
* *Des éléments de validation, des tests* associés aux besoins, parfois préalablement mis en oeuvre.
* *Des essais, des prototypes, des premières versions* qui assurent la faisabilité, la viabilité, le chiffrage des besoins et de leurs solutions.



La qualité d'un code source d'un logiciel passe par :

* *Une bonne architecture* : Bonne décomposition en éléments distincts, bon décuopage en modules/classes avec masquages, cloisonnements et séparations interfaces/implémentation
* *Une lisibilité* : conformité à des standarts, uniformité des choix, non duplication, commentaires, documentation.
* *Une robustesse, maintenabilité, modifiabilité*: traitement des erreurs, assertions/exceptions, tests associés.
* *Des choix opportuns d'implémentation* : frameworks, API, langages, paradigmes, configurations, structures de données, algorithmes, etc...



Le développement rationalisé d'un logiciel passe par l'utilisation d'outils de développement et d'analyse tels:

* *IDE*, par exemple Eclipse, Visual, NetBeans, etc...
* *Gestionnaires de version*, par exemple git, scn, mercurial...
* *Linters (outils d'analyse statique), outils de tests, profileurs*, par exemple JUnit, CppUnit, gprof/gcov, lint, valgrind, PMD CheckStyle, pylint, pychecker...
* *Moyens de débuggages*, par exemple gdb
* *Build systèmes*, par exemple makefile, automake, Maven, Gradle
* *Aide à la documentation*, par exemple javadoc, doxygen

Le développement rationalisé d'un logiciel s'effectue au travers de l'application d'un processus de développement qui structure et répartit des phases, des action, des modes de production, incluant principalement :

* L'énonciation et l'analyse des besoins.
* La spécification, la modélisation, la conception.
* La mise en oeuvre, l'implémentation.
* La vérification, la validation, le tests.



## Processus de développement

Il existe plusieurs modèles classiques de *processus de développement* (software process model) qui structurent les phases, les actions, les modes de développement entre eux. Ces processus sont divisés en deux grandes familles :

* Les processus séquentiels
* Les processus incrémentaux et itératifs (agiles)

Le choix d'un processus de développement dépend du type du logiciel, de son ampleur, de la taille de l'équipe de développement, du niveau de validité requis, etc



### Processus séquentiels



Un processus en *cascade* (waterfall), comporte la plus simple des structures : une organisation séquentielle du développement en phases distinctes.

Communication, planning, modeling, construction, deploiyment. Cette cascade varie, il en existe plusieurs versions.



Un *processus en V* est une amélioration des processus en cascade: une organisation séquentielle qui intègre des étapes de tests et de validation pour chaque phase.

Il existe plein d'autre processus, par exemple *processus en W*, qui est une amélioration du processus en V.



Les processus de développement séquentiels sont :

* simples et distinguent clairement les responsabilités
* adaptés à des gros projets (chaque phase peut être associée à une équipe spécialisée)

Mais ils ont des faiblesses:

* Chaque phase de développement requiert la réalisation complète des précédentes.
* La validation globale ne se fait qu'à la fin du développement (alors que les besoins d'un projet, les besoins d'un utilisateur sont rarement exhaustifs et corrects dès le début...).



### Processus incrémentaux et itératifs



L'autre grande famillle de processus de développement est celle des *processus incrémentaux et itératifs*, dits agiles (XP, Scrum, Kanban) : une organisation des phases de développement qui intègrent des cycles et des retours en arrière.

Les avantages des méthodes agiles :

* Flexibles et réactifs,
* En lien continu et direct avec les futurs utilisateurs.

Mais ils ont aussi leurs faiblesses.

* Les phases de spécification et de conception peuvent manquer de globalité et de profondeur. La cohérence de l'ensemble peut s'avérer difficile à assurer.
* Ils sont peu adaptés à des projets de grande taille.
* Ils sont peu adaptés si le client ne désire pas s'investir dans l'élaboration du projet.



### Autres processus



Il existe également des *processus de développement hybrides*. Nous avons par exemple le processus en spirale, qui propose une synthèse de séquentiel et d'agile.

Il est aussi courent de rencontrer des *processus méta-agile*, qui incluent plusieurs processus agiles, par exemple *Scrum of Scrums* : Une organisation hiérarchique de plusieurs équipes sous développement agile.



### Processus de développement en PdP

Le processus de développement imposé est hybride et constitué de deux itérations principales associé à des phases itératives à tous les niveaux.

Il s'agit surtout de saisir l'importance des éléments principaux et transverses des processus de développement (en particulier, l'énonciation des besoins et l'élaboration des tests).

Le déroulement de PdP (rappel):

* Analyse du domaine et des besoins, développement, puis livraison d'une première release avec audit de code.
* Re-analyse du domaine, des besoins, développement, puis livraison d'une release finale, et d'un mémoire.



## Analyse des besions



L'analyse des besoins consiste à comprendre , à définir, à décrire les services que doit rendre le logiciel, et à identifier leurs contraintes.

Les besoins d'un logiciel se décrivent essentiellement en deux grandes familles :

* Les besoins fonctionnels
* Les besoins non fonctionnels

Qui peurvent parfois se scinder

* Les besoins utilisateurs
* Les besoins systèmes



#### Les besoins fonctionnels

Les fonctionnalités qui seront offertes par le logiciel, qui seront nécessaires au logiciel, et donc ce que le logiciel doit faire, les services qu'il doit rendre, le comportement effectif qu'il doit avoir.

**Exemple**

* Rechercher dans un ensemble
* Garder une trace du résultat
* Générer une fiche

Remarque : les besoins fonctionnels se décomposent souvent en sous-besoins fonctionnels

Par exemple, lire des fichiers externes :

* Pouvoir considérer la lecture de plusieurs types distincts de fichiers
* Associer des traitements spécifiques à chaque type de fichier
* Faire apparaitre les types de fichiers acczptés dans un menu
* Faire apparaitre les traitements spécifiques possibles dans unn ous-menu du type de fichier sélectionné dans le menu principal
* etc....



**Remarque**

* Plus une décomposition en besoins fonctionnels est précise, plus elle a des chances de se rapporcher d'une description adéquate du logiciel à développer.

* Un besoins fonctionnel est généralement associé à une action , et donc à *un verbe*.



#### Les besoins non fonctionnels

Précisent les qualités et les exigences de qualité que l'on attend du logiciel, ou de parties du logiciel.

Des besoins non fonctionnels comportementaux :

* Performances : temps de réponse, vitesse d'exécution, mémoire utilisée...
* Fiabilité, sécurité : Robustesse aux erreurs, sûreté d'exécution, sécurité à l'utilisation...
* Facilité d'utilisation: contextes d'utilisation, convivialité, esthétique des interaces, accessibilité...
* Domaine d'action: données spécifiques, genre d'utilisateurs...
* Portabilité

Les besoins fonctionnels comportementaux sont les plus communs. La conception de la plupart des logiciels doit les inclure.

Des besoins non fonctionnels externes :

* Contraintes d'interopérabilité : interactions avec d'autres systèmes, périphériques, bibliothèques.
* Contraintes légales : légalité de fonctionnement, problèmes éthiques (ex. capture vidéo), ouverture plus ou moins contraignante des sources, etc.
* Contraintes éthiques : acceptabilité par les utilisateurs, par le public, etc.

Des besoins non fonctionnels organisationnels

* Standarts, processus de développement : processus de développement, techniques de spécification, environments et systèmes d'exploitation particuliers à utiliser lors du développement, etc.
* Gestion du temps : plannings, décomposition des tâches, calendrier des livrables, etc.

**Exemples**

* Performances acceptables même si la charge est importante.
* Minimisation des pertes de données lors d'arrêts impromptus.
* Utilisation du logiciel par des utilisateurs divers.
* Utilisation du logiciel seulement à des fins de prototype ou de *preuve de concept*.



**Remarques**

Les besoins non fonctionnels s'appliquent parfois à des qualités en conflit (les performances vont souvent à l'encontre de la lisibilité et de la robustesse).

Les besoins non fonctionnels sont souvent les plus critiques pour un logiciel(un système de feux de signalisation routière sans haut niveau de fiabilité est complétement inutilisable, donc inutile).

L'amélioration a posteriori des besions non fonctionnels est souvent très difficile. Par ex. : rendre lisible l'illisible $\rightarrow$ tout réécrire...

Un besoin non fonctionnel est généralement associé à une qualité, donc à un *adjectif* (contrairement au besoin fonctionnel associé à un verbe).

Les besoins non fonctionnels engendrent souvent des besoins fonctionnels (ce qui d'ailleurs parfois engendre une confusion entre le non fonctionnel et le fonctionnel).

Par exemple, un niveau particulier de sécurité, une qualité particulière d'interface graphique, un ensemble particulier d'utilisateurs engendrent des besoins fonctionnels pour les mettre en oeuvre.



#### L'essentiel

* Les **besoins fonctionnels** précisent *les fonctionnalités d'un logiciel :*

  * Ils se décomposent en sous-besoins fonctionnels.
  * Ils sont souvent liés à des verbes (des actions).

* Les **besoins non fonctionnels** précisent *les qualités d'un logiciel :*

  * Ils se classifient en familles : besoins comportementaux, externes, organisationnels, etc.
  * Ils sont souvent liés à des adjectifs (des qualités).
  * Ils s'appliquent à des propriétés souvent en conflit.

  **Remarque :** Difficiles à mettre au point, et souvent demandent des itérations (cf. processus de développement séquentiels vs. agiles).

### Techniques de découvert et de mise en place des besions

Une technique évident de découverte des besoins (mais plus difficile qu'il n'y paraît) : interroger les clients, les futurs utilisateurs, les initiateurs. Par exemple, quelques questions à poser à propos d'une nouvelle application à développer (non exhaustif) :

* Quels problèmes doit résoudre cette application ?
* À qui l'application est-elle destinée ?
* Quand et pourquoi sera-t-elle utilisée ? Dans quelles circonstances sert-t-elle utile ?
* Quelles seront ses conditions d'utilisation ?
* Comment fonctionnera-t-elle ?
* ...



Un technique efficace de découvert et de présentation des besoins : les *scénarios*, qui décrivent des séquences possibles d'opérations du système ou d'interactions avec ce système.

* Les scénarios peuvent être énoncés sans formalismes très rigoureux
* Les sscénarios peuvent s'établir à différents niveaux de détail (scénarios globaux, scénarios plus localisés sur des points particuliers).
* On parle aussi de "*use cases*".
* Dans le cadre des méthodes de développement itératives et agiles, on parle de "*user stories*" pour des scénarios simples et courts, en général formatés.

Par exemple, un scénario simple pour une application qui génère du texte à partir d'autres textes de manière statistique :

1. Lire des textes depuis des fichiers externes.
2. Extraire des suites de mots.
3. Analyser les suites de mots, en construisant le graphe de Markov associé.
4. Produire de nouveaux textes en parcourant le graphe.
5. Produire et documenter les résultats sur écran ou dans un fichier.

Dans le cas des user stories, une technique consiste à les écrire sous la forme de petits fichiers (ou même de petites cartes) avec des phrases formatées (par ex. "En tant que" ... "je veux que" ... "de manière à ce que" ...).

À plus large échelle, un scénario peut inclure :

* Ce dont l'utilisateur ou le système a initialement besoins, l'état du système au début du scénario.
* Le flot des évènements dans ce scénario.
* Les informations et les processus qui sont actifs pendant le scénario.
* Ce qui peut mal se passer à l'issue du scénario.
* L'état du système lorsque le scénario se termine.
* Les points d'embranchements lorsqu'il y a plusieurs possibilités.

**Remarque :** 

Un scénario induit essentiellement des besions fonctionnels, les met en scène, en décrit les séquences possibles.

Mais un scénario peut faire également apparaître des besions non fonctionnels, liés par exemple aux temps de réponse, interactions compliquées, fiabilité.

Les scénarios induisent des *tests de validation* : la réussite des scénarios lors d'exécutions du logiciel final impliquera une part de sa validation.



Un technique de découverte (et de présentation) des besions : La construction de *prototypes*, qui sont des modèles réduits, des programmes d'essais qui concrètisent certains éléments du logiciel final à développer :

* Les prototypes précisent certains besoins et démontrent une part de leur faisabilité.
* Les prototypes peuvent (et même souvent, doivent) être considérés comme jetables. C'est-à-dire ne pas être inclus dans le logiciel final.
* Les prototypes peuvent être développés dans des langages de script, des outils de construction d'interfaces, éventuellement différents de ceux du logiciel final (tous les coups sont permis).

Les prototypes sont parfois appelés **spike solutions**.

Les prototypes ne sont pas toujours concrétisés sous les forme de programme. Les *prototypes papier* sont des représentations des interfaces sous forme de dessins (parfois à la main). Ils sont très utiles pour extraire les fonctionnalités des interfaces, et donc leurs besoins.



En résumé, il y a au moins trois techniques de base à exploiter afin de découvrir les besoins d'un logiciel :

1. Les questions aux initiateurs du projet.
2. Les scénarios (use cases, user stories) sont des descriptions de séquences d'interactions, de calculs (et donc de besions).
3. Les prototypes sont des concrétisations (implémentées, représentées, ou dessinées) associés à des besions.



### Développement et analyse étayée des besions logiciels

La description des besions ne peut pas se résumer à de simples phrases. Par exemple, pour les besoins non fonctionnels, on ne peut pas se contenter de dire :

* "Le logiciel doit être rapide"...
* "Le paquetage P doit être réutilisable"...
* "L'interface doit être conviviale"...

Par exemple, pour les besoins fonctionnels, on ne peut pas se contenter de dire :

* "Lire des fichiers externes"...
* "Ouvrir une fenêtre de dialogue"...

En particulier, la description de chaque besoins non fonctionnel ou fonctionnel doit être précisée par :

1. Des quantifications (des valeurs explicites de perfomance, robustesse, etc.).
2. Des études de faisabilité (cf. par exemple les résultats des essais et des prototypes).
3. La description des difficultés techniques éventuelles, et des risques associés, avec alternatives et de parades.
4. La spécification de tests de validation et de contrôle directement associés à ces besions.
5. Des priorités et un positionnement dans l'ensemble global des besoins.



Les besoins non fonctionnels peuvent souvent être quantifiés (par des valeurs min/max, des seuils, des intervalles de valeurs, de probabilités, etc.):

* Vitesse : transactions par sec, temps de réponse, temps de rafraîchissement d'écran, etc.
* Taille : nombre d'octets des disques, de la mémoire, des structures de données, des données à traiter etc.
* Facilité d'utilisation : temps d'apprentissage, taille de la documentation d'aide, etc.
* Robustesse : temps de rechargement après un échec, pourcentage d'évènements produisant des échecs, etc.
* Autre : avec parfois unités/échelles de quantification particulières (cf. les examples des pages qui suivent)

**N.B :** Cette quantification s'applique parfois aussi aux besoins fonctionnels (avec des besoins non fonctionnels en référence).

Tout quantification de besoin demande des précisions. Par exemple, pour un besoin non fonctionnel qui requiert que le logiciel doit afficher une animation graphique de manière fluide : 

* Quantifier par un nombre minimal d'images par seconde (par ex. 30 fps).

Mais aussi :

* Indiquer sur quel type de machine, sur quel type d'écran.
* Indiquer le framework (OpenGL, DirectX, AWT, etc.).
* Indiquer avec quel type d'images (générées, précalculées, vidéo, etc.).
* Indiquer éventuellement des conditions particulières (transit sur un réseau, calcul distribué, etc.).
* ...



### En résumé

L'analyse des besions en développement logiciel est cruciale :
**Remarques**
* Il est plus simple et rapide d'établir des listes de besoins que de les implémenter.
* Plus l'analyse des besions est correcte et précise, plus le temps de développement du logiciel s'en trouvera raccourci, et plus la forme finale du logiciel aura des chances d'être adéquate et meilleure.

## Document d'analyse des besoins

Le document d'analyse des besoins, aussi appelé *spécificatin des exigences* (Software Requirements Specification - SRS), présente l'ensemble des besoins d'un projet. Il existe des descriptions normatives des SRS, par exemple le *Recommended Practice for SRS*, IEEE/ANSI 830-1998.

Ceci dit, il est reconnu qu'il est difficile de décrire précisément un standard pour la présentation des besoins d'un logiciel.

Néanmoins en PdP, nous fixerons les contraintes de rédaction du document d'analyse des besoins ainsi :

```
1. Une courte introduction au projet.

2. Une description et analyse de l’existant (pas forcément).

3. Une description des besoins( ́eventuellement avec distinction besoins utilisateurs/besoins système) :
    i. Une liste des besoins fonctionnels, chacun associes à :
        -Un niveau de priorite d’implémentation dans le projet.
        -Toutes ou une partie des rubriques (a)-(e) ci-dessous.

    ii. Une liste des besoins non fonctionnels globaux, chacun associes à :
        a.Des quantifications.
        b.Des ́elements de faisabilité.
        c.Des contraintes ou difficultés techniques.
        d.L’énonciation de risques et parades.
        e.La spécification de tests de validation et de contrôle.

    iii. Ces besoins seront expliqués, justifiés, illustrés au moyen de :
    scénarios, prototypes(par ex. prototypes papier pour les interfaces, prototypesimplémentés pour la faisabilité),schémas, et diagrammes UML.

4.Un diagramme de Gantt de mise en œuvre des besoins (non contractuel).
5.Une bibliographie.
```
Ce plan n'est pas à respecter absolument.
Avec une analyse précise des besions, il est possible de tenter d'organiser le temps, les moyens, les équipes, et de chiffrer les besoins.

Les *diagrammes de Gantt* en donnent une représentation synthétique.

**Remarque :** certains besoins non fonctionnels induisent des besoins fonctionnels (par exemple, l'optimisation, le niveau de sécurité, la convivialité). Certains besoins fonctionnels nécessitent une discussion sur des besoins non fonctionnels.

**Les besions sont à développer !**
On ne peut pas se contenter de dire *le logiciel doit être rapide*.
Pour la faisabilité, programme de test.

## Documentation

La connaissance du domaine d'un projet permet :
* d'en situer la mise en oeuvre dans un contexte
* d'en mettre en place la conception et le modèle
* d'en préciser les conditions, les difficultés, les possibilités et les buts.

Et donc :
* Documentation, lectures.
* Analyse de l'existant.
* Références, bibliographie.

*L'existant d'un projet* consiste en :
* Des travaux écrits qui présentent des solutions directement liées au sujet d'un projet.
* Des logiciels, outils, implémentations, directement liés au sujet d'un projet.

### Quelques éléments généraux sur la documentation

Une recherche de documentation et d'existant se base en particulier sur :
* Des livres et articles.
* Des introductions, des tutoriaux, des états de l'art.
* L'utilisation d'outils de recherche dans des bibliothèques ou sur internet, de bases d'information, d'encyclopédies
* L'utilisation des références bibliographiques des documents principaux.
* L'utilisation des *références bibliographiques inverses* des documents principaux.

La *bibliographie inverse d'un document* est l'ensemble des références qui citent le document. Cet ensemble de publications :
* Permet d'enrichir la liste des références liées au document (pas seulement son passé, mais aussi son futur).
* Permet de mettre à jour les notions utilisées dans le document par des références plus récentes.
* Est un indication possible de qualité.

On obtient cet inverse par des *indexes de citations*.
* AMS Reviews
* Zentralblatt Math
* Google Scholar
* CiteSeer Scientific Literature Digital Library


### Quelques éléments sur la documentation généraliste par internet

L'accès sur internet à la documentation scientifique de bon niveau est généralement payante.
Il faut donc utiliser sci-hub, s'il est bloqué il faut changer le dns par défaut pour ne pas utiliser le dns d'un FAI français.

Wikipédia est une encyclopédies. On ne cite pas des encyclopédies.

Autres types de sites, parfois de bonne qualité :
* Sites, blogs de chercheurs réputés.
* Sites d'information ouverts sur la programmation, par exemple :
    - Stackoverflow
    - Reddit (r/compsci, r/programming)

### Construction d'une bibliographie

Lors de la rédactiono d'une bibliographie, il existe un format standard à respecter qui requiert d'intégrer toutes les informations des références.
Latex gère très bien tout ça. Attention lors de la citation d'URL à bien mettre la date d'accès au document.



#### Quelques règles :

Donner priorité aux références signées par des auteurs, et qui proviennent d'universités, d'instituts de recherche ou assimilés.

User avec parcimonie des entrées de type URL (elles sont éphémères).

Citer à bon escient. Par exemple, ne par faire apparaître de références trop générales (dictionnaires, encyclopédies, etc.) sur des sujets trop généraux.

Le cahier d'analyse des besions et le mémoire en PdP comporteront une bibliographie dûment rédigée et exploitée.


