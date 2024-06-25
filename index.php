<?php
session_start();
require('DBTransaction.php');
$transaction = new DBTransaction();
$produits = $transaction->getAllProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FineShop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2fXr4" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/styles/nave.css">
    <link rel="stylesheet" href="assets/styles/list.css">
</head>
<body>
<div class="header">
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="assets/image/logoo.png" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"><i class="bi bi-house-door-fill"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="panier/panier.php"><i class="bi bi-cart4"></i> Panier</a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link" href="panier/commande.php"><i class="bi bi-list-ul"></i> Commandes</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="page/profil.php"><i class="bi bi-person-check-fill"></i> Profil</a>
                    </li>
                    <li class="nav-item">
                    <?php if (isset($_SESSION['User']) && isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] == 'boutiquier') : ?>
                        <a class="nav-link active" href="produits/listproduit.php"><i class="bi bi-cart4"></i> Produit</a>
                    <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['User']) && isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] == 'boutiquier') : ?>
                            <a class="nav-link" href="commande/commandeclient.php"><i class="bi bi-cart-check-fill"></i> Commandes clients</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['User']) && isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] != 'admin') : ?>
                            <a class="nav-link" href="users/listboutiquier.php"><i class="bi bi-person-check-fill"></i> Utilisateurs</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="page/connexion.php"><i class="bi bi-person-check-fill"></i> Connexion</a>
                    </li>
                </ul>
                <form class="d-flex" action="" method="POST">
                    <input class="form-control me-2" type="Search" placeholder="Search" aria-label="Search"
                           name="Search">
                    <button class="btn btn-outline-success" class="" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="conteneur">
        <div class="slogan">
            <h2>NIKE NEW <br> COLLECTION!</h2>
            <h5>Toujours plus <br> D'exclusivités <br>Pour Vous</h5>
            <div>
                <a href="#" class="btn btn-outline-danger">NOS PRODUITS</a>
            </div>
        </div>
        <div class="image">
            <img src="assets/image/shoes nike.png" alt="">
        </div>
    </div>
</div>

<div class="middle">
    <div class="container listproduit">
        <?php foreach($produits as $key => $produit): ?>
            <div class="card" style="width: 18rem;">
                <img src="assets/image/<?=$produit['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$produit['nom']?></h5>
                    <p class="card-text"><?=$produit['description']?></p>
                    <div class="prix">
                        <p><span class="prixU"><?=$produit['prixU']?> cfa</span></p>
                    </div>
                    <div class="col-md-12 cart@">
                        <a class="btn btn-outline-danger" href="panier/ajoutPanier.php?idProduit=<?=$produit['id']?>">Acheter</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div><br><br>

<div id="footer">
    <h2><img src="assets/image/footer.png" alt=""></h2>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-V/8cL6wOimXvKJaczfwfwp6KLiGhP7T6ZwYWFHf7CSfMbmYspvPl5M5Cpjw2GWBF2VfVzpt+T6V
</body>
</html>
