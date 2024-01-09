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
        const body = document.querySelector('body');
        const themeClass = localStorage.getItem('theme') || 'theme-default';
        body.classList.forEach(className => {
            if (className.startsWith('theme-')) {
                body.classList.remove(className);
            }
        });
        body.classList.add(themeClass);
    }
}