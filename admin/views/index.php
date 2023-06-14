<?php
include "../_protect.php";
$title = "Gestion des élèves";
$link = "../../assets/style/adminAccueil.css";
include "../includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

$role = $_SESSION["user"]["role"]; // Récupérez le rôle de l'utilisateur connecté (remplacez par votre propre logique)

if ($role === "super_admin") {
    $students = getAdminStudents($conn);
} elseif ($role === "admin") {
    $students = getUserStudents($conn);
} else {
    $students = array(); // Aucun utilisateur à afficher pour les autres rôles
}
?>

<div id="container-eleves">
    <ul>
        <div>
            <li>Nom de l'élève :</li>
            <li>Prénom de l'élève :</li>
            <li>Classe de l'élève :</li>
            <li><button><a href="./ajoutUtilisateur.php"> <i class="fa-solid fa-user-plus"></i></a></button></li>
        </div>
    </ul>
</div>

<div id="container-main">
    <div id="main-tab">
        <table class="tableau">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
                <th>Outils</th>
            </tr>
            <?php
$index = 0;
if (!empty($students)) {
    foreach ($students as $row) {
        echo "<tr>";
        echo "<td>" . $row["userSurname"] . "</td>";
        echo "<td>" . $row["userName"] . "</td>";
        echo "<td>" . $row["className"] . "</td>";
        echo "<td>";
        echo '<a href="#" class="button">Absent</a>';
        echo '<a href="./modificationUtilisateur.php?studentId=' . $row["userId"] . '" class="button">Modifier</a>';
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
</div>

<script src="../../assets/javascript/script.js"></script>

</body>
</html>
