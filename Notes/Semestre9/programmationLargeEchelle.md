# Programmation Large Échelle



[Site du prof](https://www.labri.fr/perso/auber/BigDataGL/index.html)



## Pour les td

Installation particulière en 203 (data node)

* Allumer les machines à distance (site du cremi > service numérique > démarrage à distance)
* Les machines s'éteignent au bout de 5 min, script pour rester connecter `/espace/Auber_PLE-203/run_xtems.sh` (il faut s'être connécté avec -X)

Redirection de port avec ssh, peut être utile dans certain td : `ssh -L 50070:localhost:50070 -J <login>@jaguar.emi.u-bordeaux.fr <login>@data`