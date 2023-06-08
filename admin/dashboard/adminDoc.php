<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://kit.fontawesome.com/587ab224da.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Ad'mns</title>
    <link rel="stylesheet" href="../../assets/style/adminDocument.css" />
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
            <h2>Documents fournis :</h2>
            <table>
                <tr>
                    <th>type</th>
                    <th>date reçu</th>
                    <th>accepté</th>
                </tr>
                <tr>
                    <td>lm</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <td>Rib</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <td>cv</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <td>fiche paie</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
            </table>
        </div>
        <div id="container-main2">
            <h2>Documents restants a fournir :</h2>
            <table>
                <tr>
                    <th>type</th>
                </tr>
                <tr>
                    <td>permis</td>
                </tr>
                <tr>
                    <td>paie</td>
                </tr>
                <tr>
                    <td>cv</td>
                </tr>
                <tr>
                    <td>lm</td>
                </tr>
                <tr>
                    <td>passeport</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
