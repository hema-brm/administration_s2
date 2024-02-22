import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["collectionContainer"]

    static values = {
        index    : Number,
        prototype: String,
    }

    connect()
    {
        console.log('FormCollectionController connected');
    }

    addCollectionElement(event)
    {
        const item = document.createElement('li');
        console.log(this.prototypeValue);
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        this.collectionContainerTarget.appendChild(item);
        this.indexValue++;
        console.log(this.collectionContainerTarget);
    }
}