# Exercice for Oc5

**create a micro-cms**

initialized 2023-08-01

## Structure des fichiers

- src/Controllers
-- src/Controllers/User.php : Classe dont Pdo fait le type
- src/Models
-- src/Models/Connect.php : Connexion à la base de données en Pdo avec des options
-- src/Models/Db.php : Appel de la base de données avec les paramètres de connexion
-- src/Models/Main.php : Classe générique, concentrateur des requêtes vers Db, et distributeur des méthodes appelées par la classe retournée par Pdo.
- src/Public :
-- src/Public/index.php : point d'arrivée du htaccess

