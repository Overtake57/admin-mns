<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajouter un élève</title>
    <link rel="stylesheet" href="../../assets/style/adminAjoutEleve.css" />
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

    <h1>Ajouter un utilisateur</h1>
    <div id="container-main">
        <main>
            <form method="post" action="../includes/ajoutUser.php">
                <div class="form-group">
                    <label for="userSurname">Nom :</label>
                    <input type="text" id="userSurname" name="userSurname" required />
                </div>
                <div class="form-group">
                    <label for="userName">Prénom :</label>
                    <input type="text" id="userName" name="userName" required />
                </div>
                <div class="form-group">
                    <label for="userAge">Age :</label>
                    <input type="number" id="userAge" name="userAge" required />
                </div>
                <div class="form-group">
                    <label for="userPhone">Téléphone :</label>
                    <input type="number" id="userPhone" name="userPhone" required />
                </div>
                <div class="form-group">
                    <label for="userMail">Email :</label>
                    <input type="text" id="userMail" name="userMail" required />
                </div>
                <div class="form-group">
                    <label for="userCity">Ville :</label>
                    <input type="text" id="userCity" name="userCity" required />
                </div>
                <div class="form-group">
                    <label for="userStreet">Nom de la voie :</label>
                    <input type="text" id="userStreet" name="userStreet" required />
                </div>
                <div class="form-group">
                    <label for="userCp">Code postal :</label>
                    <input type="text" id="userCp" name="userCp" required />
                </div>
                <div class="form-group">
                    <label for="className">Classe :</label>
                    <select id="className" name="className" required>
                        <?php
try {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
    require_once "../php/function.php";

    $classes = getClasses($conn);

    if (!empty($classes)) {
        foreach ($classes as $class) {
            echo '<option value="' . $class['classId'] . '">' . $class['className'] . '</option>';
        }
    } else {
        echo "Aucune classe trouvée.";
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/close.php";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
                    </select>
                </div>

                <button type="submit">Valider</button>
            </form>
        </main>
    </div>
    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
