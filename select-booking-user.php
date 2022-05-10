<?php
require_once './connect.php';


$start_date_reserv = $_GET['start'];
$end_date_reserv = $_GET['end'];

$start_date = date_create($start_date_reserv);
$end_date = date_create($end_date_reserv);
$diff = date_diff($start_date, $end_date);
$nights = $diff->format('%a') - 1;

function parseDate($date) {
    $parse = date_parse($date);
    $day = $parse['day'];
    $month = $parse['month'];
    $year = $parse['year'];

    $mktime = mktime(0, 0, 0, $month, $day, $year);

    return $mktime;
}

$first_date = parseDate($start_date_reserv);
$last_date = parseDate($end_date_reserv);

for ($i = $first_date; $i <= $last_date; $i += 86400) {
    $stay[] = date("Y-m-d", $i);
}

$idGiteResa = [75, 72];
$reqResa = $db->prepare('SELECT `id_detail_booking`, `id_gite`, `id_client`, `id_reserv`, `day_booked` FROM `detail_booking` WHERE `id_gite` = :id_gite ORDER BY id_detail_booking');

foreach ($idGiteResa as $id) {
    $reqResa->bindParam('id_gite', $id, PDO::PARAM_STR);
    $reqResa->execute();

    $valueResa[] = $reqResa->fetchAll(PDO::FETCH_ASSOC);
}

$json = '';

if ($stay != null) {
    foreach ($valueResa as $giteResa) {
        foreach ($giteResa as $dayBooked) {
            foreach ($stay as $dayWished) {
                if ($dayBooked['day_booked'] == $dayWished) {
                    $json .= ',{"id_gite":"' . $dayBooked['id_gite'] . '"}';
                    break 2;
                } else {
                }
            }
        }
    }
}

$jsonEncode = substr($json, 1);

$jsonFinal = '[' . $jsonEncode . ']';

echo $jsonFinal;
