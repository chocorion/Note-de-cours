# Projet de Programmation

[TOC]

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