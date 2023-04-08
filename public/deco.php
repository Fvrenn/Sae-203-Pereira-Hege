    <?php
    session_start();
    session_destroy();
    header('Location: comnnexion.php');
    exit;
    ?>