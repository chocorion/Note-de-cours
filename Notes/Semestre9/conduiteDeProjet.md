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



Diagramme de Pert : 



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



Version à la main : 

|       | 1    | 2    | 3    | 4    | 5    | 6    | 7    | 8    |      |
| ----- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- |
| Alice | X    | X    | X    | T1   | X    | X    | T5   | T6   |      |
| Bob   | T4   | T4   | T3   | T3   | X    | X    | T7   | X    |      |

