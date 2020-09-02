# Architecture Logiciel

[TOC]

## Sources bibliographiques

Ce cours est basé sur deux ouvrages élémentaires pour tout programmeur dans un langage objet.

* *Modélisation et conception orientées objet avec UML 2.0*, Michael Blaha & James Rumbaugh

* *Design patterns. Catalogue des modèles de conception réutilisables.* Eric Gamma, Richard Helm, Ralph Johnson, John Vissides.

## Évaluation

**Examen :**
* Épreuve sur table de trois heures portant sur tout le cours et sur tous les travaux dirigés.

**Contrôle continue :**
* Compte rendu de TD par groupe de 2 déposés sur moodle
* Un mini projet à la fin des TD


## Rappels

### Qu'est-ce que l'orienté objet ?

Développer en orienté objet signifie organiser son logiciel sous la forme d'une collection d'objets indépendants qui incorporent à la fois une structure de données et un comportement.

### Les 4 caractéristiques de l'approche objet

**L'identité :** Signifie que les données sont organisées en entités discrètes et distinguables nommées objets.

**La classification :** Signifie que deux objets possédant la même structure de données et de même comportement sont des représentatns d'une même classe.

**L'héritage :** Est le partage des attributs et des opérations entre les classes sur la base d'une relation hiérarchique. Une *super classe* possède des informations générales que les sous classes spécialisent et décrivent en détail.

**Le polymorphisme :** Signifie que les mêmes opérations peuvent se comporter différemment dans des classes différentes.


## Modélisation versus implémentation

L'objectif de la modélisation est de se détacher des langages de programmation afin d'élaborer le logiciel à un niveau plus abstrait.

Le développement d'une application complète prend bien plus de temps que la modélisation de celle-ci. Une erreur de conception détectée pendant l'implémentation peut obliger à tout recommencer.

### Les trois modèles de la modélisation objet

1. **Le modèle de classe :** décrit la structure statique des objets d'un système et de leurs relations. Un diagramme de classe est un graphe dont les noeuds sont des classes et les arcs des relations entre ces classes.

2. **Le modèle d'états :** décrit les états successifs d'un objet au cours du temps. Un diagramme d'état est un graphe dont les sommets sont des états et les arcs des transitions entre les états.

3. **Le modèle d'interaction :** décrit la façon dont les objets d'un système coopèrent pour obtenir un résultat. Il commence par les cas d'utilisation qui sont détaillés par les diagrammes de séquence et des diagrammes d'activités. Un cas d'utilisation est axé sur une fonctionnalité.

### Modélisation des classes et objets en UML 2.0

Un modèle de classe/objet capture la structure statique d'un système en caractérisant les objets de ce système 