import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["themeChooser"];
    static values = {
        theme: String
    }

    connect() {
        this.init();
    }

    init() {
        this.themeChooserTarget.addEventListener('click', () => {
            this.setTheme();
        });
    }

    setTheme() {
        const body = document.querySelector('body');
        body.classList.forEach(className => {
            if (className.startsWith('theme-')) {
                body.classList.remove(className);
            }
        });
        const themeClass = `theme-${this.themeValue}`;
        body.classList.add(themeClass);
        localStorage.setItem('theme', themeClass);
    }

}