<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
}
require_once '../templates/header-admin.php';
require_once '../connect.php';

$reqResa = $db->query('SELECT `id_gite`, `id_client`, `date_reserv`, `end_date_reserv`, `nbr_nuit`, `nbr_people`, `price_reserv` FROM `bookings`');
$reqResa->execute();

$value = $reqResa->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- HTML -->
<main id="main-resa-admin">

<h1 class="titre-reservation-ad">Réservations</h1>

<h2 class="titre-reservation-ad">Séjour à venir</h2>
<!-- TABLEAUX DE RESERVATION ADMIN -->
<div id="resa-admin-list" class="row-limit-size-resa-user">
<table id="table-resa">
        <tr>
            <td id="td-xl" class="td">Gîte</td>
            <td id="td-l" class="td">Nom / Prénom</td>
            <td id="td-m" class="td">Voyageurs</td>
            <td id="td-s" class="td">Nuits</td>
            <td id="td-l" class="td">Date d'arrivée</td>
            <td id="td-l" class="td">Date de départ</td>
            <td id="td-l" class="td">E-mail</td>
            <td id="td-l" class="td">Téléphone</td>
            <td id="td-s" class="td">Prix</td>
        </tr>
<?php
    foreach($value as $resa){
        $idClient = $resa['id_client'];
        $idGite = $resa['id_gite'];

        $reqClient = $db->prepare('SELECT `id_client`, `firstname_client`, `lastname_client`, `phone_client`, `mail_client` FROM `customer` WHERE `id_client` = :id_client');
        $reqClient->bindParam('id_client', $idClient, PDO::PARAM_INT);
        $reqClient->execute();

        $client = $reqClient->fetch(PDO::FETCH_ASSOC);

        $reqGite = $db->prepare('SELECT `name_gite` FROM `cottages` WHERE `id_gite` = :id_gite');
        $reqGite->bindParam('id_gite', $idGite, PDO::PARAM_INT);
        $reqGite->execute();

        $gite = $reqGite->fetch(PDO::FETCH_ASSOC);
?>
        <tr>
            <td class="td"><?=$gite['name_gite']?></td>
            <td class="td"><?=$client['lastname_client'] . ' ' . $client['firstname_client']?></td>
            <td class="td"><?=$resa['nbr_people']?></td>
            <td class="td"><?=$resa['nbr_nuit']?></td>
            <td class="td"><?=$resa['date_reserv']?></td>
            <td class="td"><?=$resa['end_date_reserv']?></td>
            <td class="td"><?=$client['mail_client']?></td>
            <td class="td"><?=$client['phone_client']?></td>
            <td class="td"><?=$resa['price_reserv']?> €</td>
        </tr>
        <tr>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
            <td id="td" class="td"> </td>
        </tr>
        
<?php
    }
?>
</table>
<table id="table-resa-responsive">
<?php
    foreach($value as $resa){
        $idClient = $resa['id_client'];
        $idGite = $resa['id_gite'];

        $reqClient = $db->prepare('SELECT `id_client`, `firstname_client`, `lastname_client`, `phone_client`, `mail_client` FROM `customer` WHERE `id_client` = :id_client');
        $reqClient->bindParam('id_client', $idClient, PDO::PARAM_INT);
        $reqClient->execute();

        $client = $reqClient->fetch(PDO::FETCH_ASSOC);

        $reqGite = $db->prepare('SELECT `name_gite` FROM `cottages` WHERE `id_gite` = :id_gite');
        $reqGite->bindParam('id_gite', $idGite, PDO::PARAM_INT);
        $reqGite->execute();

        $gite = $reqGite->fetch(PDO::FETCH_ASSOC);
?>
        <tr>
            <td id="td-responsive">Gîte</td>
            <td id="td-responsive"><?=$gite['name_gite']?></td>
        </tr>
        <tr>
            <td id="td-responsive">Nom / Prenom </td>
            <td id="td-responsive"><?=$client['lastname_client'] . ' ' . $client['firstname_client']?></td>

        </tr>
        <tr>
            <td id="td-responsive">Nb de voyageurs </td>
            <td id="td-responsive"><?=$resa['nbr_people']?></td>
        </tr>
        <tr>
            <td id="td-responsive"> Nb de nuits </td>
            <td id="td-responsive"><?=$resa['nbr_nuit']?></td>
        </tr>
        <tr>
            <td id="td-responsive"> Date arrivée </td>
            <td id="td-responsive"><?=$resa['date_reserv']?></td>
        </tr>
        <tr>
            <td id="td-responsive">Date départ </td>
            <td id="td-responsive"><?=$resa['end_date_reserv']?></td>
        </tr>
        <tr>
            <td id="td-responsive"> E-mail </td>
            <td id="td-responsive"><?=$client['mail_client']?></td>
        </tr>
        <tr>
            <td id="td-responsive"> Téléphone </td>
            <td id="td-responsive"><?=$client['phone_client']?></td>
        </tr>
        <tr>
            <td id="td-responsive">Prix </td>
            <td id="td-responsive"><?=$resa['price_reserv']?> €</td>
        </tr>
        <tr>
            <td id="td-responsive"></td>
            <td id="td-responsive"></td>
        </tr>
<?php
    }
?>
    </table>
</div>

</main>




<?php
require_once '../templates/footer-admin.php';
?>