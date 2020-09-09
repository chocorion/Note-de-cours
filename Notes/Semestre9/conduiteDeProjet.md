# Conduite de Projet



Deux petites vidéos du prof en lien avec le cours : 

<iframe width="560" height="315" src="https://www.youtube.com/embed/vhpcngRVE_A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<iframe width="560" height="315" src="https://www.youtube.com/embed/VWhLcgo9z74" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



## Introduction

### Comment se déroulera le cours ?

[https://www.labri.fr/perso/xblanc/teaching.html](Lien du site du prof)

[Cours sur github](https://github.com/xblanc33/QualiteDev)

Il y a 6 fichiers, avec des 5 éléments de qualités sur chaque fichier. Ça fait 30 points de contrôl. On sera noté sur 30, faut donc tout savoir.

> Bien faire les choses vs faire bien

Dans ce cours, c'est *Bien faire les choses*.

Les 6 artefacts sont : 

* Issue
* Task
* Test
* Code
* Doc
* Release

Une semaine par artefact, puis 6 semaines de projet. Équipe de 3, tirées aléatoirement. Le but de projet, c'est de créer notre propre jira. Outils qui permet de gérer les 6 artefacts. Obligation de moyens (vs obligation de résultat), le projet sera impossible à réaliser en 6 semaines. 3 sprints de 2 semaines. Il y aura des revues à la fin de chaque sprint.



## Premier artefact : Issue



> Aussi *user storie* dans scrum. Back log, liste des issues

Génie logiciel $\rightarrow$ Production Logiciel, donc production.

MOA : Maitrise d'ouvrage, MOE : Maitrise d'oeuvre. (Question d'examen)

MEP : Mise en production, moment ou les utilisateurs peuvent utiliser le logiciel. Avant la pro, pre-prod (tests, etc...)

Être bon, c'est faire la mise en prod le plus rapidement possible, tout en ayant un logiciel de qualité (*Accelerate* | *Quality*). TMA: Le logiciel retourne dans le cycle de dev, pour traiter les anomalies. Mort du logiciel ? Quand on coupe la machine, et que personne n'appel. 

Dans cette ue, on va ne s'occuper que du cycle de dev. On s'arête avant la pre-prod. 



L'owner (MOA, maitrise d'ouvrage) exprime un besoin, réalisé par le dveloppeur (MOE, maitrise d'oeuvre). Utiliser Propriétaire/Utilisateur/Développeur à la place de client etc. Le client est un rôle qui peut changer. L'utilisateur est le client du propriétaire, mais le propriétaire est le client du développeur.

Le logiciel nait quand le propriétaire exprime le besoin. Le besoin est ensuite validé, puis spécifié (on rentre dans les détails). Il pourrait également être prototyper. Et à un moment donné, il est réalisé. Jira est un outil qui permet de gérer les étapes de ces besoins. Dans les besoins, on va principalement travailler sur les besoins de nouvelle fonctionnalitées. Pas les bugfix ou amélioration.



### Les règles des issues



1. Les issues doivent avoir un id unique, qui permet de suivre leur évolution.
2. Les issues doivent être précises. Si c'est pas précis, on peut pas tester et vérifier que c'est bon.
3. Les issues doivent être homogènes. Au lieux de #1 jouter, #2 modifier, #3 supprimer : #1 CRUD. CRUD peut-être un peu trop d'un coup, faut une juste millieu. Scénario à valeur ajoutée. Donc crud, pas bon.
4. Qualifier type, importance, coût. Le type peut être par exemple *BugFix*, *New feature*, ... Certaines issues sont plus importantes que d'autres pour le propriétaire. Les issues doivent être classés par importance (High, Medium, Low). Le coût n'est pas en euro, mais en *comparaison*. On suit la de fibonacci (1, 2, 3, 5, ...).
5. Planification.

List des issues que les devs espèrent pouvoir réaliser (spécifiées en lisant le cdc) = backlog. Pour le premier td, il faudra créer `issue.md`. Ensuite  il faut la planification. Pour chaque sprint, mettre les issues à réaliser.