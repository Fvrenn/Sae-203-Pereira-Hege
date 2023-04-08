<?php
session_start();
$path = "../utile/";
require_once $path . "html/header.php";
?>
<link rel="stylesheet" href="../asset/css/inscription_style.css">
<div id="glo">
    <?php
   if (!empty($_SESSION['a']) && $_SESSION['a'] == 1) {
        header('Location: connexion.php');
    }
    ?>
    <h1>Inscrivez-vous</h1>
    <form action="inscription.php" method="POST">
        <div class="form">Email : <br><input type="text" name="email" size=38 value=""></div><br>
        <div class="eremail"></div>
        <div class="form">Nom : <br><input type="TEXT" name="nom" size=38 value=""></div><br>
        <div class="ernom"></div>
        <div class="form">Prénom : <br><input type="TEXT" name="prenom" size=38 value="" placeholder=""></div><br>
        <div class="erprenom"></div>
        <div class="form">Date de naissance : <br><input type="date" name="date"  value="" placeholder=""></div><br>
        <div class="erdate"></div>
        <div class="form"> Mot de passe : <br> <input type="password" name="mdp" size=38 value="" placeholder="6 Caractères minimums"></div><br>
        <div class="ermdp"></div>
        <div id="confirm"> <input type="SUBMIT" id="submit" name="confirmer" size="18" value="confirmer"></div>
    </form> 
    <!--<a href="deco.php">Deconnexion</a>-->
    <a id="connect" href="page connexion">Retour à la page de connexion</a>
</div>
<?php
include $path . "bdd/table.php";
if (!empty($_POST['confirmer']) && $_POST['confirmer'] == 'confirmer'){
         if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (!empty($_POST['mdp'])) {
                $mdplength = strlen($_POST['mdp']);
                if ($mdplength >= 6) {
                    if (!empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['mdp'])) {
                        $result = table("Insert into user ('nom', 'prenom', 'email', 'mdp', 'date', 'role')value('" . $_POST['nom'] . "', '" . $_POST['prenom'] . "', '" . $_POST['email'] . "', '" . hash("sha256", $_POST['mdp']) . "', '" . $_POST['date'] . "', 'etudiant')");
                        $_SESSION['a'] = 1;
                    }
                } else {
                    if (empty($_POST['mdp'])) {
                        ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('ermdp')[0].innerHTML = "! Mot de passe incorrect";
                        </script>
                       <?php
                    }
                    ?>
                    <script type="text/javascript">
                        document.getElementsByClassName('ermdp')[0].innerHTML = "! Mot de passe incorrect";
                    </script>
                   <?php
                }
        } }
        else {            
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('eremail')[0].innerHTML = "! E-mail incorrect";
            </script>
           <?php
            if (empty($_POST['mdp'])) {
                $mdplength = strlen($_POST['mdp']);
                if ($mdplength >= 6) {
                    ?>
                    <script type="text/javascript">
                        document.getElementsByClassName('ermdp')[0].innerHTML = "! Mot de passe incorrect";
                    </script>
                   <?php
                }
                ?>
                <script type="text/javascript">
                    document.getElementsByClassName('ermdp')[0].innerHTML = "! Mot de passe incorrect";
                </script>
               <?php
            }
    }
        if (empty($_POST['nom'])) {   
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('ernom')[0].innerHTML = "! Nom incorrect";
            </script>
           <?php
        } 
        if (empty($_POST['prenom'])) {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erprenom')[0].innerHTML = "! Prénom incorrect";
            </script>
           <?php
        } 
        if (empty($_POST['date'])) {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erdate')[0].innerHTML = " ! Date de naissance incorrect";
            </script>
           <?php
        } 
        }
require_once $path . "html/footer.php";
?>