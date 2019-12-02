<?php 
session_start();

$connexion= mysqli_connect('localhost','root','','livreor');

if(isset($_SESSION['id']))
{
    $getid = intval($_SESSION['id']);
    $query = "SELECT * FROM utilisateurs WHERE id='$getid'";
    $execquery = mysqli_query($connexion,$query);
    $useri = mysqli_fetch_all($execquery);
}

?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Livreor</title>
    <meta charset="utf-8">
</head>
    <body>
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


            <?php 
                $requete = "SELECT commentaire, DATE_FORMAT(date,'%a%e%b%Y'), login FROM commentaires INNER JOIN utilisateurs WHERE commentaires.id_utilisateur = utilisateurs.id ORDER BY DATE DESC";
                $execrequete= mysqli_query($connexion,$requete);
                $useri= mysqli_fetch_all($execrequete);
                $i = 0;

            foreach($useri as $key)
            {
                $commentaire = $useri[$i][0];
                $date = $useri[$i][1];
                $idutilisateur = $useri[$i][2];
            
            
            ?> 

        <section class="index" id="commentaire">
                <?php 
                    echo ' par '.$idutilisateur.' le '.$date.'</br>'.$commentaire;
                ?>
        </section>   

            <?php 
                $i++;
            }
            ?>

    </body>
</html>