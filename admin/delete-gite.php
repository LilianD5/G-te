<!-- DELETE ? -->
<?php

    require_once '../connect.php';

    $id = $_POST['id_gite'];
 
    $req = $db->prepare('DELETE FROM `cottages` WHERE id_gite = :id');

    $req->bindParam('id', $id, PDO::PARAM_STR);

    $req->execute();

    $reqImage = $db->prepare('DELETE FROM `image` WHERE id_gite = :id');

    $reqImage->bindParam('id', $id, PDO::PARAM_STR);

    $reqImage->execute();

    $reqOpt = $db->prepare('DELETE FROM `gite_option` WHERE id_gite = :id');

    $reqOpt->bindParam('id', $id, PDO::PARAM_STR);

    $reqOpt->execute();

