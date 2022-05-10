<?php

require_once './templates/header.php';

require './connect.php';

?>
<main>
    <figure class="background-main-user">
        <img src="./templates/img/slider/background.jpg" alt="background">
    </figure>
    <h1 class="titre-h1">Bienvenue</h1>
    <!-- FORMULAIRE UTILISATEUR : TROUVER VOTRE GITE  -->
    <section class="form-page-client">
        <h2 class="titre-form-client">TROUVEZ VOTRE GÎTE</h2>

        <form action="#" method="GET">
            <div class="location">
                <label class="label-client" for="destination" id="search-bar">DESTINATION</label>
                <input type="search" placeholder="Choisissez votre destination" class="input-local" name="destination">

            </div>
        </form>
        <p class="titre-form-client">OU</p>
        <form action="#" method="GET">

            <div class="location">
                <label for="start_date_reserv" class="label-client">ARRIVÉE</label>
                <input type="date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="date-placeholder" name="start_date_reserv" id="start_date_reserv">

                <label for="end_date_reserv" class="label-client"> DEPART</label>
                <input type="date" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" max="<?= date('Y-m-d', strtotime('+3 months')) ?>" value="" class="date-placeholder" name="end_date_reserv" id="end_date_reserv">
            </div>


            <div class="first-flex">
                <div class="form-lieu-flex">
                    <label class="label-client" for="nbr_sleeping"> Nombre de couchages </label>
                    <select name="nbr_sleeping" id="nbr_sleeping" class="nb-personnes">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                    </select>
                </div>
                <div class="form-lieu-flex">
                    <label class="label-client" for="nbr_bathroom"> Nombre de salle de bain </label>
                    <select name="nbr_bathroom" id="nbr_bathroom" class="nb-personnes">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>

            </div>
            <br>
            <label for="type" class="label-client">Type de logement</label> <br>
            <div class="first-flex flex-2">
                <div class="form-lieu-flex">
                    <input type="checkbox" name="gite-type[]" value="1" class="input-option">
                    <label class="label-client"> Chambre </label>
                </div>
                <div class="form-lieu-flex">
                    <input type="checkbox" name="gite-type[]" value="2" class="input-option">
                    <label class="label-client"> Appartement </label>
                </div>
                <div class="form-lieu-flex">
                    <input type="checkbox" name="gite-type[]" value="3" class="input-option">
                    <label class="label-client"> Maison </label>
                </div>
                <div class="form-lieu-flex">
                    <input type="checkbox" name="gite-type[]" value="4" class="input-option">
                    <label class="label-client"> Villa </label>
                </div>
            </div>
            <br>
            <label for="name_suppl" class="label-client"> Option(s) </label> <br>
            <div class="first-flex flex-2">
                <div class="form-lieu-flex">
                    <input type="checkbox" name="option[]" value="1" class="input-option">
                    <label class="label-client"> Piscine </label>
                </div>
                <div class="form-lieu-flex">
                    <input type="checkbox" name="option[]" value="2" class="input-option">
                    <label class="label-client"> Jardin </label>
                </div>
                <div class="form-lieu-flex">
                    <input type="checkbox" name="option[]" value="3" class="input-option">
                    <label class="label-client"> Parking </label>
                </div>
                <div class="form-lieu-flex">
                    <input type="checkbox" name="option[]" value="4" class="input-option">
                    <label class="label-client"> Animaux acceptée </label>
                </div>
            </div>
            <br>

            <button type="submit" name="submit" class="btn-util">Rechercher </button>
        </form>
    </section>
    <!-- Affichage résultat recherche gite -->

    <h2 class="titre-past-form">NOUS AVONS TROUVÉ LES GÎTES SUIVANTS POUR VOUS</h2>
    <ul id="list-gites-user" class="main-user-gite"></ul>


    <?php

    if (isset($_GET['submit'])) {

        $nbSleep = $_GET['nbr_sleeping'];
        $nbBath = $_GET['nbr_bathroom'];
        $start = $_GET['start_date_reserv'];
        $end = $_GET['end_date_reserv'];

        if (!empty($_GET['gite-type'])) {

            foreach ($_GET['gite-type'] as $value) {
                $type[] = $value;
            }
        }

        if (!empty($_GET['option'])) {
            foreach ($_GET['option'] as $value) {
                $option[] = $value;
            }
        }
    } else {

        $nbSleep = null;
        $nbBath = null;
        $start = null;
        $end = null;
    }

    if (isset($_GET['destination'])) {
        $searchByCity = $_GET['destination'];
        preg_match('~^.{3,32}([A-Za-z]){4}$~', $searchByCity);
    } else {
        $searchByCity = null;
    }


    ?>

    <form action="#" method="GET">

        <input type="hidden" id="nb_sleep" value="<?= $nbSleep ?>">
        <input type="hidden" id="nb_bathroom" value="<?= $nbBath ?>">
        <input type="hidden" id="start-date" value="<?= $start ?>">
        <input type="hidden" id="end-date" value="<?= $end ?>">

        <input type="hidden" id="cat1" value="<?= (isset($type[0])) ? $type[0] : null ?>">
        <input type="hidden" id="cat2" value="<?= (isset($type[1])) ? $type[1] : null ?>">
        <input type="hidden" id="cat3" value="<?= (isset($type[2])) ? $type[2] : null ?>">
        <input type="hidden" id="cat4" value="<?= (isset($type[3])) ? $type[3] : null ?>">

        <input type="hidden" id="option1" value="<?= (isset($option[0])) ? $option[0] : null ?>">
        <input type="hidden" id="option2" value="<?= (isset($option[1])) ? $option[1] : null ?>">
        <input type="hidden" id="option3" value="<?= (isset($option[2])) ? $option[2] : null ?>">
        <input type="hidden" id="option4" value="<?= (isset($option[3])) ? $option[3] : null ?>">

        <input type="hidden" id="search" value="<?=$searchByCity?>">
    </form>

