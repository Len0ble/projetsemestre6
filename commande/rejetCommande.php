<?php
session_start();
if (!isset($_SESSION['User'])){
header("Location:connexion.php");
}
if ($_SESSION['User']['profile']!="BOUTIQUIER"){
 header("Location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$produit = $transaction->rejetCommande($_GET['idcommande']);
header('Location:commandeclient.php');
?>