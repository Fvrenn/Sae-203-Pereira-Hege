<?php /*
 function table($query)
 {
     include "config.php";
     $link = mysqli_connect($host, $user, $pasword, $dbname); //connexion avec la base de donnée
     //stock une requete sql
     $result =  mysqli_query($link, $query) or exit('Erreur SQL !<br />' . $query . '<br />' . mysqli_error($link)); // execute la commande ou écrit une erreur si il y a une erreur
     // stock result dans row
     mysqli_close($link);
     return $result;                                            //renvoie la valeur row


 }*/
 /*       $result = table("Select emaiil from personne where nom = '" . $_POST['nom'] . "';");
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['emaiil'];
        }*/

function table($sql, $sqlConfig = [])
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "sae_203";

    try {
        $db = new PDO(
            'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8',
            $user,
            $password
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch (Exception $e) {
        die(print_r($e));
    }
    $results = $db->prepare($sql);
    $results->execute($sqlConfig) or die($db->errorInfo());
    return $results;
}
