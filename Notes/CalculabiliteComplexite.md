# Calculabilité et Complexité

[TOC]



## Objectifs

Définir, __indépendamment de la technologie__ :

* Ce qui est calculable et ce qui ne l'est pas (théorie de la calculabilité)
* Ce qui est calculable efficacement et ce qui ne l'est pas (théorie de la complexité)

### Exemples
#### Calculabilité
Est-ce qu'il existe une façon systématique de savoir si la calcul d'un programme quelconque se termine.
#### Complexité
Problèmes d'ordonnancement (Airport gate scheduling, multi-core scheduling).

## Plan
* Présentation, bref historique
* Complexité
	- Problèmes et réduction
	- P vs NP
* Calculabilité
	- Ensembles dénombrables (rappels)
	- Programme while, machines de Turing
	- Décidabilité

## Histoire brève de la calculabilité

* Wilhem Schickard (1592 - 1635) : Invente la machine à calculer mécanique.

* Blaise Pascal (1623 - 1662) : *Pascaline* première machine à calculer mécanique opérationnelle.
* Gottfried Wilhem Leibniz (1646 - 1716) : Machine de calcul universelle, schéma *entré-calcul-sortie*, base 2 pour représentation des nombres.
* Joseph Marie Jacquard (1752 - 1834) : Métier à tisser basée sur l'utilisation de carte perforées.
* Charles Babbage (1791 - 1871) : Construit machine différentielle et analytique (unité de contrôle, mémoire, entrée-sortie)
* Ada Lovelace (1815 - 1852) : Travail avec Babbage, premier programmeur de monde.
* David Hilbert (1862 - 1943) : Entscheidungsproblem
* Kurt Gödel (1906 - 1978) : Codage de Gödel.
* Alfred Tarski (1901 - 1954) : Axiomatise la géométrie euclidienne.
* Alan Turing (1912 - 1954) et Alonzo Church (1903 - 1995) : Machine de Turing, lambda calcul, thèse Church-Turing.

### Que signifie P =? NP

En gros, on se limite à des problèmes qui possèdent un espace exponentiel de solutions et on se demande s'il existe un algorithme polynomial qui permet de trouver une solution.

## Complexité

### Problèmes et réductions

Avant de formaliser P =? NP, on va se familiariser avec les notions de problèmes et réduction entre problèmes.

Un problème de *décision* A est :

* Une question portant sur un ensemble de données dont la réponse est **OUI** ou **NON**.

> Ne pas confondre problème et algorithme le résolvant.

* Une instance du problème A est la question posée sur une donnée/entrée particulière de A

> *Problème* : Savoir si un graphe non orienté est connexe
>
> *Instance* : V = {1, 2, 3, 4, 5}; E = {(1, 2), (2, 3), (3, 1), (4, 5)}
>
> *Algorithme* : DFS

On s'intéresse aussi aux *problèmes calculatoire*, dont la réponse n'est pas nécessairement binaire.

> Calculer les composantes connexes d'un graphe non orienté.

On s'intéresse aussi aux problèmes d'*optimisation* .

> Calculer un cycle de longueur minimal dans un graphe.

### Temps de calcul

Le temps de calcul d'un programme (algorithme) P se mesure en fonction de la taille de l'entrée.

Soit I une entrée de P.

* $t_{p}(I)$ désigne le temps de calcul de P sur I. C'est le nombre d'instructions élémentaire exécutées.

* Le fonction $t_{p}: \mathbf N \rightarrow \mathbf N$ est définie par : $T_p(n) = max \{ t_p(I) | taille(I) = n \}$.

  Il s'agit du temps de calcul *au pire cas*.

Un algorithme P est *polynomial* s'il existe un polynôme p(n) tel que $T_{p}(n) \leq p(n), \forall n $.

Un algorithme P est *exponentiel* s'il existe un polynôme p(n) tel que $T_{p}(n) \leq 2^{p(n)}, \forall n$.

> Problème facile à résoudre $\rightarrow$ algorithme polynomial.

### SAT et réduction

SAT est un problème de la classe NP. Il prends en entrée des formules booléennes (propositionnelles).

$\varphi = 0\ |\ 1\ |\ x\ |\ \neg(\varphi)\ | \ (\underbrace{\varphi\ \lor\ \varphi}_{disjonction})\ |\ (\underbrace{\varphi\ \land\ \varphi}_{conjonction}),\ x \in X$.

#### Forme normales

##### Disjonctive ("DNF")

