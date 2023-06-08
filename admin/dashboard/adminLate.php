<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://kit.fontawesome.com/587ab224da.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Ad'mns</title>
    <link rel="stylesheet" href="../../assets/style/adminAbsenceRetard.css" />
</head>

<body>
    <nav class="navbar">
        <a href="#" class="logo"><img src="../../assets/img/pngwing.com.png" alt="" /></a>
        <div class="nav-links">
        <ul>
                    <li><a href="./index.php">Acceuil</a></li>
                    <li><a href="./adminClasse.php">Classes</a></li>
                    <li><a href="./adminLate.php">Absence/Retard</a></li>
                    <li><a href="./adminDoc.php">Document</a></li>
                </ul>
        </div>
        <img src="../../assets/img/menuBurger.png" alt="" class="menu-hamburger" />
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
        <div id="container-main2">
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
    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
