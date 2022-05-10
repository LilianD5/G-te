<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
}
require_once '../templates/header-admin.php';

require_once '../connect.php';


$id_gite = $_GET['id'];

$req = $db->prepare("SELECT `id_gite`, `id_categ`, `name_gite`, `name_simple_gite`, `location_gite`, `profil_gite`, `desc_gite`, `nbr_sleeping`, `nbr_bathroom`, `price_night` FROM `cottages` WHERE `id_gite` = :id_gite");

$req->bindParam('id_gite', $id_gite, PDO::PARAM_STR);

$req->execute();

$value = $req->fetch(PDO::FETCH_ASSOC);

$reqOptions = $db->prepare("SELECT `id_suppl` FROM `gite_option` WHERE `id_gite` = :id_gite");

$reqOptions->bindParam('id_gite', $id_gite, PDO::PARAM_STR);

$reqOptions->execute();

$valueOptions = $reqOptions->fetchAll(PDO::FETCH_ASSOC);

?>
<h1 class="nb-gite-modal">MODIFIER VOTRE GÎTE</h1>
<form action="#" method="POST" enctype="multipart/form-data" class="form-ajout-new-gite">


    <label for="name_gite" class="label-ajout">Nom du gîte :</label>
    <input class="input-ajout" type="text" name="name_gite" id="name_gite" value="<?= $value['name_gite'] ?>">

    <br><br>

    <label for="location_gite" class="label-ajout">Adresse du gîte :</label>
    <input class="input-ajout" type="text" name="location_gite" id="location_gite" value="<?= $value['location_gite'] ?>">

    <br><br>

    <label class="label-ajout" for="profil_gite">Modifier l'mage de profil du gîte :</label>
    <input class="label-ajout" type="file" name="profil_gite" accept="image/png, image/jpeg, image/jpg">

    <br><br>

    <label class="label-ajout" for="image_gite">Modifier les images du gîte</label>
    <input class="label-ajout" type="file" name="myimg[]" multiple accept="image/png, image/jpeg, image/jpg">
    <input type="submit" name="submit-image" value="Soumettre">

    <div id="img-container">
        <ul id="list-images"></ul>
    </div>

    <div class="confirm">
        <p class="font-modal verif">Voulez-vous vraiment supprimer cette image ?</p>
        <div class="flex-around">
            <button id="oui">OUI !</button>
            <button id="non">NON !</button>
        </div>
    </div>

    <br><br>

    <label for="price_night" class="label-ajout">Prix par nuit en €</label>
    <input type="number" name="price_night" value="<?= $value['price_night']?>">

    <br><br>

    <label for="nbr_sleeping" class="label-ajout">
        Nombre de couchage :
    </label>
    <input type="number" name="nbr_sleeping" id="nbr_sleeping" min="1" value="<?= $value['nbr_sleeping'] ?>">

    <br><br>

    <label for="nbr_bathroom" class="label-ajout">
        Nombre de salle de bain :
    </label>
    <input type="number" name="nbr_bathroom" id="nbr_bathroom" min="1" value="<?= $value['nbr_bathroom'] ?>">

    <br><br>

    <label for="type" class="label-ajout">Catégorie</label>
    <br>
    <div class="first-flex flex-2">

<?php
if(!empty($value) && $value['id_categ'] == 1){ 
?>
<div class="ajout-lab-in"> <input type="radio" name="gite-type" value="1" class="input-option" checked><label class="label-no  label-ajout"> Chambre </label></div>
<?php
} else {
?>
<div class="ajout-lab-in"> <input type="radio" name="gite-type" value="1" class="input-option"><label class="label-no label-ajout"> Chambre </label></div>
<?php
}
?>

<?php
if(!empty($value) && $value['id_categ'] == 2){
?>
<div class="ajout-lab-in"> <input type="radio" name="gite-type" value="2" class="input-option" checked><label class="label-no label-ajout">Appartement</label></div>
<?php
} else {
?>
<div class="ajout-lab-in"> <input type="radio" name="gite-type" value="2" class="input-option"><label class="label-no label-ajout">Appartement</label></div>
<?php
}
?>

<?php
if(!empty($value) && $value['id_categ'] == 3){
?>
<div class="ajout-lab-in"><input type="radio" name="gite-type" value="3" class="input-option" checked><label class="label-no label-ajout">Maison</label></div>
<?php
} else {
?>
<div class="ajout-lab-in"><input type="radio" name="gite-type" value="3" class="input-option"><label class="label-no label-ajout">Maison</label></div>
<?php
}
?>

