<?php
include "../_protect.php";
$title = "Accueil";
$link = "../../assets/style/userAccueil.css";
include "../includes/header.php";

$disallowedRoles = array("admin", "super_admin");

if (!isset($_SESSION["user"]) || in_array($_SESSION["user"]["role"], $disallowedRoles)) {
    header("Location: ../index.php");
    exit();
}
?>


<div id="container-main">
    <div id="container-1">
        <img src="../../assets/img/golem.png" alt="">
            <div>
              <li>Nom</li>
              <li>prénom</li>
              <li>classe</li>
            </div>
    </div>

    <div id="container-2">
    <div>
        <table class="tableau">
            <h2>Mes absences</h2>
            <h3>Nombre d'absences actuel :</h3>
            <tr>
                <th>Date</th>
                <th>Motif</th>
                <th>Justification</th>
            </tr>
            <?php
$userId = $_SESSION['user']['userId'];

// Récupération des absences de l'utilisateur depuis la table "tblabsent"
$query = "SELECT * FROM tblabsent WHERE userId = '$userId'";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
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


      <div id="margin">
        <table class="tableau">
            <h2>Mes retards</h2>
            <h3>Nombre de retard actuel :</h3>
          <tr>
            <th>Date</th>
            <th>Motif</th>
            <th>justifier ?</th>
          </tr>
          <tr>
            <td>21/02/2023</td>
            <td>rendez vous dentistes</td>
            <td>oui</td>
          </tr>
          <tr>
            <td>21/02/2023</td>
            <td>rendez vous dentistes</td>
            <td>oui</td>
          </tr>
          <tr>
            <td>21/02/2023</td>
            <td>rendez vous dentistes</td>
            <td>oui</td>
          </tr>
          <tr>
            <td>21/02/2023</td>
            <td>rendez vous dentistes</td>
            <td>oui</td>
          </tr>
        </table>
      </div>
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
