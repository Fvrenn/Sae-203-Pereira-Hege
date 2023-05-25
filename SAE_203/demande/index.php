<!DOCTYPE html>
<?php
session_start();
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
         <nav class="navbar">
            <div class="div-user-card">
               <div class="user-card">
                  <?php if (!empty($_SESSION['user'])) {
                     echo '<h1>' . $_SESSION['user'] . '</h1>';
                  }
                  if (!empty($_SESSION['admin'])) {
                     echo '<h1>' . $_SESSION['admin'] . '</h1>';
                  } ?>
                  <img src="../page-principale/ressources/default_person.jpg" alt="">
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


            <div class="logo-iut">
               <a href="../page-principale/index.php"><img class="logo_iut" src="../connexion/ressources/iut-logo" alt=""></a>
            </div>
         </nav>
      </header>
      <div class="shape__smll"> </div>
      <div class="shape__big_1"> </div>
      <div class="shape__big_2"> </div>*/
      <section class="div-tabs">
         <div class="btn-retour">
            <h2 class="titre-liste">Liste de toutes les réservations </h2>
            <a class="retour-button" href="../page-principale/index.php"><i class="ri-arrow-left-line"></i> Retour</a>
         </div>
         <div class="espace-table">
            <table>
               <tr class="ligne-nom">
                  <th>Nom</th>
                  <th>Matériel souhaité</th>
                  <th>Statuts</th>
                  <th></th>
               </tr>
               <?php
               include "../table.php";
               $results = table("SELECT demande.id_demande, utilisateur.nom as nom_utilisateur, utilisateur.prenom, matériel.nom as nom_matériel, demande.statuts 
                                    FROM utilisateur, demande, matériel 
                                    WHERE demande.id_user = utilisateur.id_user 
                                    AND demande.idmat = matériel.idmat 
                                    ORDER BY demande.id_demande DESC;");
               if ($results->rowCount() > 0) {
                  while ($row = $results->fetchAll(PDO::FETCH_ASSOC)) {
                     foreach ($row as $value) {

                        echo '<tr class="ligne">';
                        echo '<td>' . $value['nom_utilisateur'] . ' ' . $value['prenom'] . '</td>';
                        echo '<td>' . $value['nom_matériel'] . '</td>';
                        echo '<td>' . $value['statuts'] . '</td>';
                        echo '<td class>';
               ?>
                        <form action="index.php" method="POST">
                           <div class="button-container">
                              <button class="retour-button" name="details" value="<?php echo $value['id_demande']; ?>"><i class="ri-search-line"></i> Détails</button>
                           </div>
                        </form>
               <?php
                        echo '</td>';


                        echo '</tr>';

                        if (!empty($_POST['details'])) {
                           header('Location: ../demande-detail/index.php');
                        }
                     }
                  }
               } else {
                  header('Location: ../connexion/index.php');
               }
               ?>
            </table>
         </div>
         </div>
      </section>
   <?php
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