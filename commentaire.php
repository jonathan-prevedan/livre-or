<?php
session_start();
$connexion = mysqli_connect("localhost", "root", "", "livreor");


if(isset($_SESSION["id"]))
{
	$getid = intval($_SESSION["id"]);
	$query = "SELECT * FROM utilisateurs WHERE id='$getid'";
	$execquery = mysqli_query($connexion, $query);
	$userinfo = mysqli_fetch_all($execquery);


    if(isset($_POST["formcommentaire"]))
    {
        if(!empty($_POST["commentaire"]))
        {
            $commentaire = htmlspecialchars($_POST["commentaire"]);
            $iduser = $_SESSION["id"];
            $query = "INSERT INTO commentaires(commentaire, id_utilisateur, date) VALUES ('$commentaire', '$iduser', NOW())";
            $execquery = mysqli_query($connexion, $query);
            $erreur = "Votre commentaire a bien été posté.";
        }
        else 
        {
            $erreur = "Le champs commentaire est vide.";
 
        }


}


?>
<html>

<head>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Accueil</title>
    <meta charset="utf-8">
</head>

<body id="register">
<input type="checkbox" name="" checked="checked">
<span class="icon"></span>
<ul>
    <?php 
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

<section class="index">

<form method="POST" class="formcom">

    <h3> Commentaire </h3>

    <label for ="login"> Mon commentaire : </label>
    <textarea value="" placeholder="Mon commentaire" class="inputcom" name="commentaire"></textarea>

    <input id="zbeub" type="submit" value="Valider" name="formcommentaire">

    <a href="livreor.php"> Retourner au livre d'or </a>

    <?php if(isset($erreur)) 
    {
        echo "<b>"."<p style='color:red; font-size:16px; padding-bottom:10%; text-align:center;'>".$erreur."</p>"."</b>";
    }
?>

</form>


<?php

}
else{
    header('Location: connexion.php');
}
?>
</section>
</body>
</html>