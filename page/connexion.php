<?php
session_start();
    require('../DBTransaction.php');
     $transaction = new DBTransaction();
     $msg="";
    if (isset($_POST) && isset($_POST['click'])){
            $tel = ( $_POST['tel']);
            $pwd = ($_POST['pwd']);
             $result = $transaction->connexion($tel,$pwd);
            if ($result!=null){
                $_SESSION['User']=$result;
                header("Location:../index.php");
        }
        $msg = "Numero de telephone ou mot de pass invalide";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
       <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
       <link rel="stylesheet" href="../assets/styles/form.css">
</head>
<body>
<div class="bg-img">
        <div class="content">
            <header>Connexion</header>
            <form action="connexion.php" method="POST">
            <?php if($msg!=""){ ?>
                <div class="alert alert-danger" role="alert">
                  <?=$msg?>
                </div>
           <?php } ?>
                <div class="fiel">
                    <span class="fa fa-user"></span>
                    <input type="text" name="tel" placeholder="phone">
                </div>
                <div class="fiel space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="pwd" placeholder="password" required>
                </div>
                <div class="pass">
                    <a href="#">Mot de pass oublier?</a>
                </div>
                <div class="fiel">
                    <input type="submit" name="click" value="Connexion" required>
                </div>
             <div class="login">Ou connectez-vous avec</div>
             <div class="link">
                 <div class="facebook">
                 <a href="https://www.facebook.com"target="_blank"><i class="bi bi-facebook"><span>Facebook</span></i></a> 
                 </div>
                 <div class="instagram">
                  <a href="https://www.instagram.com"target="_blank"><i class="bi bi-instagram"><span>Instagram</span></i></a>
                </div>
             </div>
             <div class="signup">Si tu n'as pas de compte
                 <a href="inscription.php">s'inscrire</a>
             </div>
            </form>
        </div>
    </div>
</html>
