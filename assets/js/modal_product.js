// Récupérer les éléments HTML de la modale et des boutons
const openModalButton = document.getElementById('openModal');
const closeModalButton = document.getElementById('closeModal');
const modal = document.getElementById('modal');

// Fonction pour ouvrir la modale
function openModal() {
    modal.classList.remove('hidden');
}

// Fonction pour fermer la modale
function closeModal() {
    modal.classList.add('hidden');
}

// Écouter les clics sur le bouton "Ouvrir la modale" pour afficher la modale
openModalButton.addEventListener('click', openModal);

// Écouter les clics sur le bouton "Fermer la modale" pour cacher la modale
closeModalButton.addEventListener('click', closeModal);
