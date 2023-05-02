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
                  <?php if(!empty($_SESSION['user'])){echo'<h1>'.$_SESSION['user'].'</h1>';} if(!empty($_SESSION['admin'])){echo'<h1>'.$_SESSION['admin'].'</h1>';} ?>
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
         </nav>
      </header>
      <!-- <div class="shape__smll"> </div>
   <div class="shape__big_1"> </div>
   <div class="shape__big_2"> </div> -->
      <section class="div-tabs">
         <table>
            <tr class="ligne-nom">
               <th>Nom</th>
               <th>Matériel souhaité</th>
               <th>Date de début</th>
               <th>Date de fin</th>
               <th>Type</th>
               <th>Statuts</th>
               <th></th>
            </tr>
            <?php
            include "../table.php";
            $results = table("SELECT demande.id_demande, utilisateur.nom as nom_utilisateur, utilisateur.prenom, matériel.nom as nom_matériel, demande.date_de_debut, demande.date_de_fin, matériel.type, demande.statuts FROM utilisateur, demande, matériel WHERE demande.id_user = utilisateur.id_user AND demande.idmat = matériel.idmat;");
            if ($results->rowCount() > 0) {
               while ($row = $results->fetchAll(PDO::FETCH_ASSOC)) {
                  foreach ($row as $value) {

                     echo '<tr class="ligne">';
                     echo '<td>' . $value['nom_utilisateur'] . ' ' . $value['prenom'] . '</td>';
                     echo '<td>' . $value['nom_matériel'] . '</td>';
                     echo '<td>' . $value['date_de_debut'] . '</td>';
                     echo '<td>' . $value['date_de_fin'] . '</td>';
                     echo '<td>' . $value['type'] . '</td>';
                     echo '<td>' . $value['statuts'] . '</td>';
                     if (!empty($_SESSION['admin'])) {
                        if ($value['statuts'] !== 'demande acceptée' && $value['statuts'] !== 'demande refusée') {
                           echo '<td class>';
            ?>
                           <form action="index.php" method="POST">
                              <div class="button-container">
                                 <button class="accept-button" name="accepter" value="<?php echo $value['id_demande']; ?>"><i class="icone ri-check-fill"></i>Accepter</button>
                                 <button class="delete-button" name="refuser" value="<?php echo $value['id_demande']; ?>"><i class=" icone ri-close-line"></i>Refuser</button>
                              </div>
                           </form>
            <?php
                           echo '</td>';
                        }
                     }
                     echo '</tr>';
                  
               }
            }

            if (!empty($_POST['accepter'])) {
               $results = table(
                  "UPDATE demande SET statuts = 'demande acceptée' WHERE id_demande = :id;",
                  [
                     'id' => $_POST['accepter']
                  ]
               );
               header('Location: index.php');
            }

            if (!empty($_POST['refuser'])) {
               $results = table(
                  "UPDATE demande SET statuts = 'demande refusée' WHERE id_demande = :id;",
                  [
                     'id' => $_POST['refuser']
                  ]
               );
               header('Location: index.php');
            }
         }
            ?>
         </table>
      </section>
   <?php
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