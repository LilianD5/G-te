<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
}

require_once '../templates/header-admin.php';


?>
<h1 class="nb-gite-modal">AJOUTER UN NOUVEAU GÎTE</h1>

<form action="#" method="POST" enctype='multipart/form-data' class="form-ajout-new-gite">

    <label class="label-ajout" for="name_gite">
        Nom du gîte :
    </label>
    <input class="input-ajout" type="text" name="name_gite" id="name_gite" required>

    <br><br>

    <label class="label-ajout" for="location_gite">
        Adresse du gîte :
    </label>
    <input class="input-ajout" type="text" name="location_gite" id="location_gite" required>

    <br><br>

    <label class="label-ajout" for="profil_gite">
        Ajouter une image de profil pour votre gîte:
    </label>
    <input class="label-ajout" type="file" name="profil_gite" multiple accept="image/png, image/jpeg, image/jpg" required>

    <br><br>

    <label class="label-ajout" for="image_gite">
        Ajouter des images pour votre gîte :
    </label>
    <input class="label-ajout" type="file" name="myimg[]" multiple accept="image/png, image/jpeg, image/jpg" required>

    <br><br>

    <label class="label-ajout" for="price_night">Prix par nuit en €</label>
    <input type="number" name="price_night">
    <br><br>

    <label class="label-ajout" for="nbr_sleeping">
        Nombre de couchage :
    </label>
    <select name="nbr_sleeping" id="nbr_sleeping" type="number" class="input-ajout input-nb-add" required>
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

    <br><br>

    <label class="label-ajout" for="nbr_bathroom">
        Nombre de salle de bain :
    </label>
    <select name="nbr_bathroom" id="nbr_bathroom" type="number" class="input-ajout input-nb-add" required>
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

    <br><br>

    <label for="gite-type" class="label-ajout">Categorie</label>
    <br>
    <div class="first-flex flex-2">
        <div class="ajout-lab-in"><input type="radio" name="gite-type" value="1" class="input-option"><label class="label-ajout"> Chambre </label></div>
        <div class="ajout-lab-in"><input type="radio" name="gite-type" value="2" class="input-option"><label class="label-ajout"> Appartement </label></div>
        <div class="ajout-lab-in"><input type="radio" name="gite-type" value="3" class="input-option"><label class="label-ajout"> Maison </label></div>
        <div class="ajout-lab-in"><input type="radio" name="gite-type" value="4" class="input-option"><label class="label-ajout"> Villa </label></div>
    </div>
    <br>
    <label for="option" class="label-ajout"> Option(s) </label> <br>
    <div class="first-flex flex-2">
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="1" class="input-option"><label class="label-ajout"> Piscine </label></div>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="2" class="input-option"><label class="label-ajout"> Jardin </label></div>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="3" class="input-option"><label class="label-ajout"> Parking </label></div>
        <div class="ajout-lab-in"><input type="checkbox" name="option[]" value="4" class="input-option"><label class="label-ajout"> Animaux acceptés </label></div>
    </div>

    <br><br>

    <label class="label-ajout" for="desc_gite">
        Description du gîte :
    </label> 

    <br><br>

    <textarea class="input-ajout descript-in" name="desc_gite" id="desc_gite" cols="30" rows="10" placeholder="Veuillez entrer une description du gîte" required></textarea>

    <br><br>

    <button class="btn-valid-ajout" type="submit" name="submit">Valider la création</button>



</form>
<?php

// Photo Profil Gite
if (isset($_POST['submit'])) {
    $finalString;
    $ref;

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

                //On transforme le nom du gîte en minuscule

                $minuscule = strtolower($_POST['name_gite']);

                //On supprime les espaces du nom du gîte

                $searchString = " ";

                $replaceString = "";

                $finalString = str_replace($searchString, $replaceString, $minuscule);

                //On récupère date et heure 

                $date = date('dmyhis');

                //On créer le nouveau nom du fichier

                $ref = $finalString . '_' . $date . '_pdp';

                //On déplace le fichier dans le dossier de destination

                move_uploaded_file($_FILES['profil_gite']['tmp_name'], '../img/pdp/' . $ref . '.' . $extensionUpload);
            }
        }
    }

    //On stocke les données du formualire dans une variable pour l'insertion dans la table

    $id_categ = $_POST['gite-type'];
    $name_gite = $_POST['name_gite'];
    $name_simple_gite = $finalString;
    $location_gite = $_POST['location_gite'];
    $profil_gite  = $ref . '.' . $extensionUpload;
    $desc_gite = $_POST['desc_gite'];
    $nbr_sleeping = $_POST['nbr_sleeping'];
    $nbr_bathroom = $_POST['nbr_bathroom'];
    $price_night = $_POST['price_night'];

    //Connexion à la BDD

    require_once 'create-gite.php';

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

                    //Connexion à la BDD

                    require 'ajout-image.php';
                    
                }
            }
        }
    }

    if(!empty($_POST['option'])){
        foreach($_POST['option'] as $value){

            $reqOpt = $db->prepare('INSERT INTO gite_option (`id_gite`, `id_suppl`) VALUES (:id_gite, :id_suppl)');

            $reqOpt->bindParam('id_gite', $idGite, PDO::PARAM_STR);
            $reqOpt->bindParam('id_suppl', $value, PDO::PARAM_STR);
            $reqOpt->execute();
        }
    }

    //Redirection vers la page gite de l'admin

    // header('Location: gite.php');
}

?>

<?php

require_once '../templates/footer-admin.php';

?>