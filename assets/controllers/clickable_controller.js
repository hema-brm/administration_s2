import { Controller } from '@hotwired/stimulus';
import * as Turbo from "@hotwired/turbo";
export default class extends Controller {

    static targets = ['element', 'exclude'];
    static values = {
        path: String
    };

    connect() {
        this.init();
    }

    init() {
        this.initClasses();
    }

    initClasses() {
        this.elementTarget.classList.add('cursor-pointer');
    }

    visit(event) {
        if (this.shouldVisit(event)) {
            Turbo.visit(this.pathValue);
        }
    }

    shouldVisit(event) {
        let target = event.target;
        let excludeTarget = this.excludeTarget;
        let visit = true;

        while (target !== excludeTarget && target !== document.body) {
            target = target.parentNode;
        }

        if (target === excludeTarget) {
            visit = false;
        }

        return visit;
    }
}