Disjonction de conjonctions.

$C_{1} \lor C_{2} \lor\  ...\ \lor C_{n}$.

$C = l_{j1} \land l_{j2} \land\ ...\ \land l_{jn},\ l_{j} \in \left\{x,\ \neg x\right\},\ x\in X$

##### Conjonctive ("CNF")

$C_{1} \land C_{2} \land\  ...\ \land C_{n}$.

$C = l_{j1} \lor l_{j2} \lor\ ...\ \lor l_{jn},\ l_{j} \in \left\{x,\ \neg x\right\},\ x\in X$



#### Formule en CNF

$(x_{1} \lor \neg x_{3} \lor \neg x_{4}) \land (\neg x_{1} \lor x_{2} \lor x_{3})$

$X = \left\{ x_{1},\ x_{2},\ x_{3},\ x_{4} \right\}$ .

C'est une formule *3-CNF* : Chaque close est de longueur 3.

$\varphi \rightarrow Var(\varphi)$ = Ensemble des variables de $\varphi$. 

Étant donné $\varphi$, avec $Var(\varphi) = X$, est-ce qu'il existe une affectation $\sigma:X \rightarrow \left\{0,\ 1\right\}$ tel que la valeur de $\varphi$ sous $\sigma$ est 1.

$\sigma = \left\{\begin{array}{ll}x_{1} \rightarrow 0 \\ x_{2} \ \rightarrow 1 \\ x_{3} \rightarrow 1 \\ x_{4} \rightarrow 0\end{array}\right.$ 	Ici, $\sigma$ est une valuation qui satisfait $\varphi$. La valeur de $\varphi$ sous $\sigma$ est 1.

Une formule est satisfesable s'il existe une affectation $\sigma$ tel que la valeur de $\varphi$ sous $\sigma$ est 1.

Le problème SAT prends en entrée une formule en CNF $\varphi$, et la question est *est-ce que $\varphi$ est satisfesable ?*

Si $\varphi$ possède n variables, on peut naïvement tester tous les $\sigma$, et trouver un qui satisfait $\varphi$. C'est exponentiel, car il y a $2^n$ $\sigma$. Mais pour une affectation donnée, on peut déterminer la valeur de $\varphi$ sous $\sigma$ en $\mathcal{O}(n)$.

Sinon, on peut utiliser un *sat-solveur* (glucose, Z3, ...).

Il existe également le problème *3-SAT*. Ce problème prends en entrée une formule 3-CNF, et la question est *est-ce que $\varphi$ est satisfesable*. C'est un problème difficile, autant que SAT (explication plus loin).

Il y a également le problème *2-SAT*, qui prends en entrée une formule 2-CNF, mais celui-ci est *facile* à résoudre.

#### Réduction

La réduction est une notion générale. Mais dans le cadre de la classe NP, on s'intéresse aux réductions polynomiales. Si on a deux problèmes, A et B, on peut se servir de réduction pour les comparer. Soit $X_{a}$ l'ensemble des entrées de A, et $X_{b}$ l'ensemble des entrées de B.

Une réduction de A vers B est alors : $f: X_{a} \rightarrow X_{b}$, tel que $\forall\ x\in X_{a}$,  $x$ est instance positive de A si et seulement si $x$ est instance positive de B.

Si A se réduit en B, alors on peut résoudre A en se servant de l'algorithme pour B. $\rightarrow_{x} f \rightarrow_{f(x)} B \rightarrow oui/non$. On écrit alors $A \le B$. Et si la réduction est polynomiale, $A \le_{p} B$.

3-SAT $\le_{p}$ SAT car 3-SAT est un cas particulier de SAT.



##### $SAT \le_{p} 3-SAT$

$ \underbrace{\varphi}_{cnf} \rightarrow \underbrace{\hat{\varphi}}_{3-cnf} $  Idée : rajouter des variables à $\varphi$. Les variables de $\varphi$ seront inclues dans $\hat{\varphi}$.

* Soit $\sigma$ valuation de $\varphi$ qui rends $\varphi$ vrai, on peut trouver une extension de $\sigma$ qui rends $\hat{\varphi}$ vrai.
* Si $\sigma$ valuation de $\hat{\varphi}$  qui rends $\hat{\varphi}$ vrai, on peut trouver un restriction sur $\sigma$ qui rends $\varphi$ vrai. (Vérifier poly, inverse ?)

##### $ CNF \rightarrow\ 3-CNF$

Plusieurs cas :

* $|C_{j}| = 1$
* $|C_{j}| = 2$
* $|C_{j}| > 3$
* $|C_{j}| = 3$, $C_{i} = \varphi_{i}$.

$C_{i} = l,\ l \in \left\{ x_{i},\ \neg x_{i}: 1 \le i \le n\right\}$.



Pour le premier cas, $|C_{j}| = 1$, nous avons besoin d'ajouter deux nouvelles variables:

$\varphi_{j} = (l_{1}\ \lor\ t\ \lor\ z) \land(l_{1}\ \lor\ \neg t\ \lor\ z)\land(l_{1}\ \lor\ t\ \lor\ \neg z)\land (l_{1}\ \lor\ \neg t\ \lor\ \neg z)$.

Pour le second, $|C_{j}| = 2$, une seule nouvelle variable est nécessaire :

$\varphi_{j} = (l_{1}\ \lor\ l_{2}\ \lor\ t) \land(l_{1}\ \lor\ l_{2}\ \lor\ \neg t)$

Pour le dernier cas, $|C_{j}| > 3$, $C_{j} = l_{1}\ \lor\ l_{2}\ \lor\ ...\ \lor l_{k}, k > 3$, nous avons besoin de k - 3 nouvelles variables.
$$
\varphi_{j} = (l_{1}\ \lor\ l_{2}\ \lor\ t_{1}) \land(\neg t_{1}\ \lor\ l_{3}\ \lor\ t_{2}) \land(\neg t_{2}\ \lor\ l_{4}\ \lor\ t_{3}) \land\ ...\ (\neg t_{k - 3}\ \lor\ l_{k - 1}\ \lor\ l_{k})
$$
$\hat{\varphi}$ quadratique en la taille de $\varphi$.

SAT $\le$ 3-SAT en réduction polynomiale, nous avons donc bien que 3-SAT est aussi difficile que SAT.

##### Coloriage

k-col: Entrée : Graphe G = (V, E) non orienté.

​		  Question: Peut-on colorier V avec k couleurs tel que deux sommets adjacent n'aient pas la même couleur. On chercher à savoir s'il existe $c:V\rightarrow\left\{1, ..., k\right\}$ tel que $c(u) \ne c(v), \forall (u, v) \in E$. On peut savoir si $c$ est solution en temps $\mathcal{O}(|E|)$.

Pour 2-col, on sait trouver une solution en temps polynomial, pour 3-col on sait seulement la vérifier.



###### Vérificateur

Un vérificateur pour un problème A est un algorithme qui prends $(x, y)$ en entrée, $x$ étant une instance de A, et vérifie qui $y$ est bien une preuve que $x$ est un instance positive.



A: 3-col

Vérificateur V:

* $x$ graphe de la forme G = (V, E)
* $y$ coloriage $c: V \rightarrow \left\{1, 2, 3\right\}$.

V prends en entré (G, $c$), et vérifie que $c$ est un bon coloriage en temps polynomial.

G est 3-coloriable $\iff \exists\ c:V\rightarrow\{1, 2, 3\}$ tel que $V$ accepte (G, $c$).



A: Sat

* $x$ formule propositionnelle $\varphi$ avec $var = x_1,\ ...,\ x_n$
* $y$ valuation $val: \{x_1,\ ...,\ x_n\} \rightarrow \{0,\ 1\}$.

V prends en entrée <$\varphi$, val> et vérifie que val satisfait $\varphi$. Vérification en $\mathcal{O}(|\varphi|)$.

#### P - NP

$P \subseteq NP$ : Il nous faut un vérificateur en temps polynomial. Or un vérificateur pour un problème A de la classe P est tout simplement l'algorithme A lui-même, avec $y$ vide.

Prenons A et B deux problèmes, et supposons que $A \le_p B$. Si B peut être résolu en temps polynomial, A peut aussi être résolu en temps polynomial.

Si $A \le_{p} B$ et $B \in NP$, alors $A \in NP$.

Pour montrer ça, prenons y certificat de B, V un vérificateur pour B et f la fonction de réduction polynomial. On peut construire un vérificateur V' pour A qui prends en entrée <x, y>.

V' calcul tout d'abord $f(x)$. Ensuite V' simule $V<f(x), y>$, et retourne la même réponse. Comme la taille de y est polynomial en la taille de $f(x)$, qui elle même est polynomial, V' est bien polynomial.



|                         NP | NP                         |
| -------------------------: | :------------------------- |
|         3-col      $\le_p$ | 3-SAT                      |
| graphe       $\rightarrow$ | $\varphi$                  |
|     G 3-coloriable $\iff $ | $\varphi$ est satisfesable |

Variable de $\varphi$ $v_i,\ v \in V,\ i\in\{1, 2, 3\}$. Nombre de variables : 3|V|

*Sémantique* de $v_i$ : $v_i = 1 \iff couleur\ v = i$.

Les clauses expriment le fait qu'on a un coloriage.

1. Chaque sommet à au moins une couleur :  $\wedge_{v \in V}(v_1\lor v_2 \lor v_3)$.
2. Un sommet n'a pas deux couleurs : $\land_{v\in V}((\bar v_1\lor \bar v_2)\land(\bar v_2 \lor \bar v_3) \land (\bar v_3 \lor \bar v_1))$.
3. Deux sommets voisins n'ont pas la même couleur. $\land_{(u,\ v) \in E}\ \land_{i = 1, 2, 3} \underbrace{(\bar u_i \lor \bar v_i)}_{n'ont\ pas\ la\ couleur\ i}$.