</main>

<?php
// if (isset($_GET['submit'])) {
//     $start_date_reserv = $_GET['start_date_reserv'];
//     $end_date_reserv = $_GET['end_date_reserv'];

//     $start_date = date_create($start_date_reserv);
//     $end_date = date_create($end_date_reserv);
//     $diff = date_diff($start_date, $end_date);
//     $nights = $diff->format('%a') - 1;

//     function parseDate($date)
//     {
//         $parse = date_parse($date);
//         $day = $parse['day'];
//         $month = $parse['month'];
//         $year = $parse['year'];

//         $mktime = mktime(0, 0, 0, $month, $day, $year);

//         return $mktime;
//     }

//     $first_date = parseDate($start_date_reserv);
//     $last_date = parseDate($end_date_reserv);

//     for ($i = $first_date; $i <= $last_date; $i += 86400) {
//         $stay[] = date("Y-m-d", $i);
//     }
// } else {
//     $stay = null;
// }

// $id_gite_selec = $_GET['id_gite_selec'];
// var_dump($id_gite_selec);


// $idGiteResa = 75;
// $reqResa = $db->prepare('SELECT `id_detail_booking`, `id_gite`, `id_client`, `id_reserv`, `day_booked` FROM `detail_booking` WHERE `id_gite` = :id_gite ORDER BY id_detail_booking');

// $reqResa->bindParam('id_gite', $idGiteResa, PDO::PARAM_STR);
// $reqResa->execute();
// $valueResa = $reqResa->fetchAll(PDO::FETCH_ASSOC);
// var_dump($valueResa);



// if ($stay != null) {
//     foreach ($valueResa as $dayBooked) {
//         foreach ($stay as $dayWished) {
//             if($dayBooked['day_booked'] == $dayWished){
//                 break 2;
//             } else {

//             }
//         }
//     }
// }

require_once './templates/footer.php';
?>