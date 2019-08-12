<?Php
require 'database.php';
require 'connexiondb.php';


$connexion = connexion();

$sql = "DROP DATABASE IF EXISTS " . "$DB_NAME";

//Prepare the SQL query.
$statement = $connexion->prepare($sql);
//Execute the statement.
$statement->execute();

?>