$$
\varphi = \varphi_1 \land \varphi_2 \land \varphi_{3}
$$

Vérification que c'est bien une réduction (polynomiale) :

1. On peut construire $\varphi$ en $\mathcal{O}(|G|)$. Taille de $\varphi = 4|V| + 3|E|$, $|G| = |V| + |E|$.

2. *G est coloriable si et seulement si $\varphi$ est satisfesable.* 

   Si G est 3-coloriable: $c: V \rightarrow \{1, 2, 3\}$ est un bon coloriage. $val(v_i) = \left\{ \begin{array}{ll} 0,\ c(v) \ne i\\1,\ c(v) =i\end{array}\right.$

3. *$\varphi$ est satisfesable, alors G est 3-coloriable*.

   On a $val: \{v_1,\ ...\ v_i\} \rightarrow \{0,\ 1\}$ qui satisfait $\varphi$. La coloration est donc c(v) = i si val($v_i$) = 1.

**À retenir**

* Expliquer qu'un problème est NP (certificat - vérificateur *polynomial*) 
* Réduction polynomial vers SAT.

|        | Certificat                                             | Vérificateur                                                 |
| ------ | ------------------------------------------------------ | ------------------------------------------------------------ |
| SAT    | Valuation $val:\{x_1, ..., x_n\} \rightarrow \{0, 1\}$. | $V<\varphi, val>$ et vérifie que val satisfait $\varphi$.    |
| 3-Col  | Coloration $c:V\rightarrow\{1,2,3\}$.                   | $V<G, col>$ et vérifie que les couleurs des sommets sont deux-à-deux différentes. |
| Clique | $U \subseteq V,\ |U| = k,\ (k \le |V|)$. | $V<G, U>$ et vérifie que $(u, v) \in E, \forall u, v \in U, u\ne v$ |

Clique : G = (V, E), $U \subseteq V$ est une clique si $(u, v) \in E, \forall u, v \in U, u\ne v$. Le problème clique est de savoir, pour un graphe G, s'il existe une clique de taille k.

On peut facilement trouver un algorithme naïf en $\mathcal{O}(n^k*k^2)$. Mais attention, ce n'est pas polynomial ! À cause de k qui n'est pas fixé à l'avance. On peut très bien avoir $k = n/2$.



#### Exemples

##### Linear programming (LP)

*Entrée :* Matrice A, vecteur $\vec b$, tous les coefficients entiers.

*Question :* Est-ce que $A\vec x = \vec b$ possède une solution ?

Ce problème est dans *PTime*. On va s'intéresser ici à une variant de ce problème.

**Integer linear programming(ILP)** 

*Entrée :* Même que LP.

*Question :*  Est-ce que $A\vec x = \vec b$ possède une solution dans les entiers ?

Le problème ici est l'écriture des solutions, qui est exponentielle. ILP est un problème de la classe NP.

##### Vortex Cover

*Entrée :* G = (V, E), entier k

*Question :* Est-ce qu'il existe $U \subseteq V, |U| = k$, tel que $\forall (u, v)\in E, u \in U\ \lor\ v \in U$ ?

**Certificat :** Ensemble de k sommets (polynomial, k $\le |V|$ )

**Vérificateur :** Prends en entrée <G, U>, vérifie que $U \subseteq V$ et $\forall (u, v)\in E, u \in U\ \lor\ v \in U$.

##### Circuit Hamiltonien

Circuit que passe par chaque sommet d'un graphe exactement une fois.

**Certificat :** Séquence de n sommets, $n = |V|$. Par exemple 3, 7, 1, 4, 2, 6, 5

**Vérificateur :** Vérifie que (3, 7), (7, 1), ..., (5, 3) $\in E$. ($\mathcal{O}(n^2)$)



---------------------

Problème A:

1. Montrer $A \in NP$ (facile)
2. Montrer $A \le_{p} SAT$ (moyen)
3. Montrer $SAT \le_{p} A$ (difficile)

#### NP-Complet

Ce sont les problèmes les plus difficiles de la classe NP.

A est NP-difficile si $\forall A' \in NP, A' \le_{p} A$. Si en plus $A \in NP$, alors A est NP-Complet. Un problème NP-difficile pour ne pas être dans NP !

Si on admet que SAT est NP-Difficile : $\forall A \in NP,\ A \le_{p}SAT$. Nous avons aussi $SAT \le_{p}3-SAT$. Comme la réduction est *transitive*, nous avons $A \le_{p}3-SAT$

###### Réduction 3-SAT vers Clique

$3-SAT \le_p Clique$

$\varphi \longmapsto G, k$

$\varphi $ satisfesable $\Leftrightarrow$ G possède clique de taille k. ​



* Soit $\varphi = (l_0 \lor l_1 \lor l_2)\land...\land(l_{3k-3}\lor l_{3k-2} \lor l_{3k - 1})$.
* Le graphe $G_{\varphi}$ a $3k$ sommets $l_0, ..., l_{3k - 1}$.
* Deux sommets $l_i, l_j$ sont reliés si
  * Ils ne proviennent pas de la même clause ($i/3 \ne j/3$)
  * Ils ne sont pas de la forme $l,\ \neg l$.
* On choisit l'entier $K_{\varphi}$ égal à $k$.
* On vérifie que $G_{\varphi}$ a une clique de taille $K_{\varphi}$ si et seulement si $\varphi$ est satisfesable.

(Fonctionne exactement de la même manière avec le problème SAT)



G contient une clique de taille k $\Leftrightarrow$ $\varphi$ est satisfesable.

1. Si G contient une clique $c$ de taille k, $c$ est constituée de exactement un littéral par clause. Dans $c$, on a pas $x$ et $\neg x \Rightarrow$ on peut mettre tous les littéraux à Vrai. $c$ est une valuation qui satisfait $\varphi$.

2. Si $\varphi$ est satisfesable :

   * val satisfait $\varphi$.
   * il n'y a jamais $x$ et $\neg x$ 
   * il y a au moins un littéral vrai par clause.

   On en choisi 1 $\Rightarrow$ Clique de taille $k$.

-------------------
*Théorème (Cock, Levin):* SAT est NP-Complet. $\forall A \in NP: A \le_p SAT$

#### Quelles conséquences ?

* Si $SAT \le_p A$, alors A est au moins aussi difficile que SAT. Si on suppose $P \ne NP$, alors il ne peut pas exister d'algorithme polynomial pour A.
* Si $A \le_p SAT$, il s'agit d'une borne supérieur de complexité, A est dans NP.

#### Preuve

On considère un programe $A \in NP$ quelconque et on montre $A \le_p NP$.

* $A \in NP$ signifie qu'on a un vérificateur polynomial V pour le problème A.
* Le problème SAT: $\varphi$ est instace positive si et seulement si *il existe* une valuation qui rend $\varphi$ vraie.
* Pour tout algorithme polynomial P on peut construire (en temps polynomial) un circuit booléen $C_p$ de taille polynomiale, dont des les entrées $z_1, ..., z_n \in \{0, 1\}$ correspondent à l'entrée $z = z_1, ..., z_n$ de P (codée en binaire), et tel que *P accepte x si et seulement si $C_p$ s'évalue à 1*.
* Etant donné un circuit booléen C avec entrées $x_1, ..., x_k, y_1, ..., y_m$ et une évaluation $val : \{x_1, ..., x_k\} \leftarrow \{0, 1\}$ on construit une formule booléenne $\varphi_{val}$, ded taille polynomiale en taille (C), tel que :
    * $\varphi_{val}$ est satisfaisable si et seulement si *il existe* une valuation $\tilde{val} : \{y_1, ..., y_m\} \rightarrow \{0, 1\}$ tel que C s'évalue à 1 sous la valuation $<val, \tilde{val}>$.

