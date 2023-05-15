<!DOCTYPE html>
<?php
session_start();/*
if (session_status() == PHP_SESSION_ACTIVE) {
    header('Location: ../page-principale/index.php ');
}*/
if (!empty($_SESSION['user']) || !empty($_SESSION['admin'])) {
    header('Location: ../page-principale/index.php ');
}
if (empty($_SESSION['user']) || empty($_SESSION['admin'])) {
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../inscription/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <title>Document</title>
    </head>

    <body>
        <section id="all">
            <div class="shape__smll"> </div>
            <div class="shape__big_1"> </div>
            <div class="shape__big_2"> </div>
            <div id="div-gauche">
                <div>
                    <p>Connecter vous a votre compte pour avoir accès au site de réservation du matériel</p>
                </div>
                <div class="div-perssonage">
                    <img src="ressources/perssonage.png" alt="">
                </div>
                <div class="iut-logo">
                    <img src="ressources/iut-logo.png" alt="">
                </div>
            </div>

            <div id="forms">
                <div class="login-register">

                    <a href="../connexion/index.ph" class="active">Connexion</a>
                    <a href="../inscription/index.php" class="not-active">Inscription</a>

                </div>


                <form action="index.php" method="POST">
                    <div class="input">
                        <div class="error-gb">
                            
                        </div>

                        <div class="label email">
                            <label for="email">E-mail :</label>
                            <input type="text" id="email" name="email" placeholder="John.wick@gmail.com" value="<?php if (!empty($_POST['email'])) {
                                                                                                                    echo $_POST['email'];
                                                                                                                } ?>">
                            <div class="erreur_email"></div>
                        </div>
                        <div class="label mdp">
                            <label for="mot_de_passe">Mot de passe :</label>
                            <input class="width-ltl-form" type="password" id="mot_de_passe" name="mdp" placeholder="6+ caractères" value="<?php /*if (!empty($_POST['mdp'])) {
                                                                                                                                                echo $_POST['mdp'];
                                                                                                                                            } */ ?>">
                            <div class="erreur_mdp"></div>
                        </div>
                    </div>
                    <div class="submit-container"> <!-- Ajouter une div parentsubmite pour centrer l'input "S'inscrire" -->
                        <input class="submit" type="submit" name="confirmer" value="Se connecter">
                    </div>
                </form>
            </div>
        </section>
        <?php
        if (!empty($_POST['confirmer'])) {
            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
            } else {
        ?>
                <script type="text/javascript">
                    document.getElementsByClassName('erreur_email')[0].innerHTML = "!&nbsp;Saisissez votre e-mail";
                </script>
            <?php
            }
            if (!empty($_POST['mdp'])) {
                $mdp = $_POST['mdp'];
            } else {
            ?>
                <script type="text/javascript">
                    document.getElementsByClassName('erreur_mdp')[0].innerHTML = "!&nbsp;Saisissez votre mot de passe";
                </script>
                <?php
            }
            include "../table.php";
            if (!empty($email) && !empty($mdp)) {
                $results = table(
                    "SELECT * FROM `utilisateur`where email = :email and  password = :mdp;",
                    [
                        'email' => $_POST["email"],
                        'mdp' => hash("sha256", $_POST['mdp']),
                    ]
                );
                if ($results->rowCount() > 0) {
                    while ($row = $results->fetchAll(PDO::FETCH_ASSOC)) {
                        foreach ($row as $value) {
                            if ($value['role'] == '1') {
                                $_SESSION['admin'] = $value["prenom"];
                                $_SESSION['id'] = $value["id_user"];
                                header('Location: ../page-principale/index.php');
                            } else {
                                $_SESSION['user'] = $value["prenom"];
                                $_SESSION['id'] = $value["id_user"];
                                header('Location: ../page-principale/index.php');
                            }
                        }
                    }
                } else {
                ?>
                    <script type="text/javascript">
                        document.getElementsByClassName('error-gb')[0].innerHTML = `<div class="erreur-global" style=" margin-bottom: 15px; font-family: 'Poppins';width: 416px;
    height: 82px;
    background-color: #121220;
    display: flex;
    /* justify-content: center; */
    align-items: center;
    border-left: #ff4500 solid 6px;">
        <div>
            <i class="error ri-error-warning-fill" style="color: #ff4500;
            font-size: 26px;
            margin-right: 22px;
            margin-left: 26px;"></i>
        </div>
        <div>
            <H1 class="error-title" style="font-weight: 600;
            font-size: 13px;
            color: #FFFFFF;
            margin-bottom: 16px;">ERREUR</H1>
            <p class="erreur-p" style="font-weight: 500;
            font-size: 14px;
            color: #6F6F6F;">Email ou mot de passe invalide</p>
        </div>
    </div>`;
                    </script>
    <?php
                }
            }
        }
    }
    ?>
    </body>

    </html>