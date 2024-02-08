import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["body"];
    connect() {
        this.init();
    }

    init() {
        this.setTheme();
    }

    setTheme() {
        const themeClass = localStorage.getItem('theme') || 'theme-indigo';
        this.bodyTarget.classList.forEach(className => {
            if (className.startsWith('theme-')) {
                this.bodyTarget.classList.remove(className);
            }
        });
        this.bodyTarget.classList.add(themeClass);
    }
}