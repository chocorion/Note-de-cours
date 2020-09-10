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