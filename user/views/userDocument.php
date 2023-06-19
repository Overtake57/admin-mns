<?php
include "../_protect.php";
$title = "Mes documents";
$link = "../../assets/style/userDocument.css";
include "../includes/header.php";

$disallowedRoles = array("admin", "super_admin");

if (!isset($_SESSION["user"]) || in_array($_SESSION["user"]["role"], $disallowedRoles)) {
    header("Location: ../index.php");
    exit();
}
?>
    <div id="container-eleves">
    </div>
    <div id="container-main">
      <div id="container-main1">
        <h2>Documents fournis</h2>
        <table>
          <tr>
            <th>Type</th>
            <th>Date d'envoi</th>
          </tr>
          <tr>
            <td>Curriculum vitae</td>
            <td>22/02/2023</td>
          </tr>
          <tr>
            <td>Lettre de motivation</td>
            <td>25/02/2023</td>
          </tr>
        </table>
      </div>
      <div id="container-main2">
        <h2>Documents en attentes</h2>
        <table>
          <tr>
            <th>Type</th>
          </tr>
          <tr>
            <td>Rib</td>
            <td><a href="#">Envoyer</a></td>
          </tr>
          <tr>
            <td>Fiche de paie</td>
            <td><a href="#">Envoyer</a></td>
          </tr>
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
