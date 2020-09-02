# Conception Formelle

> alain.griffault@u-bordeaux.fr
> [Lien du cours](http://dept-info.labri.fr/~griffaul/Enseignement/CF_M1/)

[TOC]

# Introduction
## Quelques faits

* En 1985, la banque de New-York à subit une coupure de ses services, suite à un débordement d'entier lors d'une incrémentation.
* En 1990, ATT a cessé de fournir ses services pendant 9 heures, suite à un break oublié dans un switch.
* En 1994, un bug a été trouvé dans les processeurs Pentium d'Intel, l'obligeant à remplacer les processeurs.
* En 1996, une fusée Arianne 5 s'est auto-détruite, suite à une convertion d'un format 16bits vers 64bits.

Il y a des limites aux méthodes traditionnelles de développement logiciel.
* Coût des tests
* Ambiguité des méthodes semi-formelles (UML)
* Les patterns en POO sont bien, mais parfois il n'en existe pas.
* Ajouter de nouvelles fonctionnalitées sans régression est difficile.

## Le concept de la méthode formelle

**But et approche :**
* Être capable de raisonner sur les logiciels et les systèmes, pour prédire leurs comportements.
* Les systèmes sont des objets mathématiques.

**Process :**
* Créer un modèle formel du système (ou logiciel).
* Analyser ce modèle avec une méthode formelle adéquate.
* Traduire le résultat de ce modèle en un système réel.

**Problèmes :**
* Est-ce que le modèle et réaliste et correcte ? *validation*
* Peut-on vérifier tous les modèles ? *décidabilité*
* Peut-on toujours traduire le résultat ? *abstraction*


Pour des raisons économiques, seul les projet complexe et/ou critiques bénéficient d'une approche formelle.
Un système est dit critique lorsque :
* Des vies dépendent de son fonctionnement. C'est le cas des logiciels embarqués dans le domaine du transport.
* Le coût économique d'un échec est énorme.





# Première partie
