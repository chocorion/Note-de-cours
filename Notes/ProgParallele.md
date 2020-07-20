# Programmation des Architectures Parallèles

[TOC]

# Introdution

Quel est l'intéret du calcul intensif ?

* Gagner du temps
  * Gagner plus de précision
  * Faire plus d'expériences
  * Aller plus vite que les autres
* Traiter des problèmes importants
  * dépasser la limitation mémoire d'une machine
* Programmer plus simplement une simulation
  * Objets parallèles
  * Analyser des phénomènes multi-physiques

### Exemple modélisation météorologique

Calculer humidité, pression, température et vitesse du vent en fonction de x, y, z et t.

* Discrétiser l'espace
  * Exemple : A point pour 2 $km^3$ sur 20 $km$ d'atmoshère, $5.10^9$ points
* Initialiser le modèle
* Faire évoluer le modèle
  * Discrétiser le temps (Ex, calculer par pas de 60s)
  * Résoudre pour chaque maille un système d'équations
    * calculer l'état suivant d'une maille en fonction de son voisinnage
    * Coût : 100 FLOP / maille

1 pas de calcul coute $5.10^{11} flop$.

Besions d'une simulation :

* Temps réel : 1 pas en 60 secondes
  * $5.10^{11}/60 = 8 Gflop/s$
* Prévision : 7 jours en 24h
  * $7 * 8 = 56 Gfflop/s$
* climatologie : 50 ans en 30 jours
  * $4,8 Tflop/s$



### Est-il facile d'obtenir des performances ?

Il faut exploiter un processeur au mieux alors que :

* Un application moyenne utilise un coeur à 20% de sa capacité
* Un application idéale tel le produit de matrice utilise à :
  * 93% un coeur
  * 90% 4 coeurs
  * 25% un GPU

En plus, il faut extraire suffisamment de parallélisme.



#### Loi d'Amdahl

$$
accélération = speedup = \frac{temps\ du\ meilleur\ prog.\ séquentiel}{temps\ du\ meilleur\ prog.\ parallèle}
$$

Soit $S$ la part séquentielle de l'application 1 pour une donnée $d$. L'accélération de l'exécution de A($d$) sur une machine ) $p$ processeur est bornée par :
$$
speedup(p) \le \frac{1}{S + \frac{1 - S}{p}}
$$

> Si 1% de l'application est séquentielle, on n'arrivera pas à aller 100 fois plus vite.

![image-20200115104406932](/images/PAP/loi.png)



La loi d'Amdahl n'est pas optimiste :

* Elle raisonne en taille constante
* or augmenter le nombre de processeurs permet d'augmenter la taille du problème
* et la proportion de parallélisme peut augmenter comparativement à la partie séquentielle

Cependant, elle oblige à faire la chasse aux parti séquentielles :

* Synchronisation, exclusion mutuelle
* Redondance de calcul
* Initialiisation et terminaion des flots de calcul
* Déséquilibre de charge entre processeurs



## OpenMP

* Une API pour la programmation parallèle en mémoire partagée
  * C, C++, Fortran
  * Portable
* Porté par l'*Architecture Review Board* (Intel, IBM, AMD, Microsoft, Cray, Oracle, NEC...)
* Basé sur des annotations : `pragma omp directive`
* et des fonctions : `omp_fonction()`
* Permet de paralléliser un code de façon plus ou moins intrusive un code:
  * Plus on en dit plus on a de performance
  * Facile à mettre en oeuvre par un non spécialiste.. Trop facile ?
