<?php

session_start();
if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
}

require_once '../templates/header-admin.php';

?>

<main>
    <h2 class="titre-page-gestion">VOS GÎTES</h2>

    <!-- FORMULAIRE DU PAGE GESTION GITES -->
    <form action="#" method="GET" class="form-add-search">
        <button type="submit" class="btn-ajout-gite"><a href="ajout.php">Ajouter un gîte</a></button>
        <div class="div-search-btn">
            <input type="text" name="nom" id="nom" placeholder="Recherche par nom" class="input-p-ajout" required>
            <button type="submit" class="btn-ajout-gite" name="submit-name">Rechercher</button>
        </div>    
    </form>

    <!-- FORMULAIRE RECHERCHE AVANCEE  -->
    <section class="form-connexion form-search">
        <h2 class="titre-form-search">RECHERCHE AVANCÉE</h2>
        <form action="#" method="GET" class="first-form">
            <div class="first-flex">
                <label class="label-no">Nombre de couchages</label>
                <select name="nb-sleep" id="nb-sleep" class="input-numer">
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
                <label class="label-no">Nombre de salle de bain</label>
                <select name="nb-bathroom" id="nb-bathroom" class="input-numer">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>

            </div>
            <br>

            <label for="type" class="label-no1">Type de logement</label> <br>
            <div class="first-flex flex-2">
                <div class="type-option"><input type="checkbox" name="gite-type[]" value="1" class="input-option"><label class="label-no"> Chambre </label></div>
                <div class="type-option"><input type="checkbox" name="gite-type[]" value="2" class="input-option"><label class="label-no"> Appartement </label></div>
                <div class="type-option"><input type="checkbox" name="gite-type[]" value="3" class="input-option"><label class="label-no"> Maison </label></div>
                <div class="type-option"><input type="checkbox" name="gite-type[]" value="4" class="input-option"><label class="label-no"> Villa </label></div>
            </div>
            <br>
            <label for="option" class="label-no1">Option(s)</label><br>
            <div class="first-flex flex-2">
                <div class="type-option"><input type="checkbox" name="option[]" value="1" class="input-option"><label class="label-no"> Piscine </label></div>
                <div class="type-option"><input type="checkbox" name="option[]" value="2" class="input-option"><label class="label-no"> Jardin </label></div>
                <div class="type-option"><input type="checkbox" name="option[]" value="3" class="input-option"><label class="label-no"> Parking </label></div>
                <div class="type-option"><input type="checkbox" name="option[]" value="4" class="input-option"><label class="label-no"> Animaux acceptés </label></div>
            </div>
            <br>

            <input class="btn-connect search-btn" type="submit" name="submit" value="Rechercher">
        </form>

    </section>

    <!-- Modal de confirmation d'effacement des gîtes -->

    <div class="confirm">
        <p class="font-modal verif">Voulez-vous vraiment supprimer ce gîte ?</p>
        <div class="flex-around">
            <button id="yes">OUI !</button>
            <button id="no">NON !</button>
        </div>
    </div>

    <!-- Liste des gites -->

    <h1 class="list-gite-modal">Liste de vos gites</h1>

    <p class="list-gite-modal">Vous avez actuellement <kbd id="nb-posts">X</kbd> gîtes en base correspondant à vos critères</p>

    <div class="list-style-ul">
        
        <ul id="list-gites">

        </ul>
    </div>

    <?php


    if (isset($_GET['submit'])) {

        $nbSleep = $_GET['nb-sleep'];
        $nbBath = $_GET['nb-bathroom'];

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
    }

    if (isset($_GET['nom'])) {
        $searchByName = $_GET['nom'];
    } else {
        $searchByName = null;
    }


    ?>

    <form action="#" method="GET">

        <input type="hidden" id="nb_sleep" value="<?= $nbSleep ?>">
        <input type="hidden" id="nb_bathroom" value="<?= $nbBath ?>">

        <input type="hidden" id="cat1" value="<?= (isset($type[0])) ? $type[0] : null ?>">
        <input type="hidden" id="cat2" value="<?= (isset($type[1])) ? $type[1] : null ?>">
        <input type="hidden" id="cat3" value="<?= (isset($type[2])) ? $type[2] : null ?>">
        <input type="hidden" id="cat4" value="<?= (isset($type[3])) ? $type[3] : null ?>">

        <input type="hidden" id="option1" value="<?= (isset($option[0])) ? $option[0] : null ?>">
        <input type="hidden" id="option2" value="<?= (isset($option[1])) ? $option[1] : null ?>">
        <input type="hidden" id="option3" value="<?= (isset($option[2])) ? $option[2] : null ?>">
        <input type="hidden" id="option4" value="<?= (isset($option[3])) ? $option[3] : null ?>">

        <input type="hidden" id="search" value="<?= $searchByName ?>">

    </form>

</main>



<script src="../admin/gite-admin.js"></script>
</body>

</html>