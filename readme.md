# Exercice for Oc5

**create a micro-cms**

initialized 2023-08-01

## Issues

- diagrams ✔
- database ✔
- sqlconnection
- navigation
- templating
- posts
- comments
- forms
- login
- edition
- contacts
- admin
- security

## Structure des fichiers

Exécution d'un requête Sql.

- /cnfg : configs
- /public : lieu d'accès du .htaccess. Contient /css, /js, etc.
- /src : composants du logiciel. Divisés en trois parties : 
-- /src/kernel : valable pour tout site
-- /src/core : valable pour toute l'exécution
-- /src/app : applications

### index.php, appelle :

- src/lib.php : contient la librairie des éléments de base du logiciel, au niveau zéro
- cnfg/oc5.php : contient la config mysql. Appelé une fois pour toutes. 
- public/index.php : accès au site.

## /public/index.php

- récupère les variables $_GET
- appelle src/core/main.php

## /src/core/main.php

Permet d'afficher la structure statique du site.
Appelle /src/core/blocks.php.

## /src/core/blocks.php

Reçoit toutes les transactions (get et ajax).
C'est là que se trouve le rooter.
C'est aussi un lieu où on peut déposer des fonctions trop courtes pour nécessiter une page à part.
Les Blocks sont les éléments de la pagination, appelés par les templates.
Mais évidemment ces éléments peuvent se trouver dans src/App.

## test sql

La requête Sql est logée dans un élément de Block.
L'appel se fait via la classe statique /src/kernel/sql, qui a été initialisée dans index.php.

Le mécanisme de requête nécessite une somme de paramètres : 

    $ret = sql::read('name', 'users', 'v', ['id' => 1],0);

où :

- #1 `name` est la colonne appelée
- #2 `users` est le nom de la table
- #3 `v` est le format du callback, ici une variable unique (string)
- #4 `['id' => 1]` désigne la commande de la requête.
- #5 `0` verbose

Ceci équivaut à :

    select name from users where id="1"