* Ne permet pas de créer ses propres outil de synchronisation
* [Lien site openMP](https://computing.llnl.gov/tutorials/openMP/)

### Hello world !



```c
#include <omp.h>

int main() {
    #pragma omp parallel
    printf("Bonjour\n");
    printf("au revoir\n");
    
    return EXIT_SUCCESS;
}
```

```
> gcc -fopenmp main.c
> OPENMP_NUMTHREADS=3 ./a.out
bonjour
bonjour
bonjour
au revoir
>
```

### Parallélisme fork-join

* Un unique thread exécute séquentiellement le code de main.

* Lors de la rencontre d'un bloc parallèle, tout thread :

  * crée une *équipe* de threads
  * la charge d'exécuter une fonction correspondant au bloc parallèle
  * rejoint en tant que *maître* l'équipe.

* À la fin du bloc parallèle

  * les threads d'une même équipe s'attendent au moyen de barrière *implicite*
  * les threads exclaves sont démobilisés
  * le thread maître retrouve son équipe précédente


```c
#pragme omp parallel
{
    printf("bonjour\n");
    // barrière implicite
}
```



Traduction en pthread de :

```c
#pragma omp parallel
f();
```

```c
{
    pthread_t tid[K];
    
    for (int i = 1, i < k; i++) {
        pthread_create(tid + i, 0, f, i);
    }
    
    f(0);
    for (int i = 1; i < k; i++) {
        pthread_join(tid[i]);
    }
}
```


#### Paranthèse sur un sujet d'exam

Dans le code suivant, problème pour paralléliser à cause de t[i - 1].
```c
for (int i = 1; i < 100; i++) {
    t[i] = t[i] + t[i - 1];
}
```

$$
\begin{bmatrix}
0 & 1 & 0 & 0\\
0 & 0 & 0 & 1\\
1 & 0 & 0 & 1\\
0 & 0 & 1 & 0
\end{bmatrix}

\rightarrow

\begin{bmatrix}
1 & 1\\
1 & 3\\
2 & 1 & 3\\
1 & 2
\end{bmatrix}
$$


```c
bool creuse[XDIM][YDIM];
bool xdense[XDIM][YDIM + 1];
bool ydense[YDIM][XDIM + 1];

void creuse2annexe() {
    for (int i = 0; i < XDIM; i++) {
        for (int j = 0; j < YDIM; j++) {
            if (creuse[i][j]) {
                int ii, jj;
                
                // capture car l'opération n'est pas réellement atomic
                #pragma omp atomic capture
                ii = ++y[j][0];
                jj = ...;
        }
    }
}
```
Pour paralléliser, il faut être sur que les threads travaillent sur des domaines de lectures et d'écritures disjoints. En cas d'intersection, il faut réfléchir.

--------------

On veut paralléliser le code suivant :


```c
for (int etape = 0; etape < k; etape++) {
    for (int i = 0; i < 10; i++) {
        out[i] = f(input, i);
    }

    memcpy(input, out, ...);
}
```
Comme il faut faire étape par étape, on ne peut pas paralléliser la première boucle.
Le code suivant fonctionne, mais n'est pas très beau. À la fin de chaque étape, tous les threads sont détruits, puis recréés à chaque étapes.

```c
for (int etape = 0; etape < k; etape++) {

    #pragma omp parallel for
    for (int i = 0; i < 10; i++) {
        out[i] = f(input, i);
    }

    memcpy(input, out, ...);
}
```

```c
int etape;
#pragma omp parallel private(etape)
for (etape = 0; etape < k; etape++) {

    #pragma omp for
    for (int i = 0; i < 10; i++) {
        out[i] = f(input, i);
    }
    // Barrière implicite.

    if (omp_get_num() == 0) // ou pragma omp master/single
        memcpy(input, out, ...);
    // Barrière implicite dans le cas de single, mais pas avec master.

    #pragma omp barrier
    // Sinon tous les threads continuent le reste du calcul sans attendre le memcpy.
}
```
Ici, commee étape est partagé, on va avoir des problèmes de synchro.
Soit il faut rendre la variable privée, soit un thread l'incrémente pour tous les autres.
Il est plus simple de rendre étape privée, c'est ce que fait `private(etape)`.

Tous les threads font le `memcpy`. 

```c
int *entree = input;
int *sortie = output;

#pragma omp parallel firstprivate(entree, sortie) // Indique au compilateur que entree et sortie sont privée, mais il faut copier leur valeur.
for (int etape = 0; etape < k; etape ++) {
    #pragma omp for nowait
    for (int i = 0; i < 10; i++){
        sortie[i] = f(entree, i);
    }

    swap(entree, sortie);
    #pragma omp barrier
}
```

`firstprivate` est plus important à retenir que private. On fait sauter la barrière du for avec `nowait`.
C'est mieux que chaques thread s'occupe de swap plutôt qu'un. Un swap est moins chère que la synchronisation. La parallélisation à un coup, il y a plus d'instruction que dans le cas parallèle.

Exemple d'examen : 
```c
#pragma omp parallel for reduction(+:s) // permet de résoudre le problème avec s
for (i = 0; i < N; i++) {
    s += f(i); // problem, s partagé.
}
```
Il faut paralléliser le code, avec différentes complexités pour *f*.
Constant : schedule(static)
Linéaire : schedule(static, 1)
Exponentiel : On inverse l'index, schedule(dynamic, 1)
Aléatoire : (static, 1) -> mais pas pour ce qui est périodique, ou dynamique.

### Voyageur de commerce

```c
void tsp(etape, longueur_chemin, visite, ici) {
    if (etape == nombre_ville) {
        if (longueur_chemin + dist[ici][0] < MIN) {
            MIN = longueur_chemin + dist[ici][0];
        }
        return;
    }

    for (int v = 1; v < nombre_ville, v++) {
        if (v not in visite) {
            tsp(etape + 1, longueur_chemin + dist[ici][v], visite + v, v);
        }
    }
}
```

> Comment paralléliser ce code ?

Pour faciliter les choses, on créé une fonction `top_départ`, duplication du code pour lancer les threads au premier niveau.

```c
void top_depart(etape, longueur_chemin, visite, ici) {
    if (etape == nombre_ville) {
        #pragma omp critical
        if (longueur_chemin + dist[ici][0] < MIN) {
            MIN = longueur_chemin + dist[ici][0];
        }
        return;
    }

    #pragma omp parallel for
    for (int v = 1; v < nombre_ville, v++) {
        if (v not in visite) {
            tsp(etape + 1, longueur_chemin + dist[ici][v], visite + v, v);
        }
    }
}
```
MIN est partagée par tout le monde.
omp_set_nested ?
