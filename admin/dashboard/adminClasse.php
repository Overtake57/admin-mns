<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";
require_once "../includes/suppClasse.php";

$classes = getClasses($conn);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://kit.fontawesome.com/587ab224da.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Classes</title>
    <link rel="stylesheet" href="../../assets/style/adminClasses.css" />
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
        <button id="addClasse"><a href="./addClass.php">Ajouter une classe</a></button>
    </div>

    <div id="container-main">
        <table>
            <tr>
                <th>Classe</th>
                <th>Description</th>
                <th>Nombre d'élèves</th>
                <th>Action</th>
            </tr>
            <?php
if (count($classes) > 0) {
    $index = 0;
    foreach ($classes as $class) {
        echo "<tr>";
        echo "<td>" . $class["className"] . "</td>";
        echo "<td>" . $class["classDesc"] . "</td>";

        $classId = $class["classId"];
        $countQuery = $conn->prepare("SELECT COUNT(*) AS count FROM tbluser WHERE classId = :classId");
        $countQuery->bindValue(':classId', $classId, PDO::PARAM_INT);
        $countQuery->execute();
        $countResult = $countQuery->fetch(PDO::FETCH_ASSOC);
        $studentCount = $countResult["count"];

        echo "<td>" . $studentCount . "</td>";
        echo "<td>";
        echo "<button class='absence-button autre-button' data-index='$index' data-class-id='" . $class["classId"] . "'>Autre</button>";
        echo "</td>";
        echo "</tr>";
        $index++;
    }
} else {
    echo "<tr><td>Aucune classe trouvée</td></tr>";
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
    <script src="../../assets/javascript/script.js"></script>
    <script src="../../assets/javascript/popUpButton.js"></script>
</body>

</html>

<?php
$conn = null;
?>
