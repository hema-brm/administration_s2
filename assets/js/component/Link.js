class Link {
    constructor(selector, newTab = false) {
        this.link = document.querySelectorAll(selector);
        this.newTab = newTab;
        this.init();
    }

    init() {
        this.initClasses();
        this.attachEvent();
    }

    initClasses() {
        this.link.forEach(link => {
            link.classList.add('cursor-pointer');
        });
    }

    attachEvent() {
        this.link.forEach(link => {
            link.addEventListener('click', () => this.openLink(link));
        });
    }

    openLink(e) {
        const url = e.dataset.href;
        if (this.newTab) {
            return window.open(url, '_blank');
        }
        window.location = url;
    }
}

export default Link;