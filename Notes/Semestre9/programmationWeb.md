# Programmation Web

[Cours du prof](http://www.reveillere.fr/M2WEB)

Contrôl continue intégral



* 3 premières scéances front (html/css/js) 
* après back (NodeJs/Java) REST

Projet React | Angular, autoformation, libre de choix sur le sujet.



## html

lol



## css

On veut : 

* Travailler sur le style sans modifier le reste
* Rendre accessible son site aux mal voyants
* Prévoir l'impression
* Changer de style suivant ses humeurs ([http://www.csszengarden.com]())

On va faire du css 3, et on va voire Less et Sass

Pour apprendre les selecteurs : [https://flukeout.github.io/]()

Les choses compliquées en css:

* Trouver le bon sélecteur
* Les boites



## Javascript



Les déclarations de fonctions sont *hoisted*, c'est-à-dire qu'elles sont dépacées au sommet du scope.

Pour tes les éléments du DOM, 

```javascript
function onClick() {
    console.log("Click !")
}

const button = document.querySelector("button");
button.addEventListener('click', onClick);
```

Il faut dans ce cours utiliser cette méthode plutôt que `<button onClick="console.log("Click !");"></button> `.

Il faut penser à utiliser `<script src="" defer></script>`, pour lancer le script à la fin du chargement de la page.