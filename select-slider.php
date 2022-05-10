<?php

require_once './connect.php';

$idGite = $_GET['id'];

$reqImage = $db->prepare('SELECT `name_image` FROM `image` WHERE `id_gite` = :id_gite');
$reqImage->bindParam('id_gite', $idGite, PDO::PARAM_INT);
$reqImage->execute();

echo json_encode($reqImage->fetchAll(PDO::FETCH_ASSOC));

