<?php 

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
