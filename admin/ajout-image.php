<?php   
require_once '../connect.php';

$reqImages = $db->prepare('INSERT INTO `image` (`id_gite`,`name_image`) VALUES (:id_gite, :name_image)');

$reqImages->bindParam('id_gite', $idGite, PDO::PARAM_INT);
$reqImages->bindParam('name_image', $name_image, PDO::PARAM_STR);
$reqImages->execute();

// var_dump($name_image);

// var_dump($idGite);