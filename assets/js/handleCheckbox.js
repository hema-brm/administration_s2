import Checkbox from './component/Checkbox.js';

//on récupère la case permettant de cocher toutes les autres cases et on le met dans le tableau
const checkboxSelectAllList = [document.querySelector('.products-checkbox'), document.querySelector('.categories-checkbox') ];
//on récupère les cases à cocher (lier a un element) et on le met dans le tableau
const checkboxesList = [document.querySelectorAll('.product-checkbox'), document.querySelectorAll('.category-checkbox')];
//on crée un objet Checkbox
const checkboxObjects = [new Checkbox('.products-checkbox','.product-checkbox'), new Checkbox('.categories-checkbox','.category-checkbox')];
//ID des boutons à désactiver/activer
const disableButton = document.getElementById('disable_buttons');

checkboxSelectAllList.forEach((checkbox, index)=>{
    if(checkbox){
        checkbox.addEventListener('change', ()=>{
        checkboxObjects[index].onInit();
        disableButton.style.display = checkboxObjects[index].disableButton();
        });
    }
    
})

checkboxesList.forEach((checkboxes, index) => {
    if(checkboxes){
        checkboxes.forEach((checkbox)=>{
        checkbox.addEventListener('change', () => {
            checkboxObjects[index].onInit();
            disableButton.style.display = checkboxObjects[index].disableButton();
        });
    })
    }
    
})

/***************************************************************************** */
/********************************DELETE ACTIONS******************************* */
/***************************************************************************** */

const deleteButtons = [document.getElementById('delete_products'), document.getElementById('delete_categories')];
const deleteModals = [document.getElementById('modal_delete')];
const cancelDeleteButtons = [document.getElementById('cancel_delete')];
const confirmDeleteButtons = [document.getElementById('confirm_delete')];
const route = ['/products/delete', '/products/category/delete']

deleteButtons.forEach((button, index)=>{
    if(button){
        button.addEventListener('click',() =>{
            deleteModals[0].classList.remove('hidden');
            
            cancelDeleteButtons[0].addEventListener('click', () => {
                    deleteModals[0].classList.add('hidden');
            });
    
            confirmDeleteButtons[0].addEventListener('click', async () => {
                    const list = checkboxObjects[index].getlistDeleteProducts();
                    console.log(list);
                    console.log('list en json');
                    console.log(JSON.stringify(list));
                    await fetch(route[index],{
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
                            console.error('Erreur lors de la suppresion.');
                        }
                    })
                    .catch(error =>{
                        console.error('Erreur lors de la requête de suppresion : ', error);
                    })
                    
                    modal_delete.classList.add('hidden');
    
            });
        });
    }
    
})