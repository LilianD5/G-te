<?php

require_once '../connect.php';

$id_gite = $_GET['id'];

$reqImg = $db->prepare("SELECT `id_image`, `name_image` FROM `image` WHERE `id_gite` = :id_gite ORDER BY `id_image` DESC LIMIT 10");

$reqImg->bindParam('id_gite', $id_gite, PDO::PARAM_STR);

$reqImg->execute();

echo json_encode($reqImg->fetchAll(PDO::FETCH_ASSOC));
