# Exercice for Oc5

**create a micro-cms**

initialized 2023-08-01

## Structure of files

- /index.php : htaccess arrival point
- /src/Controllers
-- /src/Controllers/UserController.php : controller of user
-- /src/Controllers/ArticleController.php : controller of articles
-- /src/Controllers/CategoryController.php : controller of categories
- /src/Entities
-- /src/Entities/UserEntity.php : returned class from Pdo
-- /src/Entities/ArticleEntity.php : returned class from Pdo
-- /src/Entities/CategoryEntity.php : returned class from Pdo
- /src/Models
-- /src/Models/Connect.php : Pdo database connection with options
-- /src/Models/Db.php : Calling up the database with connection parameters
-- /src/Models/Main.php : Generic class, concentrator of requests to Db, and distributor of methods called by the class returned by Pdo.
- /src/Pub
-- /src/Pub/lib.php : first level functions
-- /src/Pub/Root.php : Arrival point of all actions
-- /src/Pub/Tests.php : Tests of sql.

//commands
./vendor/bin/phpcs src/Controllers