<?php
if(!empty($value) && $value['id_categ'] == 4){
?>
<div class="ajout-lab-in"><input type="radio" name="gite-type" value="4" class="input-option" checked><label class="label-no label-ajout">Villa</label></div>
<?php
} else {
?>
<div class="ajout-lab-in"><input type="radio" name="gite-type" value="4" class="input-option"><label class="label-no label-ajout">Villa</label></div>
<?php
}
?>
    </div>
    <br>
    <label for="option" class="label-ajout">Option(s)</label> 
    <br>
    <div class="first-flex flex-2">

<?php

        if(!empty($valueOptions) && $valueOptions[0]['id_suppl'] == 1){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="1" class="input-option" checked><label class="label-no label-ajout"> Piscine </label></div>
<?php
        } else if(!empty($valueOptions[1]) && $valueOptions[1]['id_suppl'] == 1){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="1" class="input-option" checked><label class="label-no label-ajout"> Piscine </label></div>
<?php
        } else if(!empty($valueOptions[2]) && $valueOptions[2]['id_suppl'] == 1){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="1" class="input-option" checked><label class="label-no label-ajout"> Piscine </label></div>
<?php  
        } else if(!empty($valueOptions[3]) && $valueOptions[3]['id_suppl'] == 1){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="1" class="input-option" checked><label class="label-no label-ajout"> Piscine </label></div>
<?php
        } else {
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="1" class="input-option"><label class="label-no label-ajout"> Piscine </label></div>
<?php
        }
?>

<?php

        if(!empty($valueOptions) && $valueOptions[0]['id_suppl'] == 2){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="2" class="input-option" checked><label class="label-no label-ajout"> Jardin </label></div>
<?php
        } else if(!empty($valueOptions[1]) && $valueOptions[1]['id_suppl'] == 2){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="2" class="input-option" checked><label class="label-no label-ajout"> Jardin </label></div>
<?php
        } else if(!empty($valueOptions[2]) && $valueOptions[2]['id_suppl'] == 2){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="2" class="input-option" checked><label class="label-no label-ajout"> Jardin </label></div>
<?php  
        } else if(!empty($valueOptions[3]) && $valueOptions[3]['id_suppl'] == 2){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="2" class="input-option" checked><label class="label-no label-ajout"> Jardin </label></div>
<?php
        } else {
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="2" class="input-option"><label class="label-no label-ajout"> Jardin </label></div>
<?php
        }
?>

<?php

        if(!empty($valueOptions) && $valueOptions[0]['id_suppl'] == 3){
?>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="3" class="input-option" checked><label class="label-no label-ajout"> Parking </label></div>
<?php
        } else if(!empty($valueOptions[1]) && $valueOptions[1]['id_suppl'] == 3){
?>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="3" class="input-option" checked><label class="label-no label-ajout"> Parking </label></div>
<?php
        } else if(!empty($valueOptions[2]) && $valueOptions[2]['id_suppl'] == 3){
?>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="3" class="input-option" checked><label class="label-no label-ajout"> Parking </label></div>
<?php  
        } else if(!empty($valueOptions[3]) && $valueOptions[3]['id_suppl'] == 3){
?>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="3" class="input-option" checked><label class="label-no label-ajout"> Parking </label></div>
<?php
        } else {
?>
       <div class="ajout-lab-in"> <input type="checkbox" name="option[]" value="3" class="input-option"><label class="label-no label-ajout"> Parking </label></div>
<?php
        }
?>

<?php

        if(!empty($valueOptions) && $valueOptions[0]['id_suppl'] == 4){
?>
<div class="ajout-lab-in"> <input type="checkbox" name="option[]" value="4" class="input-option" checked><label class="label-no label-ajout"> Animaux acceptés </label></div>
<?php
        } else if(!empty($valueOptions[1]) && $valueOptions[1]['id_suppl'] == 4){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="4" class="input-option" checked><label class="label-no label-ajout"> Animaux acceptés </label></div>
<?php
        } else if(!empty($valueOptions[2]) && $valueOptions[2]['id_suppl'] == 4){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="4" class="input-option" checked><label class="label-no label-ajout"> Animaux acceptés </label></div>
<?php  
        } else if(!empty($valueOptions[3]) && $valueOptions[3]['id_suppl'] == 4){
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="4" class="input-option" checked><label class="label-no label-ajout"> Animaux acceptés </label></div>
<?php
        } else {
?>
<div class="ajout-lab-in"><input type="checkbox" name="option[]" value="4" class="input-option"><label class="label-no label-ajout"> Animaux acceptés </label></div>
<?php
        }
?>
    </div>

    <br><br>

    <label class="label-ajout" for="desc_gite">
        Description du gîte :
    </label>
    <br><br>
    <textarea class="input-ajout descript-in" name="desc_gite" id="desc_gite" cols="30" rows="10"><?= $value['desc_gite'] ?></textarea>

    <br><br>

    <input type="hidden" name="id_gite" id="id_gite" value="<?= $value['id_gite'] ?>">
    <input type="submit" name="submit" value="Valider la modification">
