<?php
session_start();

$allowedRoles = array("admin", "super_admin");

if (!isset($_SESSION["user"]) || !in_array($_SESSION["user"]["role"], $allowedRoles)) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage du mot de passe</title>
</head>

<body>
    <h1>Mot de passe généré :</h1>
    <p>Mot de passe : <?php echo $_SESSION['display_password']; ?></p>
    <p>Adresse e-mail : <?php echo $_SESSION['display_user_mail']; ?></p>
</body>

</html>
