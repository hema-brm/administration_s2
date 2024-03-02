import { Controller } from '@hotwired/stimulus';
import { navigator } from "@hotwired/turbo"

export default class extends Controller {
    static targets = ['backdrop', 'modal', 'button', 'cancel', 'confirm', 'form'];

    static values = {
        duration: Number,
        customFormId: String,
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

    cancel() {
        this.close();
    }

    confirm() {
        navigator.submitForm(this.getForm());
        this.close();
    }

    getForm() {
        //console.log('AYO', this.customFormIdValue, this.formTarget);
        if (this.customFormIdValue) {
            return document.getElementById(this.customFormIdValue);
        }
        return this.formTarget;
    }
}
