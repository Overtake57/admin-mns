<?php

session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] != "ok") {

    header("Location:" . $_SERVER['DOCUMENT_ROOT'] . "/login.php");
}
