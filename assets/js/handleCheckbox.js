import Checkbox from './component/Checkbox.js';

//on récupère la case permettant de cocher toutes les autres cases et on le met dans le tableau
const checkboxSelectAllList = [document.querySelector('.products-checkbox') ];
//on récupère les cases à cocher (lier a un element) et on le met dans le tableau
const checkboxesList = [document.querySelectorAll('.product-checkbox')];
//on crée un objet Checkbox
const checkboxObjects = [new Checkbox('.products-checkbox','.product-checkbox')];

checkboxSelectAllList.forEach((checkbox, index)=>{
    checkbox.addEventListener('change', checkboxObjects[index].onInit());
})

checkboxesList.forEach((checkboxes, index) => {
    checkboxes.forEach((checkbox)=>{
        checkbox.addEventListener('click', () => {
            checkboxObjects[index].onInit();
            checkboxObjects[index].getProductsID();
        });
    })
})

/***************************************************************************** */
/********************************DELETE ACTIONS******************************* */
/***************************************************************************** */

const deleteButtons = [document.getElementById('delete')];
const deleteModals = [document.getElementById('modal_delete')];
const cancelDeleteButtons = [document.getElementById('cancel_delete')];
const confirmDeleteButtons = [document.getElementById('confirm_delete')];

deleteButtons.forEach((button, index)=>{
    button.addEventListener('click',() =>{
        deleteModals[index].classList.remove('hidden');
        
        cancelDeleteButtons[index].addEventListener('click', () => {
                deleteModals[index].classList.add('hidden');
        });

        confirmDeleteButtons[index].addEventListener('click', async () => {
                const list = checkboxObjects[index].getProductsID();
                await fetch('/products/delete',{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
            
                    body: JSON.stringify(list)
                })
                .then(response => {
                    if(response.ok){
                        window.location.reload(true);
                    }
                    else{
                        console.error('Erreur lors de la suppresion des produits.');
                    }
                })
                .catch(error =>{
                    console.error('Erreur lors de la requête de suppresion : ', error);
                })
                
                modal_delete.classList.add('hidden');

        });
    });
})


