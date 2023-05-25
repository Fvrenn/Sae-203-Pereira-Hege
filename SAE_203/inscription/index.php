<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
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

                <a href="../connexion/index.php" class="not-active">Connexion</a>
                <a href="../inscription/index.php" class="active">Inscription</a>

            </div>
            <form action="index.php" method="POST">
                <div class="input">
                <div class="error-gb">
                </div>

                    <div class="label email">
                        <label for="email">E-mail :</label>
                        <input type="text" id="email" size=38 name="email" placeholder="John.wick@gmail.com" value="<?php if (!empty($_POST['email'])) {
                                                                                                                        echo $_POST['email'];
                                                                                                                    } ?>">
                        <div class="erreur_email"></div>
                    </div>


                    <div class="nom-prenom">
                        <div class="label nom">
                            <label for="nom">Nom :</label>
                            <input class="width-ltl-form" type="text" id="nom" name="nom" placeholder="Wick" value="<?php if (!empty($_POST['nom'])) {
                                                                                                                        echo $_POST['nom'];
                                                                                                                    } ?>">
                            <div class="erreur_nom"></div>
                        </div>


                        <div class="label prenom">
                            <label for="prenom">Prénom :</label>
                            <input class="width-ltl-form" type="text" id="prenom" name="prenom" placeholder="John" value="<?php if (!empty($_POST['prenom'])) {
                                                                                                                                echo $_POST['prenom'];
                                                                                                                            } ?>">
                            <div class="erreur_prenom"></div>
                        </div>

                    </div>
                    <div class="naissance-mdp">
                        <div class="label naissance">
                            <label for="date">Date de naissance :</label>
                            <input class="width-ltl-form" type="date" id="date_naissance" name="date" value="<?php /* if(!empty($_POST['date'])){echo$_POST['date'];}*/ ?>">
                            <div class="erreur_date"></div>
                        </div>

                        <div class="label mdp">
                            <label for="mdp">Mot de passe :</label>
                            <input class="width-ltl-form" type="password" id="mot_de_passe" name="mdp" placeholder="6+ caractères" onfocus="this.placeholder=''" value="<?php /*if (!empty($_POST['mdp'])) {
                                                                                                                                                                            echo $_POST['mdp'];
                                                                                                                                                                        }*/ ?>">
                            <div class="erreur_mdp"></div>
                        </div>

                    </div>
                    <div class="erreur_glo"></div>
                </div>
                <div class="submit-container">
                    <div id="confirm"> <input type="SUBMIT" id="submit" name="confirmer" size="18" value="S'inscrire"></div>
                </div>
            </form>
        </div>
    </section>
    <?php
    include  "../table.php";
    if (!empty($_POST['confirmer'])) {
        if (!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
    ?>
                <script type="text/javascript">
                    document.getElementsByClassName('erreur_email')[0].innerHTML = "!&nbsp;E-mail incorrect";
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_email')[0].innerHTML = "!&nbsp;Saisissez votre e-mail";
            </script>
            <?php
        }
        if (!empty($_POST['mdp'])) {
            $mdplength = strlen($_POST['mdp']);
            if ($mdplength >= 6) {
                $mdp = $_POST['mdp'];
            } else {
            ?>
                <script type="text/javascript">
                    document.getElementsByClassName('erreur_mdp')[0].innerHTML = "!&nbsp;6 caractères minimum requis";
                </script>
            <?php
            } 
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_mdp')[0].innerHTML = "!&nbsp;Saisissez un mot de passe ";
            </script>
        <?php
        }
        if (!empty($_POST['nom'])) {
            $nom = $_POST['nom'];
        } else {
        ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_nom')[0].innerHTML = "!&nbsp;Saisissez votre nom";
            </script>
        <?php
        }
        if (!empty($_POST['prenom'])) {
            $prenom = $_POST['prenom'];
        } else {
        ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_prenom')[0].innerHTML = "!&nbsp;Saisissez votre prénom";
            </script>
        <?php
        }
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
        } else {
        ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_date')[0].innerHTML = "!&nbsp;Saisissez votre date de naissance";
            </script>

            <?php
        }
        if (!empty($email)) {
            $results = table(
                "SELECT utilisateur.email FROM `utilisateur` WHERE email = :email;",
                [
                    'email' => $email
                ]
            );
            if ($results->rowCount() > 0) {
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
                                                                                        color: #6F6F6F;"> Un compte existe déjà sous cette e-mail</p>
                                                                                    </div>
                                                                                </div>`;
                </script>
    <?php
            } else {
                if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($date) && !empty($mdp)) {
                    $results = table(
                        "INSERT INTO `utilisateur`(`nom`, `prenom`, `email`, `password`, `date_de_naissance`, `role`) VALUES (:nom, :prenom, :email, :mdp, :date, 'etudiant');",
                        [
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'email' => $email,
                            'mdp' => hash("sha256", $mdp),
                            'date' => $date
                        ]
                    );
                    header('Location: ../connexion/index.php');
                }
            }
        }
    }


    ?>
</body>

</html>