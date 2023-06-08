<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

$students = getStudents($conn);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://kit.fontawesome.com/587ab224da.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Ad'mns</title>
    <link rel="stylesheet" href="../../assets/style/adminAccueil.css" />
    <link rel="stylesheet" href="../../assets/style/popUpButton.css" />
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="#" class="logo"><img src="../../assets/img/pngwing.com.png" alt="" /></a>
            <div class="nav-links">
                <ul>
                    <li><a href="./index.php">Acceuil</a></li>
                    <li><a href="./adminClasse.php">Classes</a></li>
                    <li><a href="./adminLate.php">Absence/Retard</a></li>
                    <li><a href="./adminDoc.php">Document</a></li>
                </ul>
            </div>
            <img src="../../assets/img/menuBurger.png" alt="" class="menu-hamburger" />
        </nav>
    </header>

    <div id="container-eleves">
        <ul>
            <li>Nom de l'élève :</li>
            <li>Prénom de l'élève :</li>
            <li>Classe de l'élève :</li>
        </ul>
        <button id="addEleve">
            <a href="./adminAjoutEleve">Ajouter un élève</a>
        </button>
    </div>
    <div id="container-main">
        <table border="1">
            <tr>
                <th>nom</th>
                <th>prénom</th>
                <th>classe</th>
                <th>absence/retard</th>
            </tr>
            <?php
$index = 0;
if (!empty($students)) {
    foreach ($students as $row) {
        echo "<tr>";
        echo "<td>" . $row["userName"] . "</td>";
        echo "<td>" . $row["userSurname"] . "</td>";
        echo "<td>" . $row["className"] . "</td>";
        echo "<td>";
        echo "<button class='absence-button'>Absent</button>";
        echo "<button class='absence-button'>Présent</button>";
        echo "<button class='absence-button autre-button' data-index='$index'>Autre</button>";
        echo "</td>";
        echo "</tr>";
        $index++;
    }
} else {
    echo "<tr><td>aucun élève trouvé</td></tr>";
}
?>
        </table>
    </div>

    <div id="popup" class="popup">
        <h3>Que voulez-vous faire ?</h3>
        <button id="modifyButton">Modifier</button>
        <button id="deleteButton">Supprimer</button>
        <button id="closeButton"></button>
    </div>

    <script src="../../assets/javascript/popUpButton.js"></script>
    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
