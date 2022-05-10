<?php

require_once '../connect.php';

$idData = $_POST['id_image'];
var_dump($idData);

$req = $db->prepare('DELETE FROM `image` WHERE `id_image` = :id');
$req->bindParam('id', $idData, PDO::PARAM_STR);
$req->execute();