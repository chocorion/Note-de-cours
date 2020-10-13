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