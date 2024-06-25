<?php
// CA permet de securiser
session_start();
// $_SESSION['user']=user connecter toujour
if (!isset($_SESSION['User'])){
header("Location:connexion.php");
}
if ($_SESSION['User']['profile']!="BOUTIQUIER"){
 header("Location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$commandes=$transaction->getAllCommande();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Client</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/list.css">
    <link rel="stylesheet" href="../assets/styles/nave.css">

</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-white ">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"><img src="../assets/image/logoo.png"class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="../index.php"><i class="bi bi-house-door-fill"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../panier/panier.php"><i class="bi bi-cart4"></i>Panier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../panier/commande.php"><i class="bi bi-list-ul"></i>Commandes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../page/profil.php"><i class="bi bi-person-check-fill"></i>Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../produits/listproduit.php"><i class="bi bi-cart4"></i> Produit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commandeclient.php"><i class="bi bi-cart-check-fill"></i> Commandes clients</a>
        </li>
        <li class="nav-item">
          <?php if (isset($_SESSION['User']) && isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] != 'admin') : ?>
            <a class="nav-link" href="../users/listboutiquier.php"><i class="bi bi-person-check-fill"></i> Utilisateurs</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../page/deconnection.php"><i class="bi bi-box-arrow-right"></i> Se deconnecte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
<table action="commandeclient.php"method="POST" class="table commandelist">
  <thead class="table-dark">
       <tr>
           <th>Id</th>
           <th>Date</th>
           <th>MontantTOT</th>
           <th>état</th>
           <th>details</th>

           
       </tr>
  </thead>
  <tbody>
  <?php
      foreach ($commandes as $key => $value) {?>
         <tr>
               <td><?= $value['id_client'] ?></td>
               <td><?= $value['date'] ?></td>
               <td><?= $value['montantTOT']?> cfa</td>
               <td><?= $value['etat'] ?></td>
               <td> <a href="detailCommande.php?idcommande=<?=$value['id']?>">Voir details</a></td>
               <td> <a href="rejetCommande.php?idcommande=<?=$value['id']?>">Rejeter</a></td>   
               <td> <a href="valideCommande.php?idcommande=<?=$value['id']?>">Valider</a></td>   
         </tr>
  <?php } ?>
  </tbody>
</table>
</div> <br><br>

<div id="footer">
      <h2><img src="../assets/image/footer.png" alt=""></h2>
        <div class="content">
            <h3>Contacter-nous ?</h3>
            <p>Tel : +221 78 335 33 18</p>
            <p>E-mail : contact@-fineshop.com</p>
            <h3>S'inscrire à notre newsletter</h3>
            <form action="">
                <textarea name="" id="" cols="70" rows="5" placeholder="S'inscrire..."></textarea>
            </form>
        </div>
    </div>
    <div id="copyrith">
    <p>copyrith 2022 par FineShop</p>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>