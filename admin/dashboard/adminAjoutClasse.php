<?php
session_start();

$allowedRoles = array("admin", "super_admin");

if (!isset($_SESSION["user"]) || !in_array($_SESSION["user"]["role"], $allowedRoles)) {
    header("Location: ../index.php");
    exit();
}
$title = "Ajout d'une classe";
$link = "../../assets/style/adminAjoutClasse.css";
include "../includes/header.php";
if (!empty($_SESSION['erreur'])): ?>
    <p class="error"><?php echo $_SESSION['erreur']; ?></p>
    <?php unset($_SESSION['erreur']);endif;?>

  <div id="container-main">
    <main>
      <form method="post" action="../php/addClass.php">
        <div class="form-group">
          <label for="className">Nom de la classe :</label>
          <input type="text" id="className" name="className" required />
        </div>
        <div class="form-group">
          <label for="classDesc">Description :</label>
          <input type="text" id="classDesc" name="classDesc" required />
        </div>

        <!-- Bouton Valider à l'intérieur de la balise <form> -->
        <div class="center-button">
          <button type="submit" id="button">Valider</button>
        </div>
      </form>
    </main>
  </div>

  <script src="../../assets/javascript/script.js"></script>
</body>

</html>
