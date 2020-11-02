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



#### Petite révision sur la pureté

Une fonction pure ne doit pas forément être total, c'est un peu flou. Mais par exemple :

```c
int f(int j) {
    return j + 4;
}
```

Cette fonction est pure. Mais en réalité, elle n'est pas totale. Il est possible de réaliser un overflow. Donc 1/x, pure aussi, même si ça plante en 0.

Si les effets de bord sont confinés, c'est ok. Car on veut juste une correspondance, sans ne rien observer à l'extérieur.



#### Formes de la partialité

- Boucle infinie, non-terminaison.
- arrêt impromptu.
- Non spécifié (division par 0), donc arbitraire.
- Levée d'exceptions
- résultats sous forme de valeur spéciales. (1/0 qui renvoi *inf*).



#### Transparence référentielle

$h(f(x_1, x_2), z(y_2), p(3, 4, 5), 7)$, quel que soit l'ordre d'évaluation, même résultat. Si une expression est composée d'appels à des fonctions pures totales, alors il y a transparence référentielle. Il y a donc une différence avec l'impératif, l'ordre des choses n'a plus d'importance. Car avec les effets de bords, il faut contrôler l'ordre des changements d'états. 

Ici, nous avons ce qu'on appel de la programmation *déclarative*. 



*Théorème Church-Rosser:* Si une expression est constituée de fonctions pures (pas necessairement totale), si on obtiens un résultat, c'est toujours le même.

Les bonnes propriétées de induites par la pureté :

- parallélisation "gratuite"
- raisonnement équationnel (Si on a une fonction pure, $f(1) - f(1) = 0$, equationnel car on est sur de l'égalité.)
- optimisations (mémoïsation)
- tests plus simple
- vérifiabilité facilitée

Mais il y a égalemment des contraintes (liste dans le poly).



### Première classe

> Un type de bloc de construction (des instruction, des fonctions, des objets, des classes, des modules...) est de première classe, s'il possède 5 propriétées : 
>
> 1. Le boc peut être nommé.
> 2. On peut le définir n'importe où dans un programme (on peut donc avoir une forme anonyme).
> 3. On peut le passer en paramètre d'une fonction
> 4. On peut le recevoir en retour de l'appel d'une fonction. Ça peut être un résultat.
> 5. On peut le stocker dans n'importe qu'elle structure de donnée.

En anglais, on parle de *first class citizen*. Un entier est de première classe.

**Remarque :** Les fonctions peuvent être de première classe.

La première classe nécessite les types. Si le typage est statique, il faut des notations pour ces types.

Java 8, interfaces fonctionnelles : Ce sont juste des interfaces qui définissent une seule méthode abstraite. On se retrouve un peu dans le cas du délégué en C#. Ça devient un type de valeur fonctionnelle.



```ocaml
let f = sin;;; (* named *)

let f = fun x -> x + 3;; (* anonymous function *)

let approx_deriv (f, epsilon, x) =
	(f (x +. epsilon) -. f (x -. epsilon)) /. (2. *. epsilon);; (* parameter *)
	
```



En C, les pointeurs sont de première classe, pas les fonctions elle-même. On peut passer un pointeur sur une fonction existante, mais pas directement une fonction. Pas de lambda expression.



```c++
struct my_fun {
    int val;
    void initialize (int n);
    int operator() (int n, in tp);
}

int my_fun::operator() (int n, int p) {
    return n + p + val;
}

my_fun f_obj;
f_obj(2, 3);
```

En C++, redéfinition de l'opérateur ().



### Closures (fermetures)



*Définition :* Une fermeture est une fonction avec un environnement privé.

```ocaml
let a = 10;

let f = fun x -> a + x;;

(* Changer a ne change pas le comportement de f *)
```

Remarque : Si une ref est capturé dans une fermeture, le ramasse-miette ne peux pas travailler.

Si on a les notions de fermeture, et d'impératife, on a possiblement une notion d'objets avec états.



## Techniques de programmation fonctionnelle

### Utilisation des $\lambda-expression$

Propriété 2 de la première classe implique les $\lambda-expression$. C'est la forme anonyme d'une fonction. Mais également la propriété 3, qui permet l'insertion rapide de code. Ça permet la simplification de l'architecture.

Inconvénients : 

1. Manque de réutilisabilité, pas de nom.
2. Destructuration du code, car les lambda expression apparaissent partout.

Il y a une règle implicite, les $\lambda-exp$ sont courtes.

### Curryfication et les l'applications partielles

Quand les fonctions sont longues, n argument, on peut les voire comme n fonctions unaire emboitées (Propriété 4 et 1). Prenons la fontion binaire : `fun (x, y) -> x + y`, on va faire `fun x -> (fun y -> x + y)`.

```ocaml
let f1 x y = x + y + 1;;

let f_partial = f1 3;; (* partial application *)
f_partial 4;; (* 8 *)
```

Il y a un inconvénient : Il faut composer dans un certain ordre. Pour résoudre ce problème, on peut utiliser l'inversion `let inv f x y = f y x;;`. En ocaml, on peut aussi mettre un label sur les paramètres pour pouvoir les cibler directement.



### Généralisation fonctionnelles

On transforme 

```javascript
function twiceSqrt(x) {
    return sqrt(sqrt(x));
}
```

en

```javascript
function twiceGen(g, x) {
    return g(g(x));
}
```



Une fonction générique est une fonction dont le type est générique. La fonction identitée `let id x = x;;` Comment typer x ? $'a$.

La généralisation nous permet de structurer le code :

1. separation of concerns
2. factorisation du code



### Décorateur fonctionnels (around function)

Exemple avec la mémoisation : 

```python
def memoize(f):
    mem = {}
    def wrap():
        if x not in mem:
            mem[x] = f(x)
            print("compute")
         return mem[x]
    return wrap

@memoize
def fibo(x):
    if x < 2:
        return 1
   return fibo(x - 1) + fibo(x - 2)
```


### Stratégie fonctionnels

En gros l'exo 2 du td 4

### Généralisations pour la gestion de données

1. constructeurs
2. filtres
3. map
4. fold/reduce