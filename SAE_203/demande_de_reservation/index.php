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
      <div class="alert"></div>
      <section id="all">
         <div id="div-gauche">
            <form action="index.php" method="POST">
               <div>
                  <p>Réservez votre matériel</p>
               </div>
               <?php
               include "../table.php";
               if (!empty($_POST['id'])) {
                  $select = table(
                     "SELECT * FROM `matériel` WHERE idmat = :id;",
                     [
                        'id' => $_POST['id']
                     ]
                  );

                  $rows = $select->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($rows as $value) {
               ?>
                     <div class="div-perssonage">
                        <img class="img-droit" src="../Ajout_de_nouveau_matériel/ressources/<?php echo $value['img']; ?>" alt="">
                     </div>
                  <?php
                  }
               } else {
                  ?>
                  <div class="div-perssonage">
                     <img class="img-calender" src="ressources/calender-dynamic-color.png" alt="">
                  </div>
               <?php
               }
               ?>

               <div class="iut-logo">
                  <img src="ressources/iut-logo.png" alt="">
               </div>
            </form>
         </div>
      
         <section class="forms">
            <div>
               <form action="index.php" method="POST">
                  <h1 class="titre">Demande de réservation</h1>

                  <div class="label marge">
                     <label for="menu-deroulant">Matériel souhaité :</label>
                     <select id="menu-deroulant" name="materiel">
                        <?php
                        if (!empty($_POST['id'])) {
                           $select = table("SELECT * FROM `matériel` WHERE idmat = :id;", [
                              'id' => $_POST['id']
                           ]);

                           $rows = $select->fetchAll(PDO::FETCH_ASSOC);
                           foreach ($rows as $value) {
                              echo "<option value='" . $value["nom"] . "'>" . $value["nom"] . "</option>";
                           }
                        } else {
                           $select = table("SELECT * FROM `matériel`");
                           $rows = $select->fetchAll(PDO::FETCH_ASSOC);
                           foreach ($rows as $value) {
                              echo "<option value='" . $value["nom"] . "'>" . $value["nom"] . "</option>";
                           }
                        }
                        ?>
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
         }
         if (!empty($materiel) && !empty($date_debut) && !empty($date_fin)) {
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
            } else {
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
                  // header('Location: ../page-principale/index.php');

               ?>
                  <script type="text/javascript">
                     console.log("JS")
                     document.getElementsByClassName('alert')[0].innerHTML =
                     `<section class="alert">
                     <div class="card-alert">
                     <div class="content-alert">
                     <div class="wrapper"> <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                     <circle class="checkmarkcircle" cx="26" cy="26" r="25" fill="none" />
                     <path class="checkmarkcheck" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                     </svg>
                     </div>
                     <h1 class="h1-card">Super !</h1>
                     <p class="p-alert">Demande enregistrée !</p>
                     <a href="../page-principale/index.php" class="btn-alert">Continuer</a>
                     </div>
                     </div>
                     </section>`;
                  </script>
   <?php

               }
            }
         }
      }
   } else {
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