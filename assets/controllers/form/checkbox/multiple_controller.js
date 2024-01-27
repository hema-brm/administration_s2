import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ['main', 'items'];

    connect() {
        this.initEvents();
    }

    initEvents() {
        this.onMainChange();
        this.onItemChange();
    }

    onMainChange() {
        this.mainTarget.addEventListener('change', () => {
            this.toggleAll();
        });
    }

    onItemChange() {
        this.itemsTargets.forEach((item) => {
            item.addEventListener('change', () => {
                if (!item.checked) {
                    this.mainTarget.checked = false;
                }

                const allChecked = this.itemsTargets.every((item) => {
                    return item.checked;
                });

                if (allChecked) {
                    this.mainTarget.checked = true;
                }
            });
        });
    }

    toggleAll() {
        this.itemsTargets.forEach((item) => {
            item.checked = this.mainTarget.checked;
        });

        this.dispatchChangeEvent();
    }

    dispatchChangeEvent() {
        this.itemsTargets.forEach((item) => {
            item.dispatchEvent(new Event('change'));
        });
    }
}
