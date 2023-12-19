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