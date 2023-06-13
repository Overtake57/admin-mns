<?php

session_start();
// Détruisez la session
session_destroy();

// Redirigez vers la page de connexion ou une autre page de votre choix
header("Location: ../../index.php");
exit();
