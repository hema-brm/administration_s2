import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['button', 'menu'];
    static values = {
        open: String,
        menu: String,
        margin: Number
    };

    connect() {
        this.toggle();
    }

    toggle() {
        const menuElement = document.getElementById(this.menuValue);
        this.buttonTarget.addEventListener('click', () => {
            menuElement.classList.toggle('ml-0');
            menuElement.classList.toggle('-ml-' + this.marginValue);
        });
    }
}
