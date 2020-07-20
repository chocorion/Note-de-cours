# Intelligence Artificielle

## Réseaux de neurones et deep learning

### Le neurone

Voici un neuronne. Chaque *x* est ce que le neuronne reçoit en entrée, et *b* est le biais du neuronne. *z* est la sortie du neuronne.

<img src="/images/IA/neurone_1.png">


Sur chaque liaison entre une entrée *x* et le neuronne, nous allons ajouter une *pondération w* (ou poids). La sortie du neuronne devient $z = \Sigma w_i x_i + b$.

<img src="/images/IA/neurone_2.png">


Pour savoir si notre neurone va s'activer ou non, on rajoute une *fonction d'activation*. 

<img src="/images/IA/neurone_3.png">

Un exemple de fonction d'activation souvent utilisée est la fonction *sigmoïd*, définie par $\sigma(z) = \frac{1}{1 + e^{-z}}$.
Mais il existe plein de d'autres fonctions d'activation (ReLU, radiale, stochastique...).

### Réseau de neurones

Pour créer un réseau de neurones, il "suffit" de brancher les sorties de neurones sur l'entrée d'autres neurones. Chaque neuron possède ses propres poids et son propre biais.

On peut ainsi créer des réseaux à plusieurs couches :

<img src="/images/IA/neurone_4.png">

#### Deep Learing

Le deep learning est l'utilisation de réseaux de neuronnes utilisant plusieurs couche cachées. 

*Théorème d'universalité :* Toute fonction continue $f: \R^n \rightarrow \R^n$ peut être approcimée par un réseau de neurones à une couche cachée.


#### Couche de sortie

Pour le moment, les valeurs $y_i$ renvoyées par les neurones ont des valeurs quelconques, difficiles à interpréter... Il faut alors transformer les sorties en *probabilités*.

Pour faire cela, on ajoute une couche de *Softmax*.

<img src="/images/IA/softmax_1.png">

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

<img src="/images/IA/neurone_5.png">

On peut écrire les fonctions mathématiques de chaque couche :
1. $z_1 = w_1 x + b_1$
2. $y_1 = f(z_1)$
3. $z_2 = w_2y_1 + b_2$
4. $\hat{y} = f(z_2)$

Pour simplifier, on utilise comme fonction de perte la somme des carrés des écarts : $\mathcal{L}(y, \hat{y}) = \frac{1}{2}(\hat{y} - y)^2$.

Comme fonction d'activation, nous allons utiliser la fonction sigmoïd, $f(z) = \sigma(z) = \frac{1}{1 + e^{-z}}$.


Si on note $\theta = \{w_1, w_2, b_1, b_2\}$, il faut trouver $\theta^*$ tel que $\theta^* = arg\ min_{\theta} L(\theta)$.

La formule de la descente de gradient est $\theta^{t + 1} = \theta^t - \eta \nabla L(\theta^t)$, ce que l'on peut traduite dans notre cas par :
* $w_1^{t + 1} = w_1^{(t)} - \eta \frac{\partial \mathcal{L}}{\partial w_1}(w_1^{(t)}, w_2^{(t)}, b_1^{(t)}, b_2^{(t)})$
* $w_2^{t + 1} = w_2^{(t)} - \eta \frac{\partial \mathcal{L}}{\partial w_2}(w_1^{(t)}, w_2^{(t)}, b_1^{(t)}, b_2^{(t)})$
* $b_1^{t + 1} = b_1^{(t)} - \eta \frac{\partial \mathcal{L}}{\partial b_1}(w_1^{(t)}, w_2^{(t)}, b_1^{(t)}, b_2^{(t)})$
* $b_2^{t + 1} = b_2^{(t)} - \eta \frac{\partial \mathcal{L}}{\partial b_2}(w_1^{(t)}, w_2^{(t)}, b_1^{(t)}, b_2^{(t)})$

> Comment calculer les dérivées partielles 
> $\frac{\partial \mathcal{L}}{\partial w_1}$, $\frac{\partial \mathcal{L}}{\partial w_2}$, $\frac{\partial \mathcal{L}}{\partial b_1}$ et $\frac{\partial \mathcal{L}}{\partial b_2}$ ?

On commence par $w = w_2$. On peut observer que $\mathcal{L} = \mathcal{L}(\hat{y}(w)) = \mathcal{L}(\hat{y}(z_2(w)))$

La règle de chainage nous indique que : $\frac{\partial \mathcal{L}}{\partial w} = \frac{\partial \mathcal{L}}{\partial \hat{y}}.\frac{\partial \hat{y}}{\partial z_2}.\frac{\partial z_2}{\partial w}$

Faisons les calculs : 
* $\frac{\partial \mathcal{L}}{\partial \hat{y}} = \frac{\partial (\frac{1}{2}(y - \hat{y})^2)}{\partial \hat{y}} = (y - \hat{y})$
* $\frac{\partial \hat{y}}{\partial z_2} = \frac{\partial (f(z_2))}{\partial z_2} = \frac{\partial (\sigma(z_2))}{\partial z_2} = \sigma (z_2)(1 - \sigma(z_2)) = \hat{y}(1 - \hat{y})$
* $\frac{\partial z_2}{\partial w} = \frac{\partial (w_2 y_2 + b_2)}{\partial w} = y_1$

$\rightarrow \frac{\partial \mathcal{L}}{\partial w_2} = (y - \hat{y})\hat{y}(1 - \hat{y})y_1$

Un calcul similaire nous donne $\rightarrow \frac{\partial \mathcal{L}}{\partial b_2} = (y - \hat{y})\hat{y}(1 - \hat{y})$


**Remarques :**
* $y - \hat{y}$ est l'erreur commise
* On dispose de tous les ingrédients pour calculer les deux dérivées nécessaires pour la dernière couche.


> Qu'en est-il de la couche cachée ?

En faisant tous les calculs, on obtient :  
* $\frac{\partial \mathcal{L}}{\partial W_0} = (\hat{y} - y) \hat{y} (1 - \hat{y})y_1(1 - y_1)w_1 x$
* $\frac{\partial \mathcal{L}}{\partial b_1} = (\hat{y} - y) \hat{y} (1 - \hat{y})y_1(1 - y_1)w_1$


De ce que j'ai compris, pour tester on mélange nos données de test, on les regroupe en *mini-batch*, dès qu'on a testé sur un mini-batch on réajuste les paramètres avec la *back-propagation*, et une fois que tous les mini-batch sont fait c'est la fin d'une *epoch*.


Dans les outils de *deep-learning*, ces deux paramètres sont à indiquer :
* *batch-size :* nombre d'exemples à utiliser pour estimer le gradient de la fonction de coût.
* *epoch :* le nombre d'époques à réaliser lors de la descente de gradient.