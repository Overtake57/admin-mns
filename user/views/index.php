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

    <div id="container-eleves">
      <ul>
        <li>Nom de l'élève :</li>
        <li>Prénom de l'élève :</li>
        <li>Classe de l'élève :</li>
      </ul>
    </div>
    <div id="container-main">
      <div class="inContainer">
        <table>
          <h2>Mes absences</h2>
          <h3>Nombre d'absence actuel :</h3>

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
      <div class="inContainer">
        <h2>Mes retards</h2>
        <h3>Nombre de retard actuel :</h3>

        <table>
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
    <div id="button">
      <div><button>Envoyer une absences</button></div>
      <div><button>Envoyer un retard</button></div>
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
