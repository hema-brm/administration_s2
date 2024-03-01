import { Controller } from '@hotwired/stimulus';
import { navigator } from "@hotwired/turbo"

export default class extends Controller {
    static targets = ['items','image1', 'image2','button', 'submit', 'form'];
    static values = {
        action: String
    }

    connect() {
        this.initEvents();
    }

    initEvents() {
        this.onItemsChanged();
        this.onButtonChanged();
    }

    onButtonClicked() {
        this.buttonTarget.addEventListener('click', () => {

        });
    }

    submit() {
        navigator.submitForm(this.formTarget);
    }

    onItemsChanged() {
        this.item.addEventListener('change',()=>{
            if(this.item1.checked){
                this.image2Target.classList.add('hidden');
                this.image1Target.classList.remove('hidden');
            }
            else{
                this.image1Target.classList.add('hidden');
                this.image2Target.classList.remove('hidden');
            }
        });
    }

    onButtonChanged() {
        this.itemsTargets.forEach(item => {
            item.addEventListener('change', () => {
                if (this.itemsTargets.every(item => !item.checked)) {
                    this.buttonTarget.classList.add('hidden');
                } else {
                    this.buttonTarget.classList.remove('hidden');
                }
            });
        });
    }
}
