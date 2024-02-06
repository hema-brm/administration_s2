import Checkbox from './component/Checkbox.js';
const listID = [
                ['.categories-checkbox', '.category-checkbox'],
             ];

//on récupère la case permettant de cocher toutes les autres cases et on le met dans le tableau
const checkboxSelectAllList = [];
//on récupère les cases à cocher (lier a un element) et on le met dans le tableau
const checkboxesList = [];
//on récupère les objets de type Checkbox
const checkboxObjects = [];

listID.forEach(item => {
    const [selectAllSelector, checkboxSelector] = item;
    
    const selectAllCheckbox = document.querySelector(selectAllSelector);
    const checkboxes = document.querySelectorAll(checkboxSelector);
    const object = new Checkbox(selectAllSelector, checkboxSelector);
    
    checkboxSelectAllList.push(selectAllCheckbox);
    checkboxesList.push(checkboxes);
    checkboxObjects.push(object);
});

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

const listDeleteButtonsId = [
                            'delete_products',
                            'delete_categories',
                            'delete_employees'
                            ];

const deleteButtons  = [];         

listDeleteButtonsId.forEach(id => {
    const elements = document.getElementById(id); 
    deleteButtons.push(elements);
});

const deleteModal = document.getElementById('modal_delete');
const cancelDeleteButton = document.getElementById('cancel_delete');
const confirmDeleteButton = document.getElementById('confirm_delete');
const route = [
    '/products/delete',
    '/products/category/delete',
    '/employee/delete'
  ]

deleteButtons.forEach((button, index)=>{
    if(button){
        button.addEventListener('click',() =>{
            deleteModal.classList.remove('hidden');
            
            cancelDeleteButton.addEventListener('click', () => {
                    deleteModal.classList.add('hidden');
            });
    
            confirmDeleteButton.addEventListener('click', async () => {
                    const list = checkboxObjects[index].getlistToDelete();
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
                            console.error('Erreur lors de la suppression.');
                        }
                    })
                    .catch(error =>{
                        console.error('Erreur lors de la requête de suppression : ', error);
                    })
                    
                    modal_delete.classList.add('hidden');
    
            });
        });
    }
    
})