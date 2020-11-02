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



`use strict` permet d'activer le mode strict de javascript.

```javascript
function counter() {
    let val = 0;
    
    return function() {
        return val++;
    }
}
```

Permet d'encapsuler val dans le fonction counter. La fonction retournée agira sur le context dans lequel val a été déclaré. Mais ici il faut lancer deux fonctions. On va donc faire des *IIFE*. 

```javascript
let counter = function () {
    let val = 0;
    
    return function() {
        return val++;
    }
}();
```



```javascript
let counter = function(init = 0) {
    let val = init;
    let next = function() { ... };
    let reset = function() {
        val = init;
    };
    
    return {
        "next": next,
        "reset": reset
    };
}
```

Prototype : Référence à un autre objet.



> Projet : SPA avec un framework côté front (Angular/React/Vue/...), une api rest en swagger ?, en java ou node, une bdd, utiliser un service thier, authentification de l'user.

## Backend

### Java

#### Servlet

```java
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

public class HelloServlet extends HttpServlet {
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        resp.setContentType("text/html");
        PrintWriter out = resp.getWriter();
        
        out.println("<html>");
        out.println("<body>");
        out.println("<p> Hello world !</p>");
        out.println("</body>");
        out.println("</html>");
    }
}
```

Les servlets nécessitent un conteneur de servlets qui se charge de la gestion des servlets:

- Gestion des noms des servlets
- Création et initialisation des servlets
- Suppression des servlets

Avant, il fallait un fichier web.xml, maintenant il suffit d'avoir une annotaion `@WebServlet`

```java
@WebServlet(urlPatterns="/foo")
public class HelloServlet extends HttpServlet {
    ...
}
```



```xml
<servlet>
    <servlet-name>HelloWorld</servlet-name>
    <servlet-class>fr.u...</servlet-class>
</servlet>

<servlet-mapping>
    <servlet-name></servlet-name>
	<servlet-path></servlet-path>
</servlet-mapping>
```

Il y a une seule instance par servlet. Le code va être multi-threadé, un thread par requête. C'est géré par le conteneur de servlet. Donc problème de concurrence. 

Si y'a un fichier web.xml et des annotations, c'est le fichier web.xml qui est prioritaire

On peut déléguer à un autre servlet

```java
request.getRequestDispatcher("/servlet1").forward(request, response);
```

Ce n'est pas la même chose qu'une redirection

```java
response.sendRedirect("http://..");
```



On peut conserver des objets dans des sessions.

```java
HttpSession session = request.getSession();
sessuib.setAttribute("p1", val);
```



```java
HttpSession session = request.getSession(); // true, la créé si elle n'existe pas
Type1 v1 = (Type1) session.getAttribute("p1");
```



Il existe une Servlet session API. Elle permet de récupérer un objet HttpSession à partir de la requête (HttpServletRequest). L'objet HttpSession est une hashmap java. 



### JAX-RS



Nous permet d'avoir un service REST. C'est basé sur l'utilisation des POJO avec des annotations spécifiques. Pas de description requise dans les fichiers de conf.



Exemple d'un service rest helloworld. Ici, le nom de la classe et des méthodes n'a pas d'importance.

```java
@Path("/hello")
public class HelloWorldResource {
    @GET
    @Produces("text/plain")
    public String getHelloWorld() {
        return "Hello world from text/plain";
    }
}

@Path("/book")
public class BookResource {
    @Path("secondPath")
    @GET
    public String getSecond() {
        return "";
    }
    
    @GET
    @Path("{id}")
    public String getBookById(@PathParam("id") int id) {
        return "Hop, " + id;
    }
    
    @GET
    @Path("name-{name}-editor-{editor}")
    pubilc String getBookByNameAndEditor(@PathParam("name") String name, @PathParam("editor") String editor) {
        return name + ' - ' + editor;
    }
    
    @GET
    @Path("hop")
    public String getQueryParameter(
    	@DefaultValue("all") @QueryParam("name") String name	
    ) {
        return "";
    }
    
    @Post
    @Path("createfromform")
    @Consumes("application/x-www-form-urlencoded")
    public String createBookFromForm(
        @FormParam("name") String name
    	@HeaderParam("isbn") String isbn // Permet de lire des trucs dans le header
    ) {
        return name;
    }
}
```



On peut récupérer le context en paramètre en utilisant des trucs du style `(@Context HttpHeader httpHeader)`. L'annotationi consumes est utilisée pour spécifier le ou les types MIME qu'une méthode d'une ressource peut accepter. L'annotation Produces est utilisée poru spécifier le ou les types MIME qu'une méthode d'une ressource peut produire. Il est possible de définir un ou plusieurs types MIME. Ces annotaitons peuvent porter sur la classe ou une méthode. Celle de la méthode surcharge celle de la classe. On peut trouver les types MIME dans `MediaType`.



On peut convetir automatiquement un objet java en représentation xml et inversement, avec `jaxb`. On peut faire la même chose avec du json avec `jackson`.

```java
@JsonPrepertyOrder({"name", "isbo"})
public class Book {
    @JsonProperty("book_name");
    protected String name;
    
    ...
}
```





