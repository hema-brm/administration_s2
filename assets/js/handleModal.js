import Modal from "./component/Modal.js";

const openModalButtons = [document.getElementById('category_open_button')];
const modals = [new Modal('category_open_button', 'category_close_button', 'category_modal')];

openModalButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
            modals[index].onInit();
    });
})
