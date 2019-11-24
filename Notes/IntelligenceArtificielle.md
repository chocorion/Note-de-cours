# Intelligence Artificielle

## Réseaux de neurones et deep learning

### Le neurone

Voici un neuronne. Chaque *x* est ce que le neuronne reçoit en entrée, et *b* est le biais du neuronne. *z* est la sortie du neuronne.

<img src="images/neurone_1.png">


Sur chaque liaison entre une entrée *x* et le neuronne, nous allons ajouter une *pondération w* (ou poids). La sortie du neuronne devient $z = \Sigma w_i x_i + b$.

<img src="images/neurone_2.png">


Pour savoir si notre neurone va s'activer ou non, on rajoute une *fonction d'activation*. 

<img src="images/neurone_3.png">

Un exemple de fonction d'activation souvent utilisée est la fonction *sigmoïd*, définie par $\sigma(z) = \frac{1}{1 + e^{-z}}$.
Mais il existe plein de d'autres fonctions d'activation (ReLU, radiale, stochastique...).

### Réseau de neurones

Pour créer un réseau de neurones, il "suffit" de brancher les sorties de neurones sur l'entrée d'autres neurones. Chaque neuron possède ses propres poids et son propre biais.

On peut ainsi créer des réseaux à plusieurs couches :

<img src="images/neurone_4.png">

#### Deep Learing

Le deep learning est l'utilisation de réseaux de neuronnes utilisant plusieurs couche cachées. 

*Théorème d'universalité :* Toute fonction continue $f: \R^n \rightarrow \R^n$ peut être approcimée par un réseau de neurones à une couche cachée.


#### Couche de sortie

Pour le moment, les valeurs $y_i$ renvoyées par les neurones ont des valeurs quelconques, difficiles à interpréter... Il faut alors transformer les sorties en *probabilités*.

Pour faire cela, on ajoute une couche de *Softmax*.

<img src="images/softmax_1.png">

On obtient alors une distribution de probabilité:
* $0 < y_i < 1, \forall i$
* $\Sigma_{i = 1}^k y_i = 1$

##### Fonction de perte (Loss function)

Ces fonctions nous permettent de calculer l'écart entre le résultat de notre réseau de neurone et le résultat attendu.

La fonction de perte peut être :
* La somme des carrés des écarts : $l = \Sigma (y_i - \hat{y}_i)^2$
* La *cross entropy* : $l = -\Sigma y_i ln(\hat{y}_i)$

Une bonne fonction (définie par les paramètres que l'on met sur le réseau) doit minimiser la valeur totale de la fonction de perte.

### Apprentissage

Il faut ensuite déterminer les paramètres des neurones $w = (w_1, w_1, ..., w_p)$ et le biais $b$, que l'on regroupe sous le terme $\theta$.

Une première solution est d'énumérer toutes les possibilitées, mais c'est infesable...
Nous allons donc utiliser la descente de gradient.

l'objectif de l'apprentissage est donc de trouver les paramètes $\theta$ du réseau qui minimisent la perte total *L*.

#### Descente de gradient

> Même chose que dans le cours d'analyse, indexation et classification des données...


#### Algorithme de Back-propagation

Prenons un réseau simple : 

<img src="images/neurone_5.png">

On peut écrire les fonctions mathématiques de chaque couche :
1. $z_1 = w_1 x + b_1$
2. $y_1 = f(z_1)$
3. $z_2 = w_2y_1 + b_2$
4. $\hat{y} = f(z_2)$
