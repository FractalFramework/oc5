# Exercice for Oc5

**create a micro-cms**

initialized 2023-08-01

## Structure of files

/{root} : Arrival points
- index.php
- ajax.php
- .htaccess
- .env
- readme.md ($this)

/src
- Rooter.php : concentrator of all actions on the site

/src/Controller :
- UserController.php : controller of user
- ArticleController.php : controller of articles
- CategoryController.php : controller of categories

/src/Entity
- UserEntity.php : returned class from Pdo
- ArticleEntity.php : returned class from Pdo
- CategoryEntity.php : returned class from Pdo

/src/Model
- Connect.php : Pdo database connection with options
- Db.php : Calling up the database with connection parameters
- Main.php : Generic class, concentrator of requests to Db, and distributor of methods called by the class returned by Pdo.

/src/Lib
- lib.php : first level functions
- Php.php : basic function could be in php
- Html.php : framework to write tags, including special tags for Ajax
- Ses.php : Stored variables during the execution of the script

/src/js
- ajax.js : motor of actions in ajax
- lib.js : common functions, including the control of the states

/src/css
- core.css

//commands
./vendor/bin/phpcs src/Controller
