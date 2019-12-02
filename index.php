<html>
<head>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Accueil</title>
    <meta charset="utf-8">
</head>

<body>

<input type="checkbox" name="" checked="checked">
<span class="icon"></span>
<ul>
    <?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
    ?>
    <li><a href="inscription.php">Inscription</li></a>
    <li><a href="connexion.php">Se connecter</li></a>
    <?php 
    }
    ?>
    <li><a href="index.php">Accueil</li></a>
    <li><a href="livreor.php">Livre d'or</li></a>
    <?php 
    if(isset($_SESSION['login']) && isset($_SESSION['password']))
    {
    ?>
    <li><a href="commentaire.php">Ton avis ?</li></a>
    <li><a href="profil.php">Modification Profil</li></a>
    <li><a href="deconnexion.php">Déconnexion</li></a>

<?php
    } 
?>
</ul>

<section class="index" id="hotel1">
    
        <p class="text">Hôtel de luxe & balnéothérapie</p>
 
</section>

<section class="index" id="hotel">
  
</section>

<section class="index" id="hotel2">
</section>

</body>
</html>