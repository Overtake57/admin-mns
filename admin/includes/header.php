<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$title?></title>
    <script src="https://kit.fontawesome.com/587ab224da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/style/main.css">
    <link rel="stylesheet" href=<?=$link?>>
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="../php/logout.php" class="logo">
                <img src="../../assets/img/pngwing.com.png" alt="logo deconnexion" id="logout" />
            </a>
            <div class="nav-links">
                <ul>
                    <li><a href="./index.php">Elèves</a></li>
                    <li><a href="./adminClasse.php">Classes</a></li>
                    <li><a href="./adminLate.php">Absence/Retard</a></li>
                    <li><a href="./adminDoc.php">Document </a></li>
                </ul>
            </div>
            <img src="../../assets/img/menuBurger.png" alt="" class="menu-hamburger" />
        </nav>
    </header>

