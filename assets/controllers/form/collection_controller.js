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
        const item = document.createElement('div');
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        const itemClassList = [

        ];

        // Add a remove button
        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', () => {
            item.remove();
        });

        const removeButtonClasses = [
            'bg-danger-50',
            'text-danger-500',
            'hover:bg-danger-100',
            'px-2',
            'py-1',
            'rounded-md',
            'text-xs',
        ];

        removeButton.classList.add(...removeButtonClasses);

        item.appendChild(removeButton);

        this.collectionContainerTarget.appendChild(item);
        this.indexValue++;
        console.log(this.collectionContainerTarget);
    }
}