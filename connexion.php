<?php
$connexion = mysqli_connect("localhost", "root", "", "livreor");

session_start();
if(isset($_POST["buttonc"]))
{       
        $login = htmlspecialchars($_POST["login"]);
        $mdp = htmlspecialchars($_POST['password']);

        if(!empty($login) && !empty($mdp))
        {       
                $query = "SELECT login FROM utilisateurs WHERE login='$login'";
                $execquery = mysqli_query($connexion, $query);
                $rows = mysqli_num_rows($execquery);


                if($rows==0)
                {       $erreur = "Login ou mot de passe incorrect.";
                        
                }
                else
                {
                        
                        $checkpass = "SELECT password FROM utilisateurs WHERE login = '$login'";
                        $checkpassquery = mysqli_query($connexion,$checkpass);
                        $cryptedpass = mysqli_fetch_all($checkpassquery);
                        $cryptedpass = $cryptedpass[0][0];
                        $passencrypt = password_verify($mdp, $cryptedpass);
                        
                        if($passencrypt == true)
                        {
                        $userinfo = mysqli_fetch_all($execquery);
                        $infos = "SELECT id,login FROM utilisateurs WHERE login ='$login'";
                        $query = mysqli_query($connexion, $infos);
                        $result = mysqli_fetch_all($query);
                        $_SESSION['id'] = $result[0][0];
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['password'] = $_POST['password'];
                        header('Location: index.php');
                        }
                            
                        else
                        {
                                
                                $erreur = "Login ou mot de passe incorrect.";
                        }
                       
                }
                
       
}

else
{
        $erreur = "Tous les champs doivent être complétés.";
}


}

if(isset($_SESSION['login']))
{
    header('Location: index.php');
}

?>



                
        <?php if(isset($erreur)) 
    {
        echo "<b>"."<p style='color:red; font-size:20px; padding-bottom:20%; text-align:center; padding-top : 13%'>".$erreur."</p>"."</b>";
    }
?>

    <html>
<head>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Livreor</title>
    <meta charset="utf-8">
</head>

    <body id="connexion">

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
            <div class="login">
                <h3>Connecte toi </h3>

                <form method="post" action="connexion.php">
                    <input type="text" name="login"  placeholder="Login ?">
                    <input type="password" name="password" placeholder="Mot de passe ?">
                    <input type="submit" name="buttonc" value="Connexion">
                    <a href="inscription.php">S'inscrire</a>
                </form>
            </div>
        </section>
    </body>
</html>