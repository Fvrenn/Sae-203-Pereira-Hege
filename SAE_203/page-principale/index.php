<!DOCTYPE html>
<?php
session_start();/*
if(session_status() !== PHP_SESSION_ACTIVE){
   header('Location: ../connexion/index.php');
}*/
if (!empty($_SESSION['user']) || !empty($_SESSION['admin'])) {
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
      <header>
         <div class="shape__smll"> </div>
         <div class="shape__big_1"> </div>
         <div class="shape__big_2"> </div>
         <nav class="navbar">

            <div class="space">
               <div class="div-user-card">
                  <div class="user-card">
                     <?php if (!empty($_SESSION['user'])) {
                        echo '<h1>' . $_SESSION['user'] . '</h1>';
                     }
                     if (!empty($_SESSION['admin'])) {
                        echo '<h1>' . $_SESSION['admin'] . '</h1>';
                     } ?>

                     <img src="ressources/default_person.jpg" alt="">
                     <div class="dropdown">
                        <i class="ri-arrow-down-s-line" onclick="toggleDropdown()"></i>

                        <div id="dropdown-menu">
                           <a href="" class="Profil">Profil</a>
                           <a href="../deco.php" class="btn-dropdown-logout">
                              <ion-icon class="logout" name="log-in-outline"></ion-icon>
                              Déconnexion
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <ul>
                  <li><a href="../liste-du-matériel/index.php">Matériels</a></li>
                  <li><a href="../demande/index.php">Réservations</a></li>
               </ul>
            </div>
            <div class="logo-iut">
               <a href="../page-principale/index.php"><img class="logo_iut" src="../connexion/ressources/iut-logo" alt=""></a>
            </div>



         </nav>
         <div class="container-header">
            <div class="container-txt-btn">
               <p class="p-page-princial">Réserver votre matériel de l' I.U.T Gustave Eiffel en temps réel</p>
               <a class="btn" href="../demande_de_reservation/index.php">Réserver</a>

            </div>
            <div class="containenr-3dimg">
               <img class="vid-camera-3d" src="ressources/video-camera-dynamic-color.png" alt="">
               <img class="camera-3d" src="ressources/camera-dynamic-color.png" alt="">
               <img class="calendar-3d" src="ressources/calender-dynamic-color.png" alt="">
            </div>
         </div>
      </header>

      <section id="grid">
         <h4>Matériels :</h4>
         <div class="gallery">
            <?php
            include "../table.php";
            $results = table("SELECT * FROM `matériel`;");
            if ($results->rowCount() > 0) {
               while ($row = $results->fetchAll(PDO::FETCH_ASSOC)) {
                  foreach ($row as $value) {
            ?>
                     <article>
                        <div class="shopping-card">
                           <div class="img_center">
                              <img class="img-card" src="../Ajout_de_nouveau_matériel/ressources/<?php echo $value['img']; ?>" alt="Product" />
                           </div>
                           <h3 class="title-card"><?php echo $value['nom']; ?></h3>

                           <div class="buttons">
                              <button onclick="window.location.href= '../liste-du-matériel/index.php'" class="button-left">Détails</button>
                              <form action="../demande_de_reservation/index.php" method="POST">
                                 <button type='submit' class="button-right" name="id" value="<?php echo $value['idmat']; ?>">Réserver</button>
                              </form>
                           </div>
                        </div>


                     </article>

               <?php
                  }
               }
            }
            if (!empty($_SESSION['admin'])) {
               ?>
               <article id="add_button">
                  <a href="../Ajout_de_nouveau_matériel/index.php">
                     <div class="add-button">
                        <i class="add-icone ri-add-fill"></i>
                     </div>
                  </a>
               </article>
            <?php
            }
            ?>
         </div>

      </section>
      <script>
         function toggleDropdown() {
            document.getElementById('dropdown-menu').classList.toggle('dropdown-menu1')
         }
      </script>
      <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
      <footer>
      <div class="footer-container">
         <div class="footer-txt-container">
            <div class="div-footer-txt">
               <h1 class="title-footer">Qui sommes nous ?</h1>
               <div class="ltl-txt">
                  <a href="https://www.univ-gustave-eiffel.fr"><p class="link-footer">Université Gustave Eiffel</p></a>
                  <a href="https://www.univ-gustave-eiffel.fr/luniversite/nos-atouts/innovation-pedagogique"><p class="link-footer">Centre d'Innovation Pédagogique et Numérique (CIPEN)</p></a>
               </div>
            </div>
            <div class="div-footer-txt">
               <h1 class="title-footer">Support</h1>
               <div class="ltl-txt">
                  <a href="http://www.u-pem.fr/campus-numerique-ip/assistance/?tx_ttnews%5Bcat%5D=99&cHash=c936e533f67cbaaddda01752716910d3"><p class="link-footer">FAQs</p></a>
                  <a href="http://www.u-pem.fr/universite/mentions-legales/"><p class="link-footer">Privacy</p></a>
               </div>
            </div>
            <div class="div-footer-txt">
               <h1 class="title-footer">Restons en contact</h1>
               <div class="ltl-txt">
                  <p class="p-footer">Vous pouvez nous contacter<br>au 01 60 95 72 54,<br>du lundi au vendredi de 9h à 17h ou par courriel</p>
                  <p class="p-footer">mailto:cipen@univ-eiffel.fr</p>
               </div>
            </div>
            <div class="div-footer-txt">
               <h1 class="title-footer">Site officiel de l' I.U.T</h1>
               <div class="ltl-logo">
               <a href="https://elearning.univ-eiffel.fr"><img class="img_iut-logo" src="../ressources/intranet-logo-complet.png" alt="logo de l'iut"></a>
               </div>
            </div>
         </div>
      </div>
      <hr>
   </footer>
   </body>

<?php
} else {
   header('Location: ../connexion/index.php');
}
?>

   </html>