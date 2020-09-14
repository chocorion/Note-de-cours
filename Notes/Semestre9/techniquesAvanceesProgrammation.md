# Techniques Avancées de Programmation

[Site du prof](https://dept-info.labri.fr/~narbel/TAP/)

Évaluation : 

* 50% de CC, certains exercices des td seront donnés à faire, avec quelques questions en plus.
* 50% examen 1h30

Il n'y aura pas de gros projet.

#### Objectifs du cours

Comprendre, appliquer et maitriser les techniques associées aux styles de programmation moins connus que l'impératif ou l'orienté objet, en particulier la programmation fonctionnelle et la programmation généérique, mais aussi la programmation générative, la programmation réflexive, la programmation modulaire typée, et la programmation par aspects. Il s'agira également d'apprendre à tirer parti de mélanges entre styles de programmation, comme par exemple celui du fonctionnel/orienté-objet. 

Langages de programmation utilisés  : Ocaml, Java, C# et AspectJ, mais aussi C++, Python, Javascript et Scala, ainsi que Haskell, D, CLOS, rust, julia, racket, groovy, kotlin, swift etc...

Ce cours c'est une reflexion générale sur les langages. 

Bouquin du prof : *Programmation fonctionnelle, générique et objet (une introduction avec OCaml). Narbel. Vuibert, 2005.*



La question de base c'est : Est-ce qu'on peut attendre des progrès de la part des languages de programmations ?

Déjà, pourquoi un language ? 2 qualités. 

* La facilité avec laquelle on s'exprime, la flexibilité (ce sont par exemple les qualitées de js/python, pas haskell)
* Il faut que ce soit vérifiable, valide, performant. Que ça marche quoi.

Ces deux propriétés sont incompatible. On ne peut donc pas attendre des progrès, ils sont difficiles. Mais c'est ce qui explique la multitude des languages. Chacun représente un compromis. 

Les points de progrès:

* Théorie des types.

* Il y a la rationalisation de la pratique.

  * paradigme

  * design patterns

  * principes (SOLID, principalement L pour substitution de Liskov, O pour Open/Close, S pour Single responsability, I pour Interface Segregation, D pour Dependency inversion)

  * DSL (domain specific language), par exemple sql

    \+ Framework

Dans ce cours, on va regarder les paradigmes.