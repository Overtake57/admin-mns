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
    <link rel="stylesheet" href="../assets/style/userAccueil.css" />
    <link rel="stylesheet" href="../assets/style/main.css" />

  </head>

  <body>
    <nav class="navbar">
      <a href="#" class="logo"
        ><img
          src="../assets/img/pngwing.com.png"
          alt="logo deconnexion"
          id="logout"
      /></a>
      <div class="nav-links">
        <ul>
          <li><a href="./userAccueil.php">Absence/Retard</a></li>
          <li><a href="./userDocument.php">document</a></li>
        </ul>
      </div>
      <img
        src="../assets/img/menuBurger.png"
        alt="Logo menuBurger"
        class="menu-hamburger"
      />
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
