<?php
session_start();
if (!isset($_SESSION['User'])){
    header("Location:connexion.php");
}


require('../DBTransaction.php');

$transaction = new DBTransaction();

$idProduit =$_GET['idProduit']; //la clee quon avait pricisé dans index

$produit = $transaction->getProductById($idProduit);

if($produit ==null){
die("Cet Produit n'est pas disponible");
}

$prixU = $produit['prixU']; //permet de recuperer le prix unitaire et il faut le faire apres la verification

$id_client = $_SESSION['User']['id']; //id_client du lutilisateur connecté
// dans le $panier on retrouve les informations du client connecter
$panier = $transaction->getClientPanier($id_client);
if($panier == null){// si le client n'a op de panier on le cree
  $result = $transaction->createPanier(0,$id_client);
  $panier = $transaction->getClientPanier($id_client);
}//  si le panier existe déja 

$id_panier= $panier['id'];
$result = $transaction->createProduitPanier($id_panier,$idProduit,1,$prixU);
if($result == 1){
    $montantTOT = $panier['montantTOT'] + $prixU;
    $result = $transaction->updatePanier($id_panier['id'],$montantTOT);
    header('location:panier.php');
}
?>