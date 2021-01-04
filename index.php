<?php
    
    if(!isset($_SESSION)) 
    { 
        session_start();
    } else {
        session_destroy();
        session_start(); 
    }
    ob_end_clean();
    
?>
<!DOCTYPE html>
<html lang="fr">

<style>
.big {
    font-size: 1.5em;
    color: red;
}
</style>

<body>
    <div class="container mt-5">
            <p>Vous pouvez charger des fichiers "gif", "png", "jpg", "jpeg"</p>
            <?php if(isset($_SESSION['capacite'])) { ?>
            <p class="big">L'image a une trop grande capacité, veuillez en choisir une plus petite</p>
            <?php } ?>
            <form method="POST" action="affiche.php" enctype="multipart/form-data">
                <input type="file" name="img"/>
                <input type="submit" name="envoyer" />
            </form>
    </div>
</body>
</html>