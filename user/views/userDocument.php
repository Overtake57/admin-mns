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
    <div id="container-main">
    <div id="container-1">
        <img src="../../assets/img/jimmy.jpg" alt="">
            <div>
              <li>Nom</li>
              <li>prénom</li>
              <li>classe</li>
            </div>  
    </div>

    <div id="container-2">
      <div>
        <table class="tableau">
            <h2>Mes documents :</h2>
          <tr>
            <th>Date</th>
            <th>style</th>
            <th>dazda</th>
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

      <div id="margin">
        <table class="tableau">
            <h2>documents à fournir :</h2>
          <tr>
            <th>date ?</th>
            <th>document</th>
            <th>type</th>
          </tr>
          <tr>
            <td>21/02/2023</td>
            <td>Curriculum vitae </td>
            <td>pdf</td>
          </tr>
          <tr>
            <td>21/02/2023</td>
            <td>Curriculum vitae </td>
            <td>pdf</td>
          </tr><tr>
            <td>21/02/2023</td>
            <td>Curriculum vitae </td>
            <td>pdf</td>
          </tr><tr>
            <td>21/02/2023</td>
            <td>Curriculum vitae </td>
            <td>pdf</td>
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