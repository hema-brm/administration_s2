import { Controller } from '@hotwired/stimulus';
import { navigator } from "@hotwired/turbo"

export default class extends Controller {
    static targets = ['items', 'button', 'submit', 'form'];
    static values = {
        action: String
    }

    connect() {
        this.initEvents();
    }

    initEvents() {
        this.onItemsChanged();
        this.onButtonClicked();
    }

    onButtonClicked() {
        this.buttonTarget.addEventListener('click', () => {

        });
    }

    submit() {
        navigator.submitForm(this.formTarget);
    }

    get() {
        return this.itemsTargets.filter(item => item.checked);
    }

    // hide submit if all items are unchecked
    onItemsChanged() {
        this.itemsTargets.forEach(item => {
            item.addEventListener('change', () => {
                // if every item is unchecked
                if (this.itemsTargets.every(item => !item.checked)) {
                    this.buttonTarget.classList.add('hidden');
                } else {
                    this.buttonTarget.classList.remove('hidden');
                }
            });
        });
    }
}
