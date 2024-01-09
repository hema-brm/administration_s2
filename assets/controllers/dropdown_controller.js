import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["container", "toggle", "content"];
    static classes = ["show"];

    connect() {
        this.init();
    }

    init() {
        this.initToggleEvent();
    }

    toggle() {
        this.contentTarget.classList.toggle(this.showClass);
        this.contentTarget.classList.toggle(this.hideClass);
    }

    initToggleEvent() {
        this.toggleTarget.addEventListener('click', () => {
            this.toggle();
        });

        document.addEventListener('click', (event) => {
            const isClickInside = (!this.toggleTarget.contains(event.target)
                && (!this.contentTarget.contains(event.target)));

            if (isClickInside) {
                this.contentTarget.classList.remove(this.showClass);
                this.contentTarget.classList.add(this.hideClass);
            }
        });
    }


}