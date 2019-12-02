<?php 
session_start();
$connexion = mysqli_connect('localhost','root','','livreor');


if(isset($_POST['button']))
{
        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $cmdp = password_hash($_POST['cpassword'], PASSWORD_DEFAULT);
        $login = htmlspecialchars($_POST['login']);

        $loginlenght = strlen($_POST['login']);
        $nomlenght = strlen($_POST['nom']);
        $prenomlenght = strlen ($_POST['prenom']);
        

    if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['cpassword']))
    {   
        $login = $_POST['login'];
        $check = "SELECT login FROM utilisateurs WHERE login = '$login'";
        $query_exist= mysqli_query($connexion,$check);
        $result_exist= mysqli_num_rows($query_exist);
        
        
        if (mysqli_num_rows($query_exist) == 0)
    {  
        
        
        
            if($_POST['password'] == $_POST['cpassword'])
            {
                $insertmbr =("INSERT INTO utilisateurs(login,password) VALUES ('$login','$mdp')");
                $query= mysqli_query($connexion, $insertmbr);
                $eror = "Votre compte à bien été crée ! ";
                header('Location: index.php');
            }
            else
            {
                $eror = "Vos mots de passes ne correspondent pas !";
            }
            

        

    
    }
     else
     {
        $erreur = "Ce login n'est pas disponnible";
        echo "<b>".$erreur."</b>";
     }
    
    }
    else
        {
            $eror = "Tous les champs doivent être complétés.";
        }
}
if(isset($eror))
        {
            echo $eror;
        } 

        if(isset($_SESSION['login']))
        {
            header('Location: index.php');
        }
        
?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Inscription</title>
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
        <h3>Inscription</h3>
        <form method="POST" action="inscription.php">
            <input type="text" name="login" placeholder="Votre login" required>

            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="cpassword" placeholder="Confirmer" required>
            <input type="submit" name="button" value="S'inscrire">
            <?php 
            if(isset($eror))
        {
            echo $eror;
        } ?>

        </form>
</section>
</body>
</html>