import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["container", "close"];
    static classes = ["hidden"];

    connect() {
        this.init();
    }

    init() {
        this.initCloseButtonEvent();
        this.initMouseEvent();
        this.reveal();
        this.hideAfterTimeout(7000);
    }

    initMouseEvent() {
        this.onMouseOver();
        this.onMouseOut();
    }

    hideAfterTimeout(time) {
        setTimeout(() => {
            if (!this.isHovered) {
                this.containerTarget.classList.add(this.hiddenClass);
            }
        }, time);
    }

    showAfterTimeout(time) {
        setTimeout(() => {
            this.containerTarget.classList.remove(this.hiddenClass);
        }, time);
    }

    reveal() {
        this.isHovered = false;
        this.showAfterTimeout(0);
    }

    close() {
        this.isHovered = false;
        this.hideAfterTimeout(0);
    }

    initCloseButtonEvent() {
        this.closeTarget.addEventListener('click', () => {
            this.close();
        });
    }

    onMouseOver() {
        this.containerTarget.addEventListener('mouseover', () => {
            this.isHovered = true;
        });
    }

    onMouseOut() {
        this.containerTarget.addEventListener('mouseout', () => {
            this.isHovered = false;
            this.hideAfterTimeout(2000);
        });
    }
}