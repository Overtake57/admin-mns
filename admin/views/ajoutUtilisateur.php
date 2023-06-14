<?php
include "../_protect.php";
$title = "Ajout d'un élève";
$link = "../../assets/style/adminAjoutEleve.css";

include "../includes/header.php";

if (!empty($_SESSION['erreur'])) {
    echo "<p class='error'>" . $_SESSION['erreur'] . "</p>";
    unset($_SESSION['erreur']);
}

require_once "../../connexion/connect.php";
require_once "../php/function.php";

?>

<div id="container-main">
    <main>
        <form method="post" action="../php/addUser.php">
            <div class="form-group">
                <label for="userMail">Email :</label>
                <input type="email" id="userMail" name="userMail" required />
            </div>
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
                    <option value="0">Aucune</option>
                    <?php
$conn = $GLOBALS['conn'];

$classes = getClasses($conn);
foreach ($classes as $class) {
    echo "<option value='" . $class['classId'] . "'>" . $class['className'] . "</option>";
}
?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-button">Ajouter</button>
            </div>
        </form>
    </main>
</div>

<script src="../../assets/js/adminMenu.js"></script>
</body>

</html>
