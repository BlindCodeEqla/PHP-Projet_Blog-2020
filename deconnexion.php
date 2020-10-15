<?php
session_start(); // on poursuit la session sur la page
$_SESSION= array(); // on vide toutes les variables de session: tableau complètement vide
session_destroy(); // on détruit la session
header("Location: index.php"); // on redirige l'utilisateur
