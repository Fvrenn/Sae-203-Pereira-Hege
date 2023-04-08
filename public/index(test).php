<?php
$path = "../utile/";
require_once $path."html/header.php";
?>
    <form action="index(test).php" method="POST">
        email : <INPUT type="TEXT" name="email" size=10 value="" placeholder="mon perreira">
        <INPUT type="TEXT" name="nom" size=10 value="" placeholder="mon kevin">
        <INPUT type="SUBMIT" id="submit" value="et hop!">
    </form>

    <?php
   include $path."bdd/table.php";

    /*if (!empty($_POST['email'])) {
    $query = "Update personne set emaiil='" . $_POST['email'] . "' WHERE nom='".$_POST['nom']."'";
    $result = mysqli_query($link, $query) or exit('Erreur SQL !<br />' . $query . '<br />' . mysqli_error($link));;

    mysqli_close($link);
}
$link = mysqli_connect("localhost", "root", "", "test");*/
   /* if (!empty($_POST['nom'])) {
        $result = table("Select emaiil from personne where nom = '" .  hash("sha256", $_POST['nom']) . "';");
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['emaiil'];
        }
    }*/
    // une instruction de connexion à la base de données
  
    /*
 Parametres dans l'ordre : site (www.xxx.fr dans la vraie vie), login, password (aucun ici)
et nom de la base de données, ici test créée à la question 1
*/
    //on décrit la requête sur une table de la base (la table personne dans ce cas)
    if (!empty($_POST['nom'] && !empty($_POST['email']))) {
        $result = table("Select emaiil from personne where nom = '" . $_POST['nom'] . "';");
        while ($row = mysqli_fetch_assoc($result)) {
            if($_POST['email'] == $row['emaiil']){
            echo "c'est ça mon reuf <br>".$row['emaiil'];
            }
            else{
                echo "c'est pas ça mon keuf";
            }
            
        }
    }
    // On execute la requête -> on récupère une structure brute qui contien;t toutes les infos sélectionnées
    $result = table("SELECT nom, prenom FROM personne WHERE 1 ;");

    //var_dump($result) ;
    // on affiche ces données en html (ici dans un tableau mais on pourrait faire simplement des echo )
    echo " <table border=1>";
    echo " <tr> <th> nom </th> <td> prenom </td> </tr>";
    // boucle pour chaque ligne (fetch decompose en ligne tant que ce n'est pas fini
    while ($row = mysqli_fetch_assoc($result)) {
        // on a accès aux noms des champs que l'on a spécifié dans $result
        echo " <tr> <td>", $row['nom'], "</td><TD> ", $row['prenom'], "</TD> </tr> ";
    }
    echo " </table> ";
    require_once $path."html/footer.php";
    ?>
