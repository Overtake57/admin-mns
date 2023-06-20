<?php
include "../_protect.php";
$title = "Absences et retards";
$link = "../../assets/style/adminAbsenceRetard.css";
include "../includes/header.php";
?>
    <div id="container-main">
      <div class="inContainer">
        <h2>Retards : <button>Oui</button><button>Non</button></h2>
        <h3>Nombre de retard actuel :</h3>
        <table>
          <tr>
            <th>Date</th>
            <th>Motif</th>
            <th>justifié</th>
          </tr>
          <tr>
            <td>22/22/2022</td>
            <td>dentiste</td>
            <td>Oui</td>
          </tr>
          <tr>
            <td>22/22/2022</td>
            <td>dentiste</td>
            <td>Oui</td>
          </tr>
          <tr>
            <td>22/22/2022</td>
            <td>dentiste</td>
            <td>Oui</td>
          </tr>
        </table>
      </div>
      <div class="inContainer">
        <h2>Absences : <button>Oui</button><button>Non</button></h2>
        <h3>Nombre d'absence actuel :</h3>
        <table>
          <tr>
            <th>Date</th>
            <th>Motif</th>
            <th>justifié</th>
          </tr>
          <tr>
            <td>22/22/2022</td>
            <td>dentiste</td>
            <td>Oui</td>
          </tr>
          <tr>
            <td>22/22/2022</td>
            <td>dentiste</td>
            <td>Oui</td>
          </tr>
          <tr>
            <td>22/22/2022</td>
            <td>dentiste</td>
            <td>Oui</td>
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
