<?php

require_once '../connect.php';

$id = $_GET['id'];

if ($ref == null || $extensionUpload == null) {

    $req = $db->prepare('UPDATE `cottages` SET `id_categ` = :id_categ, `name_gite`= :name_gite, `name_simple_gite` = :name_simple_gite,`location_gite`= :location_gite, `desc_gite`= :desc_gite,`nbr_sleeping`=  :nbr_sleeping, `nbr_bathroom`= :nbr_bathroom, `price_night` = :price_night WHERE `id_gite` = :id');

    $req->bindParam('id', $id, PDO::PARAM_STR);
    $req->bindParam('id_categ', $id_categ, PDO::PARAM_STR);
    $req->bindParam('name_gite', $name_gite, PDO::PARAM_STR);
    $req->bindParam('name_simple_gite', $name_simple_gite, PDO::PARAM_STR);
    $req->bindParam('location_gite', $location_gite, PDO::PARAM_STR);
    $req->bindParam('desc_gite', $desc_gite, PDO::PARAM_STR);
    $req->bindParam('nbr_sleeping', $nbr_sleeping, PDO::PARAM_INT);
    $req->bindParam('nbr_bathroom', $nbr_bathroom, PDO::PARAM_INT);
    $req->bindParam('price_night', $price_night, PDO::PARAM_INT);

    $req->execute();

    if($option[0] != null){
        
        $reqOldOptions = $db->prepare('DELETE FROM gite_option WHERE `id_gite` = :id');

        $reqOldOptions->bindParam('id', $id, PDO::PARAM_STR);

        $reqOldOptions->execute();
    
        $reqNewOptions = $db->prepare('INSERT INTO gite_option (`id_gite`, `id_suppl`) VALUES (:id, :id_suppl)');

        foreach($option as $suppl){

            $reqNewOptions->bindParam('id', $id, PDO::PARAM_STR);
            $reqNewOptions->bindParam('id_suppl', $suppl, PDO::PARAM_STR);

            $reqNewOptions->execute();
        }
    }
} else {
    
    $req = $db->prepare('UPDATE `cottages` SET `id_categ` = :id_categ, `name_gite`= :name_gite, `name_simple_gite` = :name_simple_gite,`location_gite`= :location_gite, `profil_gite` = :profil_gite, `desc_gite`= :desc_gite,`nbr_sleeping`=  :nbr_sleeping,`nbr_bathroom`= :nbr_bathroom, `price_night` = :price_night WHERE `id_gite` = :id');

    $req->bindParam('id', $id, PDO::PARAM_STR);
    $req->bindParam('id_categ', $id_categ, PDO::PARAM_STR);
    $req->bindParam('name_gite', $name_gite, PDO::PARAM_STR);
    $req->bindParam('name_simple_gite', $name_simple_gite, PDO::PARAM_STR);
    $req->bindParam('location_gite', $location_gite, PDO::PARAM_STR);
    $req->bindParam('profil_gite', $profil_gite, PDO::PARAM_STR);
    $req->bindParam('desc_gite', $desc_gite, PDO::PARAM_STR);
    $req->bindParam('nbr_sleeping', $nbr_sleeping, PDO::PARAM_INT);
    $req->bindParam('nbr_bathroom', $nbr_bathroom, PDO::PARAM_INT);
    $req->bindParam('price_night', $price_night, PDO::PARAM_INT);

    $req->execute();

    if($option[0] != null){
        
        $reqOldOptions = $db->prepare('DELETE FROM gite_option WHERE `id_gite` = :id');

        $reqOldOptions->bindParam('id', $id, PDO::PARAM_STR);

        $reqOldOptions->execute();
    
        $reqNewOptions = $db->prepare('INSERT INTO gite_option (`id_gite`, `id_suppl`) VALUES (:id, :id_suppl)');

        foreach($option as $suppl){

            $reqNewOptions->bindParam('id', $id, PDO::PARAM_STR);
            $reqNewOptions->bindParam('id_suppl', $suppl, PDO::PARAM_STR);

            $reqNewOptions->execute();
        }
    }
}
