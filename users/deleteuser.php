<?php
session_start();
if (!isset($_SESSION) && !isset($_SESSION['user'])){
header("Location:connexion.php");
}
if ($_SESSION['User']['profile']!="ADMIN"){
 header("Location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$user = $transaction->deletUserById($_GET['iduser']);
var_dump($_GET['iduser']);
header('location:listboutiquier.php');
?>