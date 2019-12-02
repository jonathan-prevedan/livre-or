<?php
session_start();
$connexion = mysqli_connect("localhost", "root", "", "livreor");


$login=$_SESSION['login'];

    
if(isset($_POST['button']))
{   
    if(isset($_POST['login']))
    {
        if($_POST['login'] != $_SESSION['login'])
        {
            $userconnect = $_SESSION['id'];
            $login = htmlspecialchars($_POST['login']);
            $query = "UPDATE utilisateurs SET login='$login' WHERE id='$userconnect'";
            $execquery = mysqli_query($connexion, $query);
            $_SESSION['login'] = $login;
        }

    }
        
    if(isset($_POST['password']))
    {   
            $password = htmlspecialchars($_POST["password"]);
            $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
            $userconnect = $_SESSION['id'];
            $query = "UPDATE utilisateurs SET password='".$password."' WHERE id='$userconnect'";
            $execquery = mysqli_query($connexion, $query);
            $_SESSION['password'] = $password;

    }

      
}



if(empty($_SESSION['login']))
{
    header('Location: index.php');
}

if(isset($_POST['buttond']))
{
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    header('Location: index.php');
}

$admin_query= ("SELECT * FROM utilisateurs WHERE login = '$login'");
$exec_admin_query=mysqli_query($connexion,$admin_query);
$row= mysqli_fetch_array($exec_admin_query);





?>
<html>

<head>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Livreor</title>
    <meta charset="utf-8">
</head>


<body id ="register">

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

<form method="POST" action="" class="login-box">

<h1>Modifications Profil</h1>


        <input type="text" placeholder="Login" name="login" value="<?php echo $row['login']?>" required>
        
        <input type="password" placeholder="Mot de passe" name="password" value="" required>
       
        <input type="password" placeholder="Confirmation Mdp" name="cpassword" value="" required>

        <input id="bouton" type="submit" value="Appliquer" name="button">
        <input id="buttond" type="submit" value="Déconnecter" name="buttond">

<?php if(isset($erreur)) 
    {
        echo "<b>"."<p style='color:red; font-size:20px; padding-bottom:20%; text-align:center;'>".$erreur."</p>"."</b>";
    }
?>


</section>

</form>

</main>    

</body>

</html>
