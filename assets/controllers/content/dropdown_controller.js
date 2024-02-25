import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["container", "toggle", "content"];
    static classes = ["show"];
    toggleClicked = false;
    isFirstClick = true;

    connect() {
        this.init();
    }

    init() {
        this.initToggleEvent();
    }

    toggle() {
        this.toggleClicked = true;
        this.updateToggleClass();
        this.toggleClicked = false;
        this.contentTarget.classList.toggle(this.showClass);
        this.contentTarget.classList.toggle(this.hideClass);
    }

    updateToggleClass() {
        if(this.isFirstClick){
            if(this.toggleClicked){
                this.toggleTarget.classList.add('rotate-45');
                this.toggleTarget.classList.add('bg-primary-600');
                this.toggleTarget.classList.add('rounded-full');
                this.isFirstClick = false;
            }
        }else{
            this.toggleTarget.classList.remove('rotate-45');
            this.toggleTarget.classList.remove('bg-primary-600');
            this.toggleTarget.classList.remove('rounded-full');
            this.isFirstClick = true;
        }
    }

    initToggleEvent() {
        this.toggleTarget.addEventListener('click', () => {
            this.toggle();
        });

        document.addEventListener('click', (event) => {
            const isClickInside = (!this.toggleTarget.contains(event.target)
                && (!this.contentTarget.contains(event.target)));

            if (isClickInside) {
                this.updateToggleClass();
                this.contentTarget.classList.remove(this.showClass);
                this.contentTarget.classList.add(this.hideClass);
            }
        });
    }


}