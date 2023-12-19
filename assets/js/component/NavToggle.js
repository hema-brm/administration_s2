class NavToggle {
    constructor(toggleSelector, navSelector, marginLeft = 0) {
        this.navToggle = document.querySelector(toggleSelector);
        this.nav = document.querySelector(navSelector);
        this.marginLeft = marginLeft;
        this.navToggle.addEventListener('click', () => this.toggle());
    }

    toggle() {
        const isOpen = this.nav.getAttribute('data-open') === 'true';
        this.nav.setAttribute('data-open', !isOpen);
        if (isOpen) {
            this.nav.classList.remove('ml-0');
            this.nav.classList.add('-ml-' + this.marginLeft);
        } else {
            this.nav.classList.add('ml-0');
            this.nav.classList.remove('-ml-' + this.marginLeft);
        }
    }
}

export default NavToggle;