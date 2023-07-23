<?php
include "../_protect.php";
$title = "Gestion des élèves";
$link = "../../assets/style/adminAccueil.css";
include "../includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

$role = $_SESSION["user"]["role"];
$searchTerm = $_GET['searchTerm'] ?? '';

if ($role === "super_admin") {
    $students = getAdminStudents($conn, $searchTerm);
} elseif ($role === "admin") {
    $students = getUserStudents($conn, $searchTerm);
} else {
    $students = array();
}
?>

<div id="container-eleves">
    <div>
        <li><button><a href="./ajoutUtilisateur.php"> <i class="fa-solid fa-user-plus"></i></a></button></li>
    </div>
    <div>
        <form action="./index.php" method="get">
            <input type="text" name="searchTerm" placeholder="Rechercher un élève">
            <button type="submit">Rechercher</button>
        </form>
    </div>
</div>

<div id="container-main">
    <div id="main-tab">
        <table class="tableau">
            <tr>
                <th>Photo</th>
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
        echo '<td><a href="./adminUserProfile.php?studentId=' . $row["userId"] . '"><img src="' . $row["userImage"] . '" alt="Profile Pic" width="50" height="50"></a></td>';
        echo "<td>" . $row["userSurname"] . "</td>";
        echo "<td>" . $row["userName"] . "</td>";
        echo "<td>" . $row["className"] . "</td>";
        echo "<td>";
        echo '<a href="./modificationUtilisateur.php?studentId=' . $row["userId"] . '" class="button">Modifier</a>';
        echo "</td>";
        echo "</tr>";
        $index++;
    }
} else {
    echo "<tr><td colspan='5'>Aucun élève trouvé</td></tr>";
}
?>
        </table>
    </div>
</div>

<script src="../../assets/javascript/script.js"></script>
</body>
</html>
