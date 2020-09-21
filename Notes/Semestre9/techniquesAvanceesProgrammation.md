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





## Avancées dans les langagues de prog



*Définition :* Un type, c'est une collection de valeurs qui partagent les mêmes propriétés.

*Définition :* Un système de type est un système de formel qui classifie les valeurs d'un programme en type, et à l'aide d'un ensemble de règle nous avons la vérification de certaines propriétées du programme.

*Définition :*  

* Un système de type statique agit sur le code source. Ce type de système permet d'approximer l'exécution d'un programme. Par exemple, si on a une fonction, elle prend un entier et elle renvoie un entier. C'est une approximation.
* Un système de type dynamique est un système qui agit sur le code, pendant son exécution.

Ocaml est static. Inférence de type, y compris pour la gnéricité `'a`.

Théorie des types, éléments applicables en prog : 

* polymorphisme
* inférence (C++ depuis 11: `auto x = 1;`)
* typage optionel/graduel (annotation optionnel, python, typescript)
* typage d'éléments (typage de module en ocaml)



## Deux propriétés de base de la programmation



Ces deux propriétés sont : 

1. pureté
2. la 1° classe

### Pureté

Une fonction implémentée : une fonction mise sous une forme exécutable. Cette fonction a plus e propriétées qu'une fonction juste déclaré : 

* Elle peut ne pas se terminer,
* elle a une complexité
* ....

*Définition :* Une fonction de $D \rightarrow R$ est totale si elle es définie sur tout $D$; elle est donc *partielle* sinon.

Une fonction implémentée $D \rightarrow R$  est totale si elle donne un résultat pour tout $D$. Ici, $D$ c'est tous les arguments possibles de la fonction. Une **fonction pure** est donc une fonction implémentée totale et qui respecte strictemetn la définition mathématique d'une fonction : 

- Pour tout argument $x$, il existe un unique résultat $f(x)$.
- Le seul effet observable, c'est le retoure de $f(x)$  (cad, pas d'effet de bord).

```c
// Pure : 
int t(int j) {
    return j + 4;
}

// Non-pure :
int i = 42;
int g(int j) {
    i+=j;
    return i;
}

// N'est plus pure :
int i(int j) {
    printf("Coucou !\n");
    return j + 4;
}

// Toujours pure :
int f(int j) {
    int i;
    i = j + 4; // internal assignment
    return i;
}
```

La pureté est donc un indépendance encapsulée. 

$f$ pure : $f(1)$ - $f(1)$ = 0.

$g$ non pure : $g(1)$ - $g(1)$ = ?