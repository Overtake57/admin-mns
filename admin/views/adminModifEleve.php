<?php
include "../_protect.php";
$link = "../../assets/style/adminAjoutEleve.css";
$title = "Modification d'un élève";
include "../includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";
require_once "../php/updateUser.php";
?>
    <div id="container-eleves">
    </div>
    <div id="container-main">
        <div id="container-eleve">
            <form method="post" action="adminModifEleve.php?studentId=<?php echo $studentId; ?>">
                <div class="form-group">
                    <label for="userSurname">Nom :</label>
                    <input type="text" id="userSurname" name="userSurname" value="<?php echo $student['userSurname']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userName">Prénom :</label>
                    <input type="text" id="userName" name="userName" value="<?php echo $student['userName']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userAge">Age :</label>
                    <input type="number" id="userAge" name="userAge" value="<?php echo $student['userAge']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userPhone">Téléphone :</label>
                    <input type="number" id="userPhone" name="userPhone" value="<?php echo $student['userPhone']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userMail">Email :</label>
                    <input type="text" id="userMail" name="userMail" value="<?php echo $student['userMail']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userCity">Ville :</label>
                    <input type="text" id="userCity" name="userCity" value="<?php echo $student['userCity']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userStreet">Nom de la voie :</label>
                    <input type="text" id="userStreet" name="userStreet" value="<?php echo $student['userStreet']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="userCp">Code postal :</label>
                    <input type="text" id="userCp" name="userCp" value="<?php echo $student['userCp']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="className">Classe :</label>
                    <select id="className" name="className" required>
                        <?php
$classes = getClasses($conn);

if (!empty($classes)) {
    foreach ($classes as $class) {
        $selected = ($class['classId'] == $student['classId']) ? "selected" : "";
        echo '<option value="' . $class['classId'] . '" ' . $selected . '>' . $class['className'] . '</option>';
    }
} else {
    echo "Aucune classe trouvée.";
}
?>
                    </select>
                </div>
                <div class="center-button">
                    <button type="submit" id="button" name="submit">Valider</button>
                </div>
            </form>

        </div>

    <script src="../../assets/javascript/script.js"></script>

</body>

</html>
