<?php
include "../../connexion/connect.php";
include "../_protect.php";
$title = "Accueil";
$link = "../../assets/style/userAccueil.css";
include "../includes/header.php";

$disallowedRoles = array("admin", "super_admin");

if (!isset($_SESSION["user"]) || in_array($_SESSION["user"]["role"], $disallowedRoles)) {
    header("Location: ../index.php");
    exit();
}

$userId = $_SESSION['user']['userId'];

// Récupération des informations de l'utilisateur et de la classe depuis la table "tblUser" et "tblClasses"
$userQuery = "SELECT tbluser.userName, tbluser.userSurname, tbluser.userImage, tblclass.className FROM tbluser INNER JOIN tblclass ON tbluser.classId = tblclass.classId WHERE tbluser.userId = :userId";

$userStmt = $conn->prepare($userQuery);
$userStmt->bindValue(':userId', $userId);
$userStmt->execute();

if ($userStmt && $userInfo = $userStmt->fetch(PDO::FETCH_ASSOC)) {
    $nom = $userInfo['userName'];
    $prenom = $userInfo['userSurname'];
    $className = $userInfo['className'];
    $userImage = $userInfo['userImage'];
} else {
    echo "Erreur lors de la récupération des informations de l'utilisateur.";
    exit(); // Arrête l'exécution du script en cas d'erreur
}

?>

<div id="container-main">
    <div id="container-1">
        <img src="<?php echo $userImage; ?>" alt="Image de l'utilisateur">
        <div>
            <li><?php echo htmlspecialchars($nom); ?></li>
            <li><?php echo htmlspecialchars($prenom); ?></li>
            <li><?php echo htmlspecialchars($className); ?></li>
        </div>
    </div>


    <div id="container-2">
    <div>
        <table class="tableau">
            <h2>Mes absences</h2>
            <?php
$userId = $_SESSION['user']['userId'];

// Récupération des absences de l'utilisateur depuis la table "tblabsent"
$query = "SELECT * FROM tblabsent WHERE userId = '$userId'";
$result = $conn->query($query);
$absenceCount = $result ? $result->rowCount() : 0;
?>
            <h3>Nombre d'absences actuel : <?php echo $absenceCount; ?></h3>
            <a href="submitAbsence.php" class="submit-absence-btn">Soumettre une absence</a>
            <tr>
                <th>Date</th>
                <th>Motif</th>
                <th>Justification</th>
            </tr>
            <?php
$userId = $_SESSION['user']['userId'];

// Récupération des absences de l'utilisateur depuis la table "tblabsent"
$query = "SELECT * FROM tblabsent WHERE userId = '$userId'";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["motif"] . "</td>";
        echo "<td>" . ($row["justification"] ? "Oui" : "Non") . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Aucune absence trouvée</td></tr>";
}

?>
        </table>
    </div>
</div>
  </body>

  <script>
    const menuHamburger = document.querySelector(".menu-hamburger");
    const navLinks = document.querySelector(".nav-links");

    menuHamburger.addEventListener("click", () => {
      navLinks.classList.toggle("mobile-menu");
    });
  </script>
</html>
