class NavToggle {
    constructor(toggleSelector, navSelector) {
        this.navToggle = document.querySelector(toggleSelector);
        this.nav = document.querySelector(navSelector);
        this.navToggle.addEventListener('click', () => this.toggle());
    }

    toggle() {
        const isOpen = this.nav.getAttribute('data-open') === 'true';
        this.nav.setAttribute('data-open', !isOpen);
        if (isOpen) {
            this.nav.classList.remove('ml-0');
            this.nav.classList.add('ml-[-18rem]');
        } else {
            this.nav.classList.add('ml-0');
            this.nav.classList.remove('ml-[-18rem]');
        }
    }
}

export default NavToggle;