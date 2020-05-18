<?php

// all session variables
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$wilaya_id = $_SESSION['wilaya_id'];
$wilaya = getWilaya($_SESSION['wilaya_id']);
$carte = $_SESSION['carte'];