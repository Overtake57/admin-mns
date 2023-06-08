//! envie de creuver

// Récupérer tous les boutons "Autre"
const autreButtons = document.querySelectorAll(".autre-button");

// Récupérer la pop-up et les boutons correspondants
const popup = document.getElementById("popup");
const modifyButton = document.getElementById("modifyButton");
const deleteButton = document.getElementById("deleteButton");
const closeButton = document.getElementById("closeButton");

let currentIndex = null; // Index de la ligne sélectionnée

// Fonction pour afficher la pop-up avec les options Modifier et Supprimer
const showPopup = (index) => {
  popup.style.display = "block";
  currentIndex = index; // Stocker l'index de la ligne sélectionnée
};

// Fonction pour cacher la pop-up
const hidePopup = () => {
  popup.style.display = "none";
};

// Fonction pour gérer l'action de modification
const handleModify = () => {
  // Récupérer la ligne correspondante avec l'index
  const row = document.getElementById(`row-${currentIndex}`);
  // Effectuer l'action de modification sur la ligne sélectionnée
  // ...
  hidePopup();
};

// Fonction pour gérer l'action de suppression
const handleDelete = () => {
  // Récupérer la ligne correspondante avec l'index
  const row = document.getElementById(`row-${currentIndex}`);

  // Envoyer une requête AJAX pour supprimer la classe
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../includes/suppClasse.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    // Vérifier le statut de la réponse du serveur
    if (xhr.status === 200) {
      // Suppression réussie, mettre à jour l'interface utilisateur
      row.remove();
      console.log("La classe a été supprimée avec succès");
    } else {
      // La suppression a échoué, afficher un message d'erreur
      console.error("Erreur lors de la suppression de la classe");
    }
  };

  const classId = autreButtons[currentIndex].getAttribute("data-class-id");
  xhr.send(`classId=${classId}`); // Envoyer l'ID de la classe au serveur

  hidePopup();
};

// Ajouter un écouteur d'événement à chaque bouton "Autre"
autreButtons.forEach((button) => {
  const index = button.getAttribute("data-index");
  button.addEventListener("click", () => showPopup(index));
});

// Ajouter un écouteur d'événement au clic sur le bouton de fermeture
closeButton.addEventListener("click", hidePopup);

// Ajouter un écouteur d'événement au clic sur le bouton "Modifier"
modifyButton.addEventListener("click", handleModify);

// Ajouter un écouteur d'événement au clic sur le bouton "Supprimer"
deleteButton.addEventListener("click", handleDelete);
