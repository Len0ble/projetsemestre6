DROP DATABASE IF EXISTS `FineShop`;
CREATE DATABASE IF NOT EXISTS `FineShop`;
USE `FineShop`;
--  user = utilisateur
CREATE TABLE `User`(
 `id` int PRIMARY KEY AUTO_INCREMENT,
 `nom` VARCHAR(100),
 `prenom` VARCHAR(100),
 `adresse` VARCHAR(100),
 `tel` VARCHAR(20) UNIQUE,
 `pwd` VARCHAR(100),
--  type UNUM pour dire enumeeration
 `profile` ENUM("ADMIN","BOUTIQUIER","CLIENT")
);
CREATE TABLE `Produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` VARCHAR(100),
  `description` TEXT,
  `prixU` float,
  `image` VARCHAR(100),
  `id_boutiquier` int,
  CONSTRAINT `fk_boutiquier` FOREIGN KEY (`id_boutiquier`) REFERENCES `User` (`id`)
);
CREATE TABLE `Panier` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `montantTOT` float,
  `id_client` int,
  CONSTRAINT `fk_client` FOREIGN KEY (`id_client`) REFERENCES `User` (`id`)
);
CREATE TABLE `Commande` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `date` date,
  `montantTOT` float,
  `etat` ENUM('EN COURS', 'VALIDER', 'REJETER'),
  `id_client` int,
  CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `User` (`id`)
);
CREATE TABLE `ProduitCommande`(
 `id` int PRIMARY KEY AUTO_INCREMENT,
 `id_commande` int, 
 `id_produit` int,
 `nbr` int,
 `montantTOT`float,
 CONSTRAINT FOREIGN KEY (`id_commande`) REFERENCES `Commande`(`id`),
 CONSTRAINT FOREIGN KEY (`id_produit`) REFERENCES `Produit`(`id`)
);
CREATE TABLE `ProduitPanier`(
 `id` int PRIMARY KEY AUTO_INCREMENT,
 `id_panier` int ,
 `id_produit` int,
 `nbr` int,
 `montantTOT` float,
 CONSTRAINT FOREIGN KEY (`id_Panier`) REFERENCES `Panier`(`id`),
 CONSTRAINT FOREIGN KEY (`id_produit`) REFERENCES `Produit`(`id`)
);
CREATE TABLE `Categorie`(
 `id` int PRIMARY KEY AUTO_INCREMENT,
 `nom` VARCHAR(100),
 `description` TEXT
);

--  ajouter 2 produits dans le panier qui a l'id =1(DETAILS PANIER)
INSERT INTO`ProduitPanier`VALUE(null,1,2,2,(2*2500));
INSERT INTO`ProduitPanier`VALUE(null,1,4,2,(2*1000));
INSERT INTO`Commande`VALUE(null,"2021-02-26", 7000,"Valider", 3);
--  ajouter 2 Produits dans le Commande qui a l'id =1(DETAILS COMMANDE)
INSERT INTO`ProduitCommande`VALUE(null,1,2,2,(2*2500));
INSERT INTO`ProduitCommande`VALUE(null,1,4,2,(2*1000));
-- SELECT AVOIRE LE BOUBIQUIER ET SES PRODUITS
SELECT * FROM `User` JOIN `Produit` ON User.id=Produit.id_boutiquier;
SELECT * FROM `User` JOIN `Panier` ON User.id=Panier.id_client;
SELECT * FROM `User` JOIN `Commande` ON User.id=Commande.id_client;
SELECT * FROM `User` JOIN `ProduitCommande` ON User.id=ProduitCommande.id_commande;
SELECT * FROM `User` JOIN `ProduitPanier` ON User.id=ProduitPanier.id_Panier;
SELECT * FROM `User` JOIN `ProduitCommande` ON User.id=ProduitCommande.id_Produit;
SELECT * FROM `User` JOIN `ProduitPanier` ON User.id=ProduitPanier.id_Produit;




/*function telechargeImage($imageInfos){
  $nomImage=$imageInfos['name'];
  // le chemin d'accer
  $imagePath = $imageInfos['tmp_name'];
  //cest cette fonction qui fait le telecharger
  move_uploaded_file($imagePath,"../assets/images".$nomImage);
}*/