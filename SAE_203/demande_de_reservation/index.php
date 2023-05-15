<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!empty($_SESSION['user']) || !empty($_SESSION['admin'])) {
?>

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="styles.css">
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
      <title>Document</title>
   </head>

   <body>
      <div class="shape__smll"> </div>
      <div class="shape__big_1"> </div>
      <div class="shape__big_2"> </div>

      <section id="all">
         <div id="div-gauche">
            <div>
               <p>Réservez votre matériel </p>
            </div>
            <div class="div-perssonage">
               <img src="ressources/calender-dynamic-color.png" alt="">
            </div>
            <div class="iut-logo">
               <img src="ressources/iut-logo.png" alt="">
            </div>
         </div>

         <section class="forms">
            <div>
               <h1 class="titre">Demande de réservation</h1>

               <form action="index.php" method="POST">
                  <div class="label marge">
                     <label for="menu-deroulant">Matériel souhaité :</label>



                     <select id="menu-deroulant" name="materiel">
                        <?php
                        include  "../table.php";
                        $select = table("SELECT matériel.nom FROM `matériel`;");
                        while ($row = $select->fetchAll(PDO::FETCH_ASSOC)) {
                           foreach ($row as $value) {
                              echo "<option value='" . $value["nom"] . "'>" . $value["nom"] . "</option>";
                           }
                        }
                        ?>
                        <!-- <option class="option-select" value="">camera v5</option>
                     <option class="option-select" value="option2">Option 2</option>
                     <option class="option-select" value="option3">Option 3</option>-->
                     </select>
                     <div class="erreur_materiel"></div>
                  </div>

                  <div class="div-date">
                     <div class="label marge" id="marge-date">
                        <label for="date1">Date de début :</label>
                        <input class="date" name="date_debut" type="date" id="date1">
                        <div class="erreur_date_debut"></div>
                     </div>
                     <div class="label marge">
                        <label for="date2">Date de fin :</label>
                        <input class="date" name="date_fin" type="date" id="date2">
                        <div class="erreur_date_fin"></div>
                     </div>
                  </div>
                  <div class="erreur_glo"></div>
                  <div class="btn-mat">
                     <input type="SUBMIT" class="submit" name="confirmer" size="18" value="Réserver">
                  </div>
               </form>
            </div>
         </section>
      </section>

      <?php

      if (!empty($_POST['confirmer'])) {
         if (!empty($_POST['materiel'])) {
            $results = table(
               "SELECT matériel.idmat FROM `matériel` WHERE nom = :name ;",
               [
                  'name' => $_POST['materiel']

               ]
            );
            while ($row = $results->fetchAll(PDO::FETCH_ASSOC)) {
               foreach ($row as $value) {
                  $materiel = $value['idmat'];
               }
            }
         }
      
      if (!empty($_POST['date_debut'])) {
         $date_debut = $_POST['date_debut'];
      } else {
      ?>
         <script type="text/javascript">
            document.getElementsByClassName('erreur_date_debut')[0].innerHTML = "!&nbsp;Saisissez une date de début";
         </script>
      <?php
      }
      if (!empty($_POST['date_fin'])) {
         $date_fin = $_POST['date_fin'];
      } else {
      ?>
         <script type="text/javascript">
            document.getElementsByClassName('erreur_date_fin')[0].innerHTML = "!&nbsp;Saisissez une date de fin";
         </script>
   <?php
      } if (!empty($materiel) && !empty($date_debut) && !empty($date_fin)) {
         $results = table(
            "SELECT demande.idmat, demande.date_de_debut, demande.date_de_fin FROM `demande` WHERE idmat = :nom AND date_de_debut = :date_debut AND date_de_fin = :date_fin ;",
            [
               'nom' => $materiel,
               'date_debut' => $date_debut,
               'date_fin' => $date_fin
            ]
         );
         if ($results->rowCount() > 0) {
            ?>
            <script type="text/javascript">
               document.getElementsByClassName('erreur_glo')[0].innerHTML = "!&nbsp;Cette demande existe déjà";
            </script>;
            <?php
      }else{
      if (!empty($materiel) && !empty($date_debut) && !empty($date_fin)) {
         $results = table(
            "INSERT INTO `demande`(`date_de_debut`, `date_de_fin`, `idmat`, `id_user`, `statuts`) VALUES (:date_debut, :date_fin,:materiel,:utilisateur, 'demande en attente');",
            [
               'date_debut' => $date_debut,
               'date_fin' => $date_fin,
               'materiel' => $materiel,
               'utilisateur' => $_SESSION['id']
            ]
         );
         header('Location: ../page-principale/index.php');
      }}
   }
   } }else {
      header('Location: ../connexion/index.php');
   }
   //SELECT utilisateur.nom, matériel.nom FROM`utilisiateur`,`matériel`, `demande` WHERE  demande.idmat = matériel.idmat AND demande.id_user = utilisateur.id_user ;",

   ?>

   <script>
      function toggleDropdown() {
         document.getElementById('dropdown-menu').classList.toggle('dropdown-menu1')
      }
   </script>
   <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>


   </body>

</html>