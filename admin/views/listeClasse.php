<?php
include "../_protect.php";
$title = "Affichage des classes";
$link = "../../assets/style/adminClasses.css";

require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../includes/header.php";
require_once "../php/function.php";

// Vérifier si la connexion à la base de données est établie avec succès
if (!$conn) {
    echo "Erreur de connexion à la base de données.";
    exit();
}

$classes = getClasses($conn);

// Vérifier si la fonction getClasses() a renvoyé un résultat valide
if ($classes === false) {
    echo "Erreur lors de la récupération des classes.";
    exit();
}
?>
    <div id="container-eleves">
      <ul>
        <div>
            <li>Nom de l'élève :</li>
            <li>Prénom de l'élève :</li>
            <li>Classe de l'élève :</li>
            <li><button><a href="./ajoutClasse.php"> <i class="fa-solid fa-user-plus"></i></a></button></li>
        </div>
    </ul>
    </div>

    <div id="container-main">
        <table class="tableau">
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
        echo '<a href="./modificationClasse.php?classId=' . $class["classId"] . '" class="button">Modifier</a>';
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


    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
