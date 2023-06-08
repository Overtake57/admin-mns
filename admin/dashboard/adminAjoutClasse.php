<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://kit.fontawesome.com/587ab224da.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajouter une classe</title>
    <link rel="stylesheet" href="../../assets/style/adminAjoutClasse.css" />
</head>

<body>
    <header>
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
    </header>
    <?php if (!empty($_SESSION['erreur'])): ?>
    <p class="error"><?php echo $_SESSION['erreur']; ?></p>
    <?php unset($_SESSION['erreur']);endif;?>

    <h1>Ajouter une classe</h1>
    <div id="container-main">
        <main>
            <form method="post" action="../includes/ajoutClass.php">
                <div class="form-group">
                    <label for="className">Nom de la classe :</label>
                    <input type="text" id="className" name="className" required />
                </div>
                <div class="form-group">
                    <label for="classDesc">Description :</label>
                    <input type="text" id="classDesc" name="classDesc" required />
                </div>

                <button type="submit">Valider</button>
            </form>
        </main>
    </div>
    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
