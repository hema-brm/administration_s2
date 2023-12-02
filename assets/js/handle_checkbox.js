// Récupérer toutes les cases à cocher des produits
const productCheckboxes = document.querySelectorAll('.product-checkbox');
const checkboxForAllProducts = document.querySelector('.products-checkbox');

const deleteButton = document.getElementById('delete');
const modal_delete = document.getElementById('modal_delete');
const cancelDeleteButton = document.getElementById('cancelDelete');
const confirmDeleteButton = document.getElementById('confirmDelete');
//coche ou decoche les checkbox en fonction de la checkbox qui selectionne tout
function selectAllCheckBoxes(){
    const clickedCheckBox = event.target;

    if(clickedCheckBox == checkboxForAllProducts){
        
        if(clickedCheckBox.checked){
            //active le bouton supprimer

            productCheckboxes.forEach(checkbox => {
                if(!checkbox.checked){
                    checkbox.checked = true;
                }
            });

        }
        else{

            productCheckboxes.forEach(checkbox => {
                if(checkbox.checked){
                    checkbox.checked = false;
                }
            });
        }
    }
    else{
        if(!clickedCheckBox.checked && checkboxForAllProducts.checked){
            checkboxForAllProducts.checked = false;
        }
    }
    checkDeleteButtonState(clickedCheckBox);

}

function checkDeleteButtonState(clickedCheckBox){
    if(clickedCheckBox.checked){
        deleteButton.disabled = false;
    }
    else if (!clickedCheckBox.checked){
        let cmpt = 0;
        productCheckboxes.forEach(checkbox => {
            if(!checkbox.checked){
                cmpt++;
            }
            if(cmpt === productCheckboxes.length){
                deleteButton.disabled = true;
            }
            else{
                deleteButton.disabled = false;
            }
        }
    )}
      
}

//Mettre dans une liste l'id des produits qui ont ete selectionnes
function getCheckBoxProductID(){
    let productsID = [];

        productCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                productsID.push(checkbox.productId);
            }
        });
        return productsID;
    

}
// Afficher la modale
deleteButton.addEventListener('click', () => {
    modal_delete.classList.remove('hidden');
});

cancelDeleteButton.addEventListener('click', () => {
    modal_delete.classList.add('hidden');
});


confirmDeleteButton.addEventListener('click', () => {
    const productsID = getCheckBoxProductID();
    fetch('/delete',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({productsID})
    })

    modal_delete.classList.add('hidden');
});

checkboxForAllProducts.addEventListener('change', selectAllCheckBoxes);

productCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', selectAllCheckBoxes);
});

