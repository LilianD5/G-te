<?php

    // Création de la connection à la base de données
    try{
        $db = new PDO('mysql:host=localhost;dbname=cottage;charset=utf8','root', '');
    } catch (PDOException $e){
        echo 'Echec de la connexion : ' . $e->getMessage();
    }