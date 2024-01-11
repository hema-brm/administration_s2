import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['backdrop', 'modal', 'button'];

    static values = {
        duration: Number,
    }


    connect() {
    }

    open() {
        this.backdropTarget.classList.remove('hidden');
        setTimeout(() => {
            this.backdropTarget.classList.add('opacity-100');
            this.modalTarget.classList.remove('scale-0');
        }, 0);
    }

    close() {
        this.modalTarget.classList.add('scale-0');
        this.backdropTarget.classList.remove('opacity-100');
        this.backdropTarget.classList.add('opacity-0');
        setTimeout(() => {
            this.backdropTarget.classList.add('hidden');
        }, this.durationValue);
    }
}
