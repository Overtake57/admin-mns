<?php
include "../_protect.php";
$title = "Profil de l'élève";
$link = "../../assets/style/adminUserProfile.css";
include "../includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

// Sélectionner un élève depuis index.php (remplacer par la valeur réelle)
$studentId = $_GET['studentId'];

// Récupérer le nombre d'absences
$absencesCount = getAbsenceCount($studentId);

// Récupérer la liste des documents envoyés par l'élève
$sentDocuments = getSentDocuments($studentId);
?>
<div class="container-main">
  <div class="container-sd">
    <!-- Remplacé par un bouton "Élève absent" -->
    <button>Élève absent</button>
  </div>
  <div class="container-sd">
    <h3>Nombre d'absences : <?=htmlspecialchars($absencesCount)?></h3>
  </div>
</div>
<div class="container-doc">
  <table class="tableau">
    <thead>
      <td colspan="3"><h3>Derniers documents envoyés :</h3></td>
    </thead>
    <tr>
      <th>Nom</th>
      <th>Date</th>
      <th>Type</th>
    </tr>
    <?php foreach ($sentDocuments as $document): ?>
    <tr>
      <td><?=htmlspecialchars($document['name'])?></td>
      <td><?=htmlspecialchars($document['date'])?></td>
      <td><?=htmlspecialchars($document['type'])?></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
</body>
</html>
