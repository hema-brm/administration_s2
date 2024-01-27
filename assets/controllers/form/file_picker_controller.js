import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ['input', 'filename', 'removeButton'];

    files = [];
    text = '';
    defaultText = 'Aucun fichier choisi';

    connect() {
        this.init();
    }

    init() {
        this.toggleRemoveButton();
        this.onChange();
    }

    onChange(event) {
        this.inputTarget.addEventListener('change', (event) => {
            // all files selected by the user
            this.files = event.target.files;
            // implode the files into a string separated by ', '
            this.text = [...this.files].map((file) => file.name).join(', ');

            this.refreshView();
        });
    }

    removeFile(event) {
        event.preventDefault();
        this.files = [];
        this.text = this.defaultText;
        this.refreshView();
    }

    refreshView() {
        this.filenameTarget.innerHTML = this.text;
        this.toggleRemoveButton();
    }

    hasFiles() {
        return this.files.length > 0;
    }

    toggleRemoveButton() {
        if (this.hasFiles()) {
            this.removeButtonTarget.classList.remove('hidden');
        } else {
            this.removeButtonTarget.classList.add('hidden');
        }
    }
}
