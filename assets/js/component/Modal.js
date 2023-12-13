// Récupérer les éléments HTML de la modale et des boutons
/*const openModalButton = document.getElementById('category_open_button');
const closeModalButton = document.getElementById('category_close_button');
const modal = document.getElementById('category_modal');

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
closeModalButton.addEventListener('click', closeModal);*/

class Modal{

    constructor(openButtonID, closeButtonID, modalID){
        this.openModalButton = document.getElementById(openButtonID);
        this.closeModalButton = document.getElementById(closeButtonID);
        this.modal = document.getElementById(modalID);
        this.onInit();
    }

    onInit = () =>{
        this.openModalButton.addEventListener('click', this.openModal);
        this.closeModalButton.addEventListener('click', this.closeModal);
    }

    openModal = () => {
        this.modal.classList.remove('hidden');
    }

    closeModal = () => {
        this.modal.classList.add('hidden');
    }

}

export default Modal;