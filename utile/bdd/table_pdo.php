<?php
function execute($sql){     
    require "config.php"; 
    try {                   //esayer un code
        $mysqlClient = new PDO(         //crée un objet pdo avec des info de la bdd host dbname pasword
            'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8',
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],      //erreur qui  essaye d'etre  prise
        );
    } catch (Exception $e) {                    // rattrape les erreurs(=exception) met dans la variable e
        die('Erreur : ' . $e->getMessage());        // arrete toute la page et affiche les parenthese
    }
    $recipesStatement = $mysqlClient->prepare($sql);        //ecrit la requete sql et 
    $recipesStatement->execute();                           //excute la requete
    $recipes = $recipesStatement->fetchAll();               //recup des données
return $recipes;
}