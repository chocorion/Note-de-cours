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



## Restful api

Une api web est dite restful si elle a les caractéristiques suivantes :

* Les requêtes sont envoyées sous forme de requêtes HTTP:
  * Méthodes HTTP: GET POST PUT PATCH DELETE...
* Un Endpoint: (http://example.com/api/ressources) 
* Les requêtes doivent être envoyées avec un MIME*/Content-type spécifique tel : JSON , XML, HTML...



Une api restful doit respecter certaines contraintes d'architecture : 

1. Archi clent-serveur : chacu évolue indépendamment.
2. Serveur sans états (stateless): pas de sessions
3. Utilisation du cache : le client sait combien de temps il peut garder les données qu'il reçoit avant expiration
4. Une interface uniforme: un seul id, contient l'URL des ressources suivantes...
5. Archi en couches : Réduire la complexité de l'architecture.

En rest, tout est ressources. On intéragit avec via différents endpoints. Pour intéragir avec une ressources, il suffit d'utiliser la méthode HTTP adéquate :

- GET : Récupérer
- POST: Créer
- PUT: Mettre à jour
- DELETE: Effacer

### API restful et cache

Utilisation des headers *Expires* et *cache-control*. Il y a aussi *ETag*, qui permet d'identifier la requête. On peut alors l'utiliser pour demander s'il y a eu modification des données.



## Evenements

e.preventdefault



### Same origin policy