</form>




<?php
// Photo Profil Gite
if (isset($_POST['submit'])) {
    $ref = null;
    $extensionUpload = null;
    var_dump($extensionUpload);

    //On transforme le nom du gîte en minuscule

    $minuscule = strtolower($_POST['name_gite']);

    //On supprime les espaces du nom du gîte

    $searchString = " ";

    $replaceString = "";

    $finalString = str_replace($searchString, $replaceString, $minuscule);

    //On vérifie que le fichier a été envoyé et qu'il n'y a pas d'erreur

    if (isset($_FILES['profil_gite']) and $_FILES['profil_gite']['error'] == 0) {

        //On vérifie le poids du fichier envoyé

        if (isset($_FILES['profil_gite']['size']) <= 1000000) {

            //On récupère les infos du fichier

            $infosFichier = pathinfo($_FILES['profil_gite']['name']);

            //On récupère l'extension du fichier

            $extensionUpload = $infosFichier['extension'];

            //On définit les extensions autorisées

            $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];

            //On test l'extension du fichier

            if (in_array($extensionUpload, $extensionsAutorisees)) {

                //On récupère date et heure 

                $date = date('dmyhis');

                //On créer le nouveau nom du fichier

                $ref = $finalString . '_' . $date . '_pdp';

                //On déplace le fichier dans le dossier de destination

                move_uploaded_file($_FILES['profil_gite']['tmp_name'], '../img/pdp/' . $ref . '.' . $extensionUpload);
            }
        }
    }

    //On stocke les données du formulaire dans une variable pour l'insertion dans la table

    $id_categ = $_POST['gite-type'];
    $name_gite = $_POST['name_gite'];
    $name_simple_gite = $finalString;
    $location_gite = $_POST['location_gite'];
    $profil_gite  = $ref . '.' . $extensionUpload;
    var_dump($extensionUpload);
    $desc_gite = $_POST['desc_gite'];
    $nbr_sleeping = $_POST['nbr_sleeping'];
    $nbr_bathroom = $_POST['nbr_bathroom'];
    $price_night = $_POST['price_night'];
    $option = $_POST['option'];

    ?>

    <form action="#" method="GET">
        <input type="hidden" id="option1" value="<?= (isset($option[0])) ? $option[0] : null ?>">
        <input type="hidden" id="option2" value="<?= (isset($option[1])) ? $option[1] : null ?>">
        <input type="hidden" id="option3" value="<?= (isset($option[2])) ? $option[2] : null ?>">
        <input type="hidden" id="option4" value="<?= (isset($option[3])) ? $option[3] : null ?>">
    </form>

<?php

    //Connexion à la BDD

    require_once 'update-gite.php';

}


if (isset($_POST['submit-image'])) {
    //Boucle traitement des images et insertion dans la table

    //On initialise la boucle, on compte le nombre d'image envoyée avec $i < count($_FILES['myimg']['name']

    for ($i = 0; $i < count($_FILES['myimg']['name']); $i++) {

        //On vérifie que le fichier a été envoyé et qu'il n'y a pas d'erreur

        if (isset($_FILES['myimg']['name'][$i]) && $_FILES['myimg']['error'][$i] == 0) {

            ////On vérifie le poids du fichier envoyé

            if (isset($_FILES['myimg']['size'][$i]) <= 1000000) {

                //On récupère les infos du fichier

                $infosFichier = pathinfo($_FILES['myimg']['name'][$i]);

                //On récupère l'extension du fichier

                $extensionUpload = $infosFichier['extension'];

                //On définit les extensions autorisées

                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];

                //On test l'extension du fichier

                if (in_array($extensionUpload, $extensionsAutorisees)) {

                    //On récupère date et heure

                    $date = date('dmyhis');

                    //On transforme le nom du gîte en minuscule

                    $minuscule = strtolower($_POST['name_gite']);

                    //On supprime les espaces du nom du gîte

                    $searchString = " ";

                    $replaceString = "";

                    $finalString = str_replace($searchString, $replaceString, $minuscule);

                    //On créer le nouveau nom du fichier

                    $ref = $finalString . "_" . $date . "_" . $i;

                    //On déplace le fichier dans le dossier de destination

                    move_uploaded_file($_FILES['myimg']['tmp_name'][$i], "../img/gite/" . $ref . "." . $extensionUpload);

                    //On stocke le nom de l'image dans une variable pour l'envoi dans la table

                    $name_image =  $ref . "." . $extensionUpload;
                    $idGite = $_GET['id'];

                    //Connexion à la BDD

                    require 'ajout-image.php';
                }
            }
        }
    }
}

?>

<script src="../admin/modif-admin.js"></script>
</body>

</html>