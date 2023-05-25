<!DOCTYPE html>
<?php
session_start();
if (!empty($_SESSION['admin'])) {
?>
   <html lang="en">

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

      <section id="all-add-mat">
         <div id="div-gauche">
            <div>
               <p>Ajouter un matériel</p>
            </div>
            <div class="div-perssonage">
               <img src="ressources/plus-dynamic-gradient.png" alt="">
            </div>
            <div class="iut-logo">
               <img src="ressources/iut-logo.png" alt="">
            </div>
         </div>

         <section class="forms-add-mat">
            <div>
               <h1 class="titre">Ajouter un matériel</h1>

               <form action="index.php" method="POST" enctype="multipart/form-data">

                  <div class="div-add-mat">


                     <div class="div-droite-add-mat">
                        <div class="label marge">
                           <label for="nom">Nom :</label>
                           <input type="text" class="input input-add-mat" name="nom">
                           <div class="erreur_nom"></div>
                        </div>



                        <div class="label marge">
                           <label for="reference">Référence :</label>
                           <input type="number" class="input input-add-mat" name="reference">
                           <div class="erreur_ref"></div>
                        </div>


                        <div class="label marge">
                           <label for="menu-deroulant">Type de matériel :</label>
                           <select id="menu-deroulant" name="type">
                              <option class="option-select" value="Caméra">Caméra</option>
                              <option class="option-select" value="Microphone">Microphone</option>
                              <option class="option-select" value="Casque VR">Casque VR</option>
                              <option class="option-select" value="Fond vert">Fond vert</option>
                           </select>
                           <div class="erreur_type"></div>
                        </div>
                     </div>



                     <div class="label div-gauche-add-mat">
                        <label for="description">Description :</label>
                        <textarea class="input txt-area" name="description" rows="8"></textarea>
                        <div class="erreur_description"></div>
                     </div>
                  </div>

                  <div class="label img-select">
                     <label for="image-input">Sélectionner une nouvelle image :</label>
                     <input type="file" id="image-input" accept=".jpg, .jpeg, .png" name="image">
                     <div class="erreur_img"></div>
                  </div>
                  <div class="erreur_glo"></div>
                  <div class="btn-mat">
                     <!-- <input type="submit" class="btn-modifier" name="confirmer"><i class="icone-btn-mat icone ri-check-fill"></i>Accepter</input> -->
                     <input type="SUBMIT" class="btn-modifier" name="confirmer" value="Accepter" icon="fa-user">
                     <a class="btn-retour" href="../liste-du-matériel/index.php"><i class="icone-btn-mat ri-arrow-left-line"></i> Retour</a>
                  </div>
               </form>
            </div>
         </section>
      </section>
      <?php
      include "../table.php";
      if (!empty($_POST['confirmer'])) {
         if (!empty($_POST['nom'])) {
            $nom = $_POST['nom'];
         } else {
      ?>
            <script type="text/javascript">
               document.getElementsByClassName('erreur_nom')[0].innerHTML = "!&nbsp;Saisissez le nom du matériel";
            </script>
         <?php
         }

         if (!empty($_POST['type'])) {
            $type = $_POST['type'];
         }

         if (!empty($_POST['description'])) {
            $description = $_POST['description'];
         } else {
         ?>
            <script type="text/javascript">
               document.getElementsByClassName('erreur_description')[0].innerHTML = "!&nbsp;Saisissez une description";
            </script>
         <?php
         }
         if (!empty($_POST['reference'])) {
            $reference = $_POST['reference'];
         } else { ?>
            <script type="text/javascript">
               document.getElementsByClassName('erreur_ref')[0].innerHTML = "!&nbsp;Saisissez une référence";
            </script>
            <?php
         }
         if ($_FILES["image"]["error"] == 4) {
            ?>
                  <script type="text/javascript">
                     document.getElementsByClassName('erreur_img')[0].innerHTML = "!&nbsp;L'image n'existe pas";
                  </script>
                  <?php
               }
         if (!empty($reference)) {
            $results = table(
               "SELECT matériel.reference FROM `matériel` WHERE reference = :ref ;",
               [
                  'ref' => $reference,
               ]
            );
            if ($results->rowCount() > 0) {
               echo "<script type=\"text/javascript\">
                        document.getElementsByClassName('erreur_glo')[0].innerHTML = \"!&nbsp;Ce matériel existe déjà dans la liste\";
                     </script>";
            } else {
                  $fileName = $_FILES["image"]["name"];
                  $fileSize = $_FILES["image"]["size"];
                  $tmpName = $_FILES["image"]["tmp_name"];

                  $validImageExtension = ['jpg', 'jpeg', 'png'];
                  $imageExtension = explode('.', $fileName);
                  $imageExtension = strtolower(end($imageExtension));
                  if (!in_array($imageExtension, $validImageExtension)) {
                  ?>
                     <script type="text/javascript">
                        document.getElementsByClassName('erreur_img')[0].innerHTML = "!&nbsp;Image non selectionné";
                     </script>
                  <?php
                  } else if ($fileSize > 2000000) {
                  ?>
                     <script type="text/javascript">
                        document.getElementsByClassName('erreur_img')[0].innerHTML = "!&nbsp;La taille de l'image est trop importante";
                     </script>
   <?php
                  } else {
                     $newImageName = uniqid();
                     $newImageName .= '.' . $imageExtension;
                     $destination = '../Ajout_de_nouveau_matériel/ressources/' . $newImageName;
                     move_uploaded_file($tmpName, $destination);

                     if (!empty($nom) && !empty($reference) && !empty($type) && !empty($description) && !empty($newImageName)) {
                           $results = table(
                              "INSERT INTO `matériel`(`nom`, `reference`, `type`, `description`,`img`) VALUES (:nom, :ref, :type, :descript, :image);",
                              [
                                 'nom' => $nom,
                                 'ref' => $reference,
                                 'type' => $type,
                                 'descript' => $description,
                                 'image' => $newImageName

                              ]
                        );
                        header('Location: ../liste-du-matériel/index.php');
                     }
                  }
               }
            }
         }
      }
    else {
      header('Location: ../connexion/index.php');
   }
   ?>


   <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
   </body>

   </html>
   <?php
   