```java
public class BookResource {
    @GET
    @Path("ok")
    public String getBook() {
	    return Response.status(Response.Status.OK).entity("Java for life").build();    
    }
}
```









# Projet



Front : Js html css, avec un framework React/Angular/Vue/ ou autre chose mais il faut en parler au prof. SPA. On demande pas que se soit jolie, mais pas du web des années 90 non plus.

Back: Implémenté en Java ou NodeJs, expose une api rest utilisée par le front. Cette api devra être décrite en openAPI. Donc générer une documentation propre (swagger). L'application doit permettre l'authentification des utilisateurs, mettre en oeuvre un base de donnée (relationnelle ou pas).

Il faut utiliser une autre api tierce, utilisée par le front ou le back (par exemple map, service de stockage en ligne, ...)





Chaque groupe aura 8min pour présenter juste la partie api, donc présenter l'application et faire un focus sur l'api. Il faudra rendre dimanche avant le cours la doc de l'api. Il faudra expliquer la philosophie de l'api, quelles sont les routes, quelles sont celles qui sont authentifier ou pas, la gestion des erreurs.





## NodeJs

```javascript
const express = require('express');
const app = experss();

app.get('/', (req, res) => {
    res.send('hello world');
})

app.listen(3000, () => {
    console.log('Serveur démarré');
})
```

```javascript
app.get('/example', (req, res, next) => {
    console.log('chainage des handlers');
    next();
}, (req, res) => {
    res.send('hello world !');
});
```

L'ordre des routes est important. Il faut mettre les routes les plus génériques en dernières.

```javascript
res.send('hello');
res.status(404).end();
res.status(404).send('product not found');
res.json(json_object);
res.redirect(301, 'http://example.com')
```



Récupération des paramètres : 

```javascript
// /?prenom='coucou'
app.get('/', (req, res) => {
    res.send(req.query.prenom);
})

app.get('/:prenom/:nom', (req, res) => {
    let prenom = req.params.prenom;
    
    // accès aux headers
    req.get('user-agent')
})

app.post('/login', (req, res) => {
    res.json(req.body);
})
```

Utilisation d'un middleware pour pouvoir rendre disponible les fichiers (par exemple style.css).

```javascript
app.use(express.static("public"))
```



Supervision : 

Pour redémarrer automatiquement le serveur losqu'un changementa été effectué sur un des fichiers du projet:

* Forever
* nodemon
* pm2
* supervisor



Outils pour réaliser des requêtes : curl, postman, insomnia.



NodeJs permet de charger des modules common js à travers des modules. Un module = un fichier.Par défaut, tout est privé dans un module. Il faut le spécifier pour que ce soit publique.

```javascript
module.exports = 'Hello World'
module.exports = (req, res) => {
    res.send('Hello world !');
}

function printHello() {
    
}

function printWorld() {
    
}

module.exports.printHello = printHello;
module.exports.printWorld = printWorld
```

```javascr
require('./myModules/module1')
```

Il faut spécifier le chemin, sinon il va chercher dans `node_modules`



Middleware



Avec expressJs, toutes les fonctions qui ont comme argument la fonction next ou non sont appelés middleware.

```javascript
function checkAuth(req, res, next) {
	if(req.get("API_KEY"))
		next();
	else
		res.send("Error: Auth missing");
}

app.get("/", checkAuth, (req, res) => {
    ...
})
```

Il est donc possible de définir des middleware exécutés au début de chaque nouvelle requête, avec use.

```javascript
app.use(checkAuth);
app.use("/user/:id", checkAuth);
```



Requêtes avec données dans le body :

Body parser est un middleware

`$> npm instasll body-parser`

```javascript
const bodyParser = require("body-parser")
app.user(bodyParser.json()) //content-type : application.json

app.user(bodyParser.urlencoded({extended: false}))// content-type : application/x-www-form-urlencoded

app.post('/products', (req, res) => {
    product = {
        name: req.body.name,
        price: req.body.price
    }
    
    res.json(product);
})
```



## mongoDb

Base de donnée orientée document. Pas de clef étrangère ni de jointure. 

`$> mongod`

show dbs

use NomDB

show collections

Pour l'utiliser dans node, installation du driver de base : 

`$> npm install mongodb --save`

> il est passé vite, voir le diapo

```javascript
const client = require ('mongodb').MongoClient
const url = 'mongodb://localhost:27017/maDb'

const collection = 
```



15 min (plutôt 10, pour avoir le temps de faire les questions), quelques transparent (une dizaine), décrire le sujet, qu'est-ce que fait le front, qu'est-ce que fait le back. Décrire l'api, écrite en swagger (génération de page web qui explique l'api). Dire qu'elle est l'api tierce qu'on va utiliser (soit front, soit back).

Faudra rendre sur moodle, un pdf qui est la dersciption du projet, et la documentation swagger de l'api (le fichier json généré par swagger).

Documents à rendre dans 15 jours. présentation lundi 9 et lundi 16. Rendu lundi 20.

Le but c'est que l'api n'est pas besoin d'évoluer à partir du 20.

