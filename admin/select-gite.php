<?php
require_once '../connect.php';

//On récupère en GET les valeurs du formualaire de recherche

//Couchages et SDb
$nbSleep = $_GET['nbSleep'];
$nbBath = $_GET['nbBathroom'];

//Catégories
$cat1 = $_GET['cat1'];
$cat2 = $_GET['cat2'];
$cat3 = $_GET['cat3'];
$cat4 = $_GET['cat4'];

//Options
$opt1 = $_GET['opt1'];
$opt2 = $_GET['opt2'];
$opt3 = $_GET['opt3'];
$opt4 = $_GET['opt4'];

//Recherche par nom
$search = $_GET['search'];

//On push les valeurs des options dans un tableau
$option = [];

array_push($option, $opt1, $opt2, $opt3, $opt4);


//Requête SQL option

$reqOpt = $db->prepare('SELECT `id_gite` FROM `gite_option` WHERE `id_suppl` = :id_suppl');

foreach ($option as $suppl) {

    $reqOpt->bindParam('id_suppl', $suppl, PDO::PARAM_STR);
    $reqOpt->execute();

    $value = $reqOpt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($value as $selec) {

        $opt[] = $selec['id_gite'];
    }
}

// var_dump($opt);
if(!empty($opt)){
    $optUnique = array_unique($opt);
    // var_dump($optUnique);
    $lenghtOptUnique = count($optUnique);
    // var_dump($lenghtOptUnique);
  }




if (!empty($optUnique)) {
    foreach ($optUnique as $id) {
        $sql = 'SELECT `id_gite`, `id_categ`, `name_gite`, `name_simple_gite`, `location_gite`, `profil_gite`, `desc_gite`, `nbr_sleeping`, `nbr_bathroom` FROM `cottages` ';


        $sql .= (null != $id) ? 'WHERE `id_gite` = :id ' : '';
        $sql .= (null != $nbSleep && null != $nbBath) ? 'AND `nbr_sleeping` >= :nb_sleep AND `nbr_bathroom` >= :nb_bathroom ' : '';
        $sql .= (null != $cat2) ? 'AND (' : ((null != $cat1) ? 'AND' : ''); 
        $sql .= (null != $cat1) ? ' `id_categ` = :cat1 ' : '';
        $sql .= (null != $cat2) ? 'OR `id_categ` = :cat2 ' : '';
        $sql .= (null != $cat3) ? 'OR `id_categ` = :cat3 ' : '';
        $sql .= (null != $cat4) ? 'OR `id_categ` = :cat4 ' : '';
        $sql .= (null != $cat2) ? ')' : '';
        $sql .= 'ORDER BY `id_gite` DESC';

        // var_dump($id);

        $reqGite = $db->prepare($sql);

        // var_dump($reqGite);

        (null != $id) ? $reqGite->bindParam('id', $id, PDO::PARAM_STR) : '';
        (null != $nbSleep) ? $reqGite->bindParam('nb_sleep', $nbSleep, PDO::PARAM_STR) : '';
        (null != $nbBath) ? $reqGite->bindParam('nb_bathroom', $nbBath, PDO::PARAM_STR) : '';
        (null != $cat1) ? $reqGite->bindParam('cat1', $cat1, PDO::PARAM_STR) : '';
        (null != $cat2) ? $reqGite->bindParam('cat2', $cat2, PDO::PARAM_STR) : '';
        (null != $cat3) ? $reqGite->bindParam('cat3', $cat3, PDO::PARAM_STR) : '';
        (null != $cat4) ? $reqGite->bindParam('cat4', $cat4, PDO::PARAM_STR) : '';

        $reqGite->execute();

        $valueReq[] = $reqGite->fetchAll(PDO::FETCH_ASSOC);

    }

    // var_dump($valueReq);


    for($i = 0; $i < $lenghtOptUnique; $i++){

    $jsonArray[] = '{"id_gite":"' . $valueReq[$i][0]['id_gite'] . '","id_categ":"' . $valueReq[$i][0]['id_categ'] . '","name_gite":"' . $valueReq[$i][0]['name_gite'] . '","name_simple_gite":"' . $valueReq[$i][0]['name_simple_gite'] . '","location_gite":"' . $valueReq[$i][0]['location_gite'] . '","profil_gite":"' . $valueReq[$i][0]['profil_gite'] . '","desc_gite":"' . $valueReq[$i][0]['desc_gite'] . '","nbr_sleeping":"' . $valueReq[$i][0]['nbr_sleeping'] . '","nbr_bathroom":"' . $valueReq[$i][0]['nbr_bathroom'] . '"';

    // var_dump($jsonArray);
    }

    $json = '';

    for($i = 0; $i < $lenghtOptUnique; $i++){
            $json .= ',' . $jsonArray[$i] . '}';
    }

    $jsonEncode = substr($json, 1);
    
    $jsonFinal = '[' . $jsonEncode . ']';

    echo $jsonFinal;

} else if (null != $search) {

    $searchByName = '%' . $search . '%';

    $reqGite = $db->prepare('SELECT `id_gite`, `id_categ`, `name_gite`, `name_simple_gite`, `location_gite`, `profil_gite`, `desc_gite`, `nbr_sleeping`, `nbr_bathroom`, `price_night` FROM `cottages` WHERE `name_gite` LIKE :search');

    $reqGite->bindParam('search', $searchByName, PDO::PARAM_STR);
    $reqGite->execute();

    echo json_encode($reqGite->fetchAll(PDO::FETCH_ASSOC));
    
} else {

    $sql = 'SELECT `id_gite`, `id_categ`, `name_gite`, `name_simple_gite`, `location_gite`, `profil_gite`, `desc_gite`, `nbr_sleeping`, `nbr_bathroom` FROM `cottages` ';

    $sql .= (null != $nbSleep && null != $nbBath) ? 'WHERE `nbr_sleeping` >= :nb_sleep AND `nbr_bathroom` >= :nb_bathroom ' : '';
    $sql .= (null != $cat2) ? 'AND (' : ((null != $cat1) ? 'AND' : ''); 
    $sql .= (null != $cat1) ? '`id_categ` = :cat1 ' : '';
    $sql .= (null != $cat2) ? 'OR `id_categ` = :cat2 ' : '';
    $sql .= (null != $cat3) ? 'OR `id_categ` = :cat3 ' : '';
    $sql .= (null != $cat4) ? 'OR `id_categ` = :cat4 ' : '';
    $sql .= (null != $cat2) ? ')' : '';
    $sql .= ' ORDER BY `id_gite` DESC';

    $reqGite = $db->prepare($sql);

    // var_dump($reqGite);

    (null != $nbSleep) ? $reqGite->bindParam('nb_sleep', $nbSleep, PDO::PARAM_STR) : '';
    (null != $nbBath) ? $reqGite->bindParam('nb_bathroom', $nbBath, PDO::PARAM_STR) : '';
    (null != $cat1) ? $reqGite->bindParam('cat1', $cat1, PDO::PARAM_STR) : '';
    (null != $cat2) ? $reqGite->bindParam('cat2', $cat2, PDO::PARAM_STR) : '';
    (null != $cat3) ? $reqGite->bindParam('cat3', $cat3, PDO::PARAM_STR) : '';
    (null != $cat4) ? $reqGite->bindParam('cat4', $cat4, PDO::PARAM_STR) : '';

    $reqGite->execute();

    echo json_encode($reqGite->fetchAll(PDO::FETCH_ASSOC));
}

