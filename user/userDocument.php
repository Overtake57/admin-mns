<!DOCTYPE html>
<html lang="fr">
  <head>
    <script
      src="https://kit.fontawesome.com/587ab224da.js"
      crossorigin="anonymous"
    ></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Ad'mns</title>
    <link rel="stylesheet" href="../assets/style/userDocument.css" />
    <link rel="stylesheet" href="../assets/style/main.css" />

  </head>
  <body>
    <nav class="navbar">
      <a href="#" class="logo"
        ><img src="../assets/img/pngwing.com.png" alt=""
      /></a>
      <div class="nav-links">
        <ul>
          <li><a href="./userAccueil.php">Absence/Retard</a></li>
          <li><a href="./userDocument.php">document</a></li>
        </ul>
      </div>
      <img src="../assets/img/menuBurger.png" alt="" class="menu-hamburger" />
    </nav>
    <header></header>

    <div id="container-eleves">
      <ul>
        <li>Nom de l'élève :</li>
        <li>Prénom de l'élève :</li>
        <li>Classe de l'élève :</li>
      </ul>
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
