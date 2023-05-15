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
                           Déconexion
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
         <h4>Matériel :</h4>
         <div class="gallery">

            <article>
               <div class="shopping-card">
                  <img src="ressources/74-202_01.jpg" alt="Product Name" />
                  <h3 class="title-card">Microphone</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>

            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
            <article>
               <div class="shopping-card">
                  <img src="ressources/camera.jpg" alt="Product Name" />
                  <h3 class="title-card">Caméra</h3>
                  <div class="buttons">
                     <button class="button-left">Bouton 1</button>
                     <button onclick="window.location.href= '../demande_de_reservation/index.php'" class="button-right">Réserver</button>
                  </div>
               </div>

            </article>
         </div>
      </section>
      <script>
         function toggleDropdown() {
            document.getElementById('dropdown-menu').classList.toggle('dropdown-menu1')
         }
      </script>
      <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
   </body>

<?php
} else {
   header('Location: ../connexion/index.php');
}
?>

   </html>