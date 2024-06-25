<?php
    session_start();
    require('../DBTransaction.php');
    $msg="";
    $transaction = new DBTransaction();
    if (isset($_POST) && isset($_POST['click'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $tel = $_POST['tel'];
        $password = $_POST['password'];
        $result = $transaction->inscription($nom,$prenom,$adresse, $tel,$password, "CLIENT");
        if($result==0){
            $msg= "Donnees invalide";
          }else{
            header('Location:connexion.php');
            }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
       <link rel="stylesheet" href="../assets/styles/form.css">
       <link rel="stylesheet" href="../assets/styles/inscription.css">
    </head>
<body>
    <form action="inscription.php" method="POST">
    <?php if ($msg!="") { ?>
                <div class="alert alert-danger" role="alert">
                    <?=$msg; ?>
                </div>
            <?php } ?> 
    <div class="wrapper">
      <div class="form">
      <div class="title">
        Veuillez vous s'inscrire 
      </div>
          <div class="input_field">
              <label>Nom</label>
              <input type="text" name="nom"  class="input">
          </div>
          <div class="input_field">
            <label>Prenom</label>
            <input type="text" name="prenom" class="input">
        </div> 
        <div class="input_field">
            <label>Adresse</label>
            <input type="text" name="adresse" class="input">
        </div>
        <div class="input_field">
            <label>Telephone</label>
            <input type="text" name="tel" class="input">
        </div> 
        <div class="input_field">
            <label>password</label>
            <input type="password" name="password" class="input">
        </div>
        <div class="input_field">
       <input type="submit" name="click" value="S'incrire" class="btn">
        </div>
      </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>                                            
