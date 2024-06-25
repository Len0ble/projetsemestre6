<?php
// ca permet de se connecte a notre base de donne
class DBTransaction{
    public $database;
    public function __construct(){
        //$this represente la class
       if($this->database==null){
           //le protocole c mysql au lieu de https
           $urlDB ="mysql:host=localhost;dbname=FineShop";
           $username="root";
           $password="";
           $this->database = new PDO($urlDB,$username,$password);
           // changer la mode d'envoyer des donnees par defaut c sous forme de tableau associatif
           // elle joue le meme role que json decode 
           $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

       }
    }
    public function searchproduct($keywords){
        try {
            $result = $this->database->query("SELECT *FROM `Produits` WHERE nom LIKE '%$keywords%' ");
            return $result->fetchAll();
        } catch (\PDOException $th) {
            return null;
        }
        
    }
    
    public function createProduitPanier($id_panier,$id_produit,$nbr,$montantTOT){
        try {
            $result = $this->database->query("INSERT INTO `ProduitPanier`
             VALUE(null,'$id_panier', '$id_produit', '$nbr', '$montantTOT' )");
             $result->fetch();
          return 1;
        } catch (\PDOException $th) {
           return 0;
        }
 }
        
        
        public function createProduitCommande($id_commande,$id_produit,$nbr,$montantTOT){
            try {
                $result = $this->database->query("INSERT INTO `ProduitCommande`
                 VALUE(null,'$id_commande', '$id_produit', '$nbr', '$montantTOT' )");
                 $result->fetch();
              return 1;
            } catch (\PDOException $th) {
               return 0;
            }
     }
        
        public function createPanier($montantTOT,$id_client){
            try {
                $result = $this->database->query("INSERT INTO `Panier` VALUE(null,'$montantTOT','$id_client')");
                $result->fetch();
               return 1;
            } catch (\PDOException $th) {
                return O;
            }
    }
        
        public function createCommande($date,$montantTOT,$etat,$id_client){
            try {
                $result = $this->database->query("INSERT INTO `Commande` VALUE(null,'$date','$montantTOT','$etat','$id_client')");
                $result->fetch();
               return 1;
            } catch (\PDOException $th) {
                return O;
            }
    }

    public function createproduct($nom, $description, $prixU, $image, $id_boutiquier){
        try{
            $result = $this->database->query("INSERT INTO `Produit` VALUE( NULL,'$nom','$description','$prixU','$image','$id_boutiquier','0')");
            $result->fetch();
            return 1;
        }catch(\PDOException $th) {
            return 0;
        }
       
}

public function inscription($nom,$prenom,$adresse, $tel,$pwd,$profile){ 
    try{
            $result = $this->database->query("INSERT INTO `User` VALUE(null,'$nom','$prenom','$adresse','$tel','$pwd','$profile','0')");
            // renvoi 0 si erreur ou n si op d'erreur
            $result->fetch(); 
            return 1;
        }catch(\PDOException $th) {
            return 0;
        }
}


public function connexion($tel,$pwd){
    try{
        $result = $this->database->query("SELECT * FROM `User` where tel='$tel' AND pwd='$pwd'");
        //fetch renvoit un seul valeur et fetchAll renvoit plusieurs valeurs
        return $result->fetch();
    } catch(\PDOException $th) {
        return 0;
    } 
}

  function getALLproduct(){
    $result = $this->database->query("SELECT * FROM Produit WHERE corbeille='0'");
    return $result->fetchAll();
 }

   public function readProductByid($id){
       try{
        $result = $this->database->query("SELECT * FROM Produit where id=  $id");
        return $result->fetchAll();
       } catch(\PDOException $th) {
        return 0;
    } 
 }

 public function getProductByIdBoutiquier($id_boutiquier){
     $result = $this->database->query("SELECT * FROM `Produit`WHERE corbeille='0'AND id_boutiquier='$id_boutiquier'");
     return $result->fetchAll();
 }


public function getAlluser(){
    try {
        $result = $this->database->query("SELECT * FROM `User` WHERE corbeille='0'");
    return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}

public function getClientPanier($id_client){
    try {
        $result = $this->database->query("SELECT * FROM `Panier` WHERE id_client='$id_client'");
        return $result->fetch();
    } catch (\PDOException $th) {
        return null;
    }
}


public function getCommandeClient($id_client){
    try {
        $result = $this->database->query("SELECT * FROM `Commande` WHERE id_client='$id_client' ORDER BY 'desc'");
        return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}

public function getProduitPanier($id_panier){
    try {
        $result = $this->database->query("SELECT * FROM `Produit` JOIN `ProduitPanier`  ON ProduitPanier.id_produit=Produit.id WHERE id_panier=$id_panier");
        return $result->fetchAll();
        // ca permet de ne op selectionner tout 
        //nom, Produit.id as id_produit, ProduitPanier.id as id_panier, 
    } catch (\PDOException  $th) {
      return null;
    }
    
}

public function getProduitCommande($id_commande){
    try {
        $result = $this->database->query("SELECT * FROM `ProduitCommande` JOIN  `Produit` ON ProduitCommande.id_produit=Produit.id WHERE id_commande='$id_commande'");
        return $result->fetchAll();
    } catch (\PDOException  $th) {
      return null;
    }
    
}

public function  getAllCategories(){
    try {
        $result = $this->database->query("SELECT * FROM `Categorie`");
        return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}
 
public function createCategorie($nom,$description){
    try {
        $result = $this->database->query("INSERT INTO `Categorie` VALUE(null,'$nom','$description')");
        $result->fetch();
       return 1;
    } catch (\PDOException $th) {
        return O;
    }
}

public function getAllCommande(){
    try {
        $result = $this->database->query("SELECT * FROM `Commande` ORDER BY 'desc'");
        return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}

public function getuserById($id){
        $result = $this->database->query("SELECT * FROM `User`WHERE id='$id' AND corbeille='0'");
        return $result->fetch();
}

public function getPanierById($id){
        $result = $this->database->query("SELECT * FROM `ProduitPanier` WHERE id='$id'");
        return $result->fetch();
}


public function getProductById($id_produit){

    $result = $this->database->query("SELECT * FROM `Produit`WHERE id='$id_produit'AND corbeille='0'");
    return $result->fetch();
}


public function getCategorieById($id_categorie){

    $result = $this->database->query("SELECT * FROM `Categorie`WHERE id='$id_categorie'");
    return $result->fetch();
}


public function rejetCommande($id_commande){
    try {
        $result = $this->database->query("UPDATE `Commande` SET etat='REJETER' WHERE id='$id_commande'");
        return $result->fetch();
    } catch (\PDOException $th) {
        return null;
    }  
}

public function validerCommande($id_commande){
    try {
        $result = $this->database->query("UPDATE `Commande` SET etat='VALIDER' WHERE id='$id_commande'");
        $result->fetch();
       return 1;
    } catch (\PDOException $th) {
        return O;
    }
}


public function updateUser($id,$nom,$prenom,$adresse,$tel,$pwd,$profile){
    try {
    $result =$this->database->query("UPDATE `User` SET nom='$nom',prenom='$prenom',adresse='$adresse',tel='$tel',pwd='$pwd',profile='$profile',corbeille='0' WHERE id='$id_user'");
    $result->fetch();
   return 1;
    } catch (PDOException $th) {
        return O;
    }
}

public function updateProfilUser($id,$profile){
    try {
    $result =$this->database->query("UPDATE `User` SET profile='$profile'WHERE id='$id'");
    $result->fetch();
   return 1;
    } catch (PDOException $th) {
        return O;
    }
}

public function updateCategorie($id,$nom,$description){
    try {
    $result =$this->database->query("UPDATE `Categorie` SET nom='$nom',description='$description' WHERE id='$id'");
    $result->fetch();
   return 1;
    } catch (PDOException $th) {
        return O;
    }
}

public function updateprofil($id,$nom,$prenom,$adresse,$tel,$pwd){
    try {
    $result =$this->database->query("UPDATE `User` SET nom='$nom',prenom='$prenom',adresse='$adresse',tel='$tel' WHERE id='$id'");
   return 1;
    } catch (PDOException $th) {
        return O;
    }
}

  public function updatePanier($id_panier,$montantTOT){
    try {
        $result = $this->database->query("UPDATE `Panier` SET montantTOT='$montantTOT' WHERE id='$id_panier'");
        $result->fetch();
       return 1;
    } catch (\PDOException$th) {
        return O;
    }
 }

public function updateNbrPanier($id,$nbr){
    try {
        $result =$this->database->query("UPDATE `ProduitPanier` SET nbr='$nbr' WHERE id='$id'");
         $result->fetch();
       return 1;
        } catch (PDOException $th) {
            return O;
        }
}

public function updateNbrproduitPanier($id,$nbr,$montantTOT){
    try {
    $result =$this->database->query("UPDATE `ProduitPanier` SET nbr='$nbr',montantTOT='$montantTOT' WHERE id='$id'");
    $result->fetch();
   return 1;
    } catch (PDOException $th) {
        return O;
    }
}

public function updateproduit($id, $nom, $description,$prixU){
    $result =$this->database->query("UPDATE `Produit` SET nom='$nom',description='$description',prixU='$prixU',corbeille='0' WHERE id='$id'");

}

public function deletPanierById($id){
    try {
            $result = $this->database->query("DELETE FROM `ProduitPanier`WHERE id='$id'");
    } catch (\PDOException $th) {
        return null;
    }
}

public function deletCategorieById($id){
    try {
            $result = $this->database->query("DELETE FROM `Categorie`WHERE id='$id'");
    } catch (\PDOException $th) {
        return null;
    }
}

public function deletProductPanier($id){
    try {
        $result = $this->database->query("DELETE  FROM `ProduitPanier` WHERE id='$id'");
    } catch (\PDOException $th) {
        return null;
    }  
}

// ca permet de supprimer panier deja valider
public function resetPanier($id_panier){
    $result = $this->database->query("DELETE FROM `ProduitPanier` WHERE id_panier='$id_panier'");
    return $result->fetch();
}

  public function deletUserById($id_user){
    try {
            $result = $this->database->query("UPDATE `User` SET corbeille='1' WHERE id='$id_user'");
    } catch (\PDOException $th) {
        echo 'Erreur'.$th;
    }
 }

  public function deletProductById($id_produit){
        try {
            $result = $this->database->query("UPDATE `Produit` SET corbeille='1'  WHERE id='$id_produit'");
        } catch (\PDOException $th) {
            echo 'Erreur'.$th;
        }  
}

}
?>


