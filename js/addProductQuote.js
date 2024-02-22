document.getElementById('add-product-quote').addEventListener('click', function() {
    // Get the element that holds the collection of productQuotes
    var collectionHolder = document.getElementById('product-quotes');

    // Get the data-prototype
    var prototype = collectionHolder.getAttribute('data-prototype');

    // Get the new index
    var index = collectionHolder.children.length;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on the index
    var newForm = prototype.replace(/__name__/g, index);

    // Display the form in the page in an li, before the "Add a product" link
    var div = document.createElement('div');
    div.innerHTML = newForm;
    collectionHolder.appendChild(div);
});