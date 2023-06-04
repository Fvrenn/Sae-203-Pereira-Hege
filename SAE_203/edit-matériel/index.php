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
      <div class="div-alert"></div>
      <section id="all-add-mat">
         <div id="div-gauche">
            <div>
               <p>Modifier un matériel</p>
            </div>
            <div class="div-perssonage">
               <img src="ressources/pencil-dynamic-gradient.png" alt="">
            </div>
            <div class="iut-logo">
               <img src="ressources/iut-logo.png" alt="">
            </div>
         </div>

         <section class="forms-add-mat">
            <div>
               <h1 class="titre">Modifier un matériel</h1>

               <form action="index.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">

                  <div class="div-add-mat">
                     <?php
                     include "../table.php";
                     $results = table(
                        "SELECT * FROM `matériel` WHERE idmat = :id",
                        [
                           'id' =>  $_GET['id']
                        ]
                     );
                     if ($results->rowCount() > 0) {
                        $row = $results->fetch(PDO::FETCH_ASSOC);
                        $selectedType = $row['type'];
                     ?>
                        <div class="div-droite-add-mat">
                           <div class="label marge">
                              <label for="nom">Nom :</label>
                              <input type="text" class="input input-add-mat" name="nom" value="<?php echo $row['nom']; ?>">
                              <div class="erreur_nom"></div>
                           </div>

                           <div class="label marge">
                              <label for="reference">Référence :</label>
                              <input type="number" class="input input-add-mat" name="reference" value="<?php echo $row['reference']; ?>">
                              <div class="erreur_ref"></div>
                           </div>

                           <div class="label marge">
                              <label for="menu-deroulant">Type de matériel :</label>
                              <select id="menu-deroulant" name="type">
                                 <option class="option-select" value="Caméra" <?php if ($selectedType == 'Caméra') echo 'selected'; ?>>Caméra</option>
                                 <option class="option-select" value="Microphone" <?php if ($selectedType == 'Microphone') echo 'selected'; ?>>Microphone</option>
                                 <option class="option-select" value="Casque VR" <?php if ($selectedType == 'Casque VR') echo 'selected'; ?>>Casque VR</option>
                                 <option class="option-select" value="Ordinateur" <?php if ($selectedType == 'Ordinateur') echo 'selected'; ?>>Ordinateur</option>
                                 <option class="option-select" value="Webcam" <?php if ($selectedType == 'Webcam') echo 'selected'; ?>>Webcam</option>
                                 <option class="option-select" value="Trepied" <?php if ($selectedType == 'Trepied') echo 'selected'; ?>>Trepied</option>
                                 <option class="option-select" value="Casque" <?php if ($selectedType == 'Casque') echo 'selected'; ?>>Casque</option>
                                 <option class="option-select" value="Fond vert" <?php if ($selectedType == 'Fond vert') echo 'selected'; ?>>Fond vert</option>
                                 <option class="option-select" value="Vidéo projecteur" <?php if ($selectedType == 'Vidéo projecteur') echo 'selected'; ?>>Vidéo projecteur</option>
                              </select>
                           </div>
                        </div>

                        <div class="label div-gauche-add-mat">
                           <label for="description">Description :</label>
                           <textarea class="input txt-area" name="description" rows="8"><?php echo $row['description']; ?></textarea>
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

                     <button type="submit" class="accept-button" name="confirmer" value="<?php echo $_GET['id']; ?>"><i class="icone-btn-mat ri-check-fill"></i>Accepter</button>
                     <a class="btn-retour" href="../liste-du-matériel/index.php"><i class="icone-btn-mat ri-arrow-left-line"></i> Retour</a>
                  </div>
               </form>
            </div>
         </section>
      </section>
      <?php
                     }
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
                        if (!empty($reference))  {
                           $results = table("SELECT reference FROM `matériel` WHERE reference = :ref AND idmat != :id ",
                           [
                               'id' => $_GET['id'],
                               'ref' => $reference
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
                                       "UPDATE `matériel` SET nom = :nom, reference = :ref, type = :type, description = :descript, img = :image WHERE idmat = :id",
                                       [
                                          'id' => $_POST['confirmer'],
                                          'nom' => $nom,
                                          'ref' => $reference,
                                          'type' => $type,
                                          'descript' => $description,
                                          'image' => $newImageName
                                       ]
                                    );
                                    // header('Location: ../liste-du-matériel/index.php');
                                    ?>
                                    <script type="text/javascript">
                                 
                                    document.getElementsByClassName('div-alert')[0].innerHTML =
                                    `<section class="container-alert">
                                    <div class="content-div">
                  <div class="section-alert">
                     <div class="card-alert">
                        <div class="content-alert">
                           <div class="wrapper">
                              <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                 <circle class="checkmarkcircle" cx="26" cy="26" r="25" fill="none" />
                                 <path class="checkmarkcheck" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                              </svg>
                           </div>
                           <h1 class="h1-card">Super !</h1>
                           <p class="p-alert">Matériel modifié !</p>
                           <a href="../liste-du-matériel/index.php" class="btn-alert">Continuer</a>
                        </div>
                     </div>
                  </div>
               
                  <div class="bg-red"></div>
                  </div>
               </section>`;
                                 </script>
                                 <?php
                                 }
                              }
                           }
                        }
                     }
                  } else {
                     header('Location: ../connexion/index.php');
                  }
?>




<script>
   function toggleDropdown() {
      document.getElementById('dropdown-menu').classList.toggle('dropdown-menu1')
   }
</script>
<script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
   </body>

   </html>
   <?php /*
                                    if (!empty($nom) && !empty($reference) && !empty($type) && !empty($description) && !empty($newImageName)) {
                                       $results = table(
                                          "UPDATE `matériel` SET nom = :nom, reference = :ref, type = :type, description = :descript, img = :image WHERE idmat = :id",
                                          [
                                             'id' => $_POST['confirmer'],
                                             'nom' => $nom,
                                             'ref' => $reference,
                                             'type' => $type,
                                             'descript' => $description,
                                             'image' => $newImageName
                                          ]
                                       ); */ ?>