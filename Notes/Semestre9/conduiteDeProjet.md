# Conduite de Projet



Deux petites vidéos du prof en lien avec le cours : 

<iframe width="560" height="315" src="https://www.youtube.com/embed/vhpcngRVE_A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<iframe width="560" height="315" src="https://www.youtube.com/embed/VWhLcgo9z74" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



## Introduction

### Comment se déroulera le cours ?

[https://www.labri.fr/perso/xblanc/teaching.html](Lien du site du prof)

[Cours sur github](https://github.com/xblanc33/QualiteDev)

Il y a 6 fichiers, avec des 5 éléments de qualités sur chaque fichier. Ça fait 30 points de contrôle. On sera noté sur 30, il faut donc tout connaître par coeur.

> Bien faire les choses vs faire bien

Dans ce cours, c'est *Bien faire les choses*, plutôt que faire les choses bien.

Les 6 artefacts sont : 

* Issue
* Task
* Test
* Code
* Doc
* Release

Une semaine par artefact, puis 6 semaines de projet. Équipe de 3, tirées aléatoirement. Le but de projet, c'est de créer notre propre jira. Outils qui permet de gérer les 6 artefacts. Obligation de moyens (vs obligation de résultat), le projet sera à priori impossible à réaliser en 6 semaines. 3 sprints de 2 semaines. Il y aura des revues à la fin de chaque sprint.



## Premier artefact : Issue



> Aussi *user story* dans scrum. Backlog, liste des issues

Génie logiciel $\rightarrow$ Production Logiciel, donc production.

* **MOA** : Maitrise d'ouvrage. C'est l'entité qui a un besoin, le financement, mais qui n'a pas les compétences pour le faire.
* **MOE** : Maitrise d'oeuvre. C'est l'entité qui possède les compétences techniques.
* **MEP** : Mise en production, moment où les utilisateurs peuvent utiliser le logiciel. Avant la prod, pre-prod (tests, etc...).
* **TMA** : Tierce Maintenance applicative. Le logiciel retourne dans le cycle de dev, pour traiter les anomalies. Mort du logiciel ? Quand on coupe la machine, et que personne n'appel. 

Être bon, c'est faire la mise en prod le plus rapidement possible, tout en ayant un logiciel de qualité (*Accelerate* | *Quality*). Le tout est de trouver le bon équilibre enter les deux.

Dans cette ue, on va ne s'occuper que du cycle de dev. On s'arrête avant la pre-prod. 



L'*owner* (MOA, maitrise d'ouvrage) exprime un besoin, réalisé par le développeur (MOE, maitrise d'oeuvre). Il faut plutôt utiliser les termes Propriétaire/Utilisateur/Développeur à la place de client etc. Le client est un rôle qui peut changer. L'utilisateur est le client du propriétaire, mais le propriétaire est le client du développeur.

Le logiciel nait quand le propriétaire exprime le besoin. Le besoin est ensuite validé, puis spécifié (on rentre dans les détails). Il pourrait également être prototypé. Et à un moment donné, il est réalisé.  Dans les besoins, on va principalement travailler sur les besoins de nouvelle fonctionnalitées. Pas les bugfixs ou améliorations.

(Jira est un outil qui permet de gérer les étapes de ces besoins, surtout *Issue* et *Task* )



### Les règles des issues



1. Les issues doivent avoir un *id unique*, qui permet de suivre leur évolution.
2. Les issues doivent être précises. Si c'est pas assez précis, on ne peut pas tester, et donc on ne peut pas vérifier que c'est bon.
3. Les issues doivent être homogènes. Au lieux de #1 jouter, #2 modifier, #3 supprimer : #1 CRUD. CRUD peut-être un peu trop d'un coup, faut une juste millieu. Scénario à valeur ajoutée. Donc crud, pas bon.
4. Qualifier type, importance, coût. Le type peut être par exemple *BugFix*, *New feature*, ... Certaines issues sont plus importantes que d'autres pour le propriétaire. Les issues doivent être classées par importance (High, Medium, Low). Le coût n'est pas en euro, mais en *comparaison*. On suit la suite de fibonacci (1, 2, 3, 5, ...).
5. Planification.

Liste des issues que les devs espèrent pouvoir réaliser (spécifiées en lisant le cdc) = **backlog**.

Pour le premier td, il faudra créer `issue.md`. Ensuite  il faut la planification, c'est-à-dire pour chaque sprint, mettre les issues à réaliser.

Le dev doit spécifier les besoins, c'est-à-dire rédiger les *User Stories*. Ce processus s'appel *l'analyse du besoins*. Le backlog contient les issues rédigées par les dev, donc la version spécifié. Il est validé par le propriétaire (*PO*). 

Pour pouvoir chiffrer le projet, on fait la somme des difficultées des issues dans le back log. Il faut ensuite mesurer le coût de *1*. C'est fait *au doigt mouillé* par le chef de projet. On utiliser généralement le jour-homme. (2jh = 1 dev pendant 2j, ou 2 dev pendant 1j). On utilise le jmois, 20jh, et le ja, 12jm.

Aujourd'hui, dans bdx, 1jh c'est vendu en moyenne 400euros. (Donc projet pdp, 10semaines = 50jh, 20k).



> De ce que j'ai compris pour la méthodologie agile, une *user story* est une *issue*, mais une *issue* n'est pas une *user story*. Issue est un  terme générique, ça peut être une *Story*, un *Bug,* ...



**User stories** are short, simple descriptions of a  feature told from the perspective of the person who desires the new  capability, usually a user or customer of the system. They typically  follow a simple template:

As a < type of user >, I want < some goal > so that < some reason >.





## Deuxième artefact : Task



> Le digramme de Gantt, c'est nul.

La task n'est pas l'issue. L'issue, c'est la finalité. L'issue c'est *quoi*, et la task *comment*.

Pour faire la liste des taches : 

1. Faire l'architecture.
2. Quels fichiers sources à écrire.
3. Dépendances.



Exemple formulaire covid:

```
1. covid.css
2. covidBD.sql
3. receiveFromPOSTAndGeneratePdf.php
4. forumaire.html
```

3 et 4 dépendent de la définition du formulaire. C'est une tâche supplémentaire. On passe de l'user story "En tant que français je veux pouvoir génere le formulaire" à 5 tâches.

On peut rajouter x2 pour chaque tache, si on ajoute un test par tache.



**Tache id 1 - Faire le formulaire html pour le covid**

Definition of done: Contruire un fichier index.html à la racine du projet. La page html contient un form post vers l'url genPDF.php. Le forumaire contient les champs suivant : 

* Name - String 50 char
* ...

Il faut un Definition Of Done précis, pour définir le RAF (Reste à faire).



**Tache id 2 - Tester le formulaire html**

Definition Of Done: Ouvrir index.html avec votre navigateur. Saisir un nom, ... Cliquer sur Submit, et vérifier à l'aide de l'outil DevTool qu'une requête post vers genPDF.php a été envoyée.



Pour rédiger une tâche :

1. Chaque tache doit avoir une durée relativement courte. Maximum un jour, soit 8h.
2. Préciser le travail à faire.
3. Chaque tache est liée à une userStory. On ne fait pas de tache pour rien.



Liste des tâches :

| Id   | Charge                   | Depend | User Story |
| ---- | ------------------------ | ------ | ---------- |
| 1    | index.html<br>4 heures   |        | US1Gen     |
| 2    | Tester Id 1 <br>4 heures | 1      | US1        |



Planification :

|       | L    | M    | M    | J    | V    |
| ----- | ---- | ---- | ---- | ---- | ---- |
| Alice | T1   | T3   | T3   | X    | X    |
| Bob   | X    | T2   | T4   | X    | X    |
| Joh   | X    | X    | T6   | X    | X    |

X = temps mort = Perte d'argent.



Diagramme de Pert (pas très utile dans le cadre du cours) : 



| Id   | Charge | Depend  | US   |
| ---- | ------ | ------- | ---- |
| 1    | 1      | X       |      |
| 2    | 1      | 1       |      |
| 3    | 3      | 4       |      |
| 4    | 2      | X       |      |
| 5    | 1      | 1, 2, 3 |      |
| 6    | 2      | 5       |      |
| 7    | 1      | 5       |      |



<img src="/images/CDC/pert.png" />



Version à la main (C'est ce qu'on utilisera dans ce cours) : 

|       | 1    | 2    | 3    | 4    | 5    | 6    | 7    | 8    |      |
| ----- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- |
| Alice | X    | X    | X    | T1   | X    | X    | T5   | T6   |      |
| Bob   | T4   | T4   | T3   | T3   | X    | X    | T7   | X    |      |



## Troisième artefact : Tests



Principe : Si on observe une faute alors il y a une défaillance. Le but n'est pas d'écrire un test qui montre que ça marche, mais d'écrire un test qui montre que ça ne marche pas.

(RO: Résultat Obtenu, RA: Résultat Attendu(Oracle))

Pour chaque test, au moins deux taches : 

- Définir l'oracle
- Lancer le test

2 métiers, celui qui rédite, celui qui exécute.

Au moins un tier du budget total passe dans les tests normalement.



#### Quels tests et quand ?

Il y a trois niveau de test:

1. Test unitaire : Tester un élément individuel
2. Test d'intégration : Tester les intéractions entre deux éléments
3. Test fonctionnel : Tester tout le système



#### Tests Unitaires

On test l'unité, c'est-à-dire un fichier source. Pour tester si un test est bon, on peut tester la couverture du test. Il faut au moins 80% de couverture.

*Mutation testing* : On change le contenu du code, et on regarde si les tests passent toujours. Normalement, ils ne doivent pas tester.



#### Tests fonctionnels (E2E)

Tester l'applicationi de bout en bout (sur une user story). Est-ce que c'est un vrai test ? Parcequ'on vérifie juste que ça marche (une démo). Il faut un modèle de scénario bout en bout (Event Sourcing) $\Rightarrow$ Maquette (PRETOTYPE). La maquette du scénario c'est montrer commence on passe d'une étape à une autre. Il faut aussi préciser le résultat attendu à chaque étape. (Figma) (voir gherkin, selenium/cypress?)



#### Synthèse Test

* Trouver les erreurs qui gènent
* Pyramide test (yt caverne du testeur)
* 2 tâches (Design | Execute)
* Automatiser (Selenium, Cypress)
* Couverture des tests/mutation testing



## Quatrième artefact : Code

Nous allons voir surtout le code en équipe avec :

1. l'écriture du code
2. l'échange de code

### L' Échange de code



Fonctionnement de l'ancêtre, *SVN*. Il y a u dépôt, un utilisateur, et un workbench. Le workbench est le répertoire locale, plus des méta-informations. Dans le dépôt, il y a des repertoire plus des méta-informations. Les méta-informations sont des numéros. Ils servent à savoir si ce qu'il y a dans le workbench est plus récent, ou moins récent que dans le dépôt. Si le numéro du workbench est inférieur à celui du dépôt, interdit de commit.



Contrainte pour cette ue : 1 dépôt clean, avec un responsable. C'est-à-dire, un seul à le droit de push.

Comment s'organiser ? Plusieurs solutions.

**A (interdit dans cette ue):** Tout le monde peut push/pull sur le dépôt github. Organisation qui change peut par rapport à snv.

**B : ** Deux dépôts dans github, un dépot travail et un dépôt clean. Un seul dev peut écrire sur clean. C'est l'intégrateur.

**C :** *Feature branching* Chaque dévelopeur sur sa branche, puis quelqu'un intégre les branches sur ls branche principale

**D :** Deux branches, main et clean. Tout le monde push sur main, et quelqu'un fait le merge sur la branche clean.



### Comment écrire le code



Mise en situation : Tâche 1, produire Form.php. Première chose à faire, la gestion de configuration, c'est-à-dire définir les répertoires de votre dépôt. Les répertoires doivent être alignés avec l'architecture.

Version du prof (DDD) :

```
src/
	infra/
	UI/
	domain/
	application/
```

Un truc qui marche pas, c'est un repertoire par type de fichier.

Customisation de l'éditeur, est-ce qu'on la partage ? caractère retour ligne, nom fichier, linter (voir SONAR)





## Cinquième artefect : La doc



|         Type de doc          |     Qui l'écrit      | Qui la lit  |                           Remarque                           |
| :--------------------------: | :------------------: | :---------: | :----------------------------------------------------------: |
|    Documentation de code     |     Developpeur      | Developpeur | Clean Code : Il vaut mieux réécrire que documenter. C'est ce qu'on fait dans ce cours, donc pas besoin de javaDoc ou autre truc. Sauf si on écrit une lib. |
|  Documentation utilisateur   |          ?           | Utilisateur | UX (ex: Call to action) (ce qui est bien c'est le how to dans l'appli) |
| Documentation d'installation | DevOps, Dev/Sysadmin |   DevOps    |                                                              |



> Lire HooKed (petit bouquin jaune)



## Sixième artefact : Release



Qu'est-ce qu'une release ? Le prduit pret à être installé (serveur/utilisateur). En gros, fichier zip avec un script d'installation.

1. Construire le fichier Zip
2. Faire le script d'installation
3. Déposer le fichier sur une page

### Le script deploy.sh

> .sh $\rightarrow$ machine linux

1. Le deploy va devoir installer toute les dépendances. `apt get install ..`
2. On met les fichiers au bon endroit `cp ./src/app/apache /www`
3. mysql start, on démarre la base de donnée
4. mysql_client ./src/bd/start.sql On créé la table dans la base de donnée
5. Démarrer apache
6. Démarre nginx

> On va être jugé sur ce script. Toute les semaine, il prend des équipes au hasard, et lance la release.



Mais on va faire ça dans un conteneur, docker.

### Docker

On va donc faire un script docker à la place du *deploy.sh*.

Docker-Compose: C'est un fichier .yml



### Points de contrôle sur la release

* Il faut absolument une page sur laquelle on peut télécharger la release. Et aussi les anciennes release
* Chaque release a une date de sortie, et la liste des issues réalisées.
* SemVer: C'est la manière de numéroter. Majeur, Mineur, Patch



## Phase 2 : Projet

Objectif : Réaliser un outil pour gérer la production logicielle (à la scrum)

Le jury est pris en compte dans la note, 40%. Il va voire défiler les mêmes projets en boucle. Il faut donc être original. Il faut pas juste faire du *CRUD*.

* Gestion des issues : Doit permettre la gestion des user story. Tous les points vues en courts doivent être respectés. Cette issue doit être réalisé, il faut aussi qu'on puisse trouver la release qui implémente l'issue. Est-ce qu'elle a été testé ? et quand. Story point et id unique.
* Gestion des tâches : Doit permettre l'affectation, le suivi, la création, savoir dans quel sprint on est, la planification. Savoir quel est le reste à faire. DOD (générer un pert ?)
* Gestion des releases : Avoir les release téléchargeable.
* Gestion des tests : Test end to end. Il veut voir les tests, quand est-ce qu'ils ont été rréalisés..
* Gestion de la documentation : Lien vers le doc d'install et la doc utilisateur

Pas de gestion du code, pas de gestion de git. Product owner = équipe pédagogique. Pas de gestion d'équipe, pas d'authentification, pas de gestion de droit, on s'en fout.



Contraintes : 

* Équipe de 3 random
* Un channel slack par équipe
* Un dépot git pour les releases "épinglé"
* Un dépot git pour le de "épinglé"
* Channel vide = 0 activité. Pas de commit = 0 activité. 0 activité = 0 implication

Pas de git privé.



Mise en abime:

* BackLog : Readme à la racine du dépôt release
* Sprints : SprintX.md (X étant le numéro du sprint) à la racine du dépôt release
* Tâches : TaskX.ml (X étant le numéro du sprint) à la racine du dépôt release
* Release: Release.ml à la racine du dépôt release
* Documentation: Documentation.md à la racine du dépot release



WE et vacances, concidérés comme non travaillé

Sprint 1 après les vacances ->  Faire tasklist. 

Après les premiers sprint, on peut changer d'outil.



Sprint 0 : Vendredi 23 octobre (issues, planification, architecture, docker, archi)

Sprint 1: 2 novembre au 13 novembre (issues, task, code, test, release)

Sprint 2: 16 novembre vendredi 27 novembre

Sprint 3: 30 novembre au 11 décembre.

Fin de sprint: mesurer la vélocité. Burn Down Chart





## Architecture

Identification des gros modules d'un logiciel et de leurs intéractions.  Il y a 2 objectifs principaux : 

* Organiser les développeurs
* Rapide et solide



### L'architecture classique 3-tiers

Architecture à l'ancienne, un container avec une bdd, un autre avec le serveur applicatif, puis tous les utilisateurs qui communiquent avec le serveur applicatif, qui lui même communique avec la base de donnée. Le gros avantage, c'est la sécurité des données.

L'inconvénient, c'est que c'est moins rapide. Il y a plusieurs sauts. Ui ver Métier, Métier vers Data. Autre problème, surcharge du serveur. Solution : acheter un meilleur serveur.

Le prof il veut nginx qui fait du load balancing, avec un cluester pour la bdd. Et tuer des containers en démo.



### Web Service

Pas une seule application, mais par exemple deux. Une pour la gestion des issues, une autre pour la gestion des tasks. Il y aura un serveur portail qui lui ira tapper dans les deux services.



### Micro-service

un appli par utilisateur, problème de synchro entre les bdd.