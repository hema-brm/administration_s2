class Checkbox{
    constructor(checkboxForAll, checkboxes){
        this.checkboxSelectAll = document.querySelector(checkboxForAll);
        this.checkboxes = document.querySelectorAll(checkboxes);
        this.onInit();
    }

    onInit =()=>{
        if(this.checkboxSelectAll){
             this.checkboxSelectAll.addEventListener('change', this.selectAllCheckboxes);
        }
       if(this.checkboxes){
            this.checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', this.selectAllCheckboxes);
            });
       }
        

    }

    disableButton =()=>{
        for(let checkbox of this.checkboxes){
            if(checkbox.checked){
                return "block";
            }
        }
        return "none";
    
    }

    selectAllCheckboxes =()=>{
        const clickedCheckBox = event.target;

        if(clickedCheckBox == this.checkboxSelectAll && clickedCheckBox.checked){
            this.checkboxes.forEach((checkbox) => {
                if(!checkbox.checked){
                    checkbox.checked = true;
                }
            });
        }
        else if(clickedCheckBox == this.checkboxSelectAll && !clickedCheckBox.checked){
            this.checkboxes.forEach((checkbox) => {
                if(checkbox.checked){
                    checkbox.checked = false;
                }
            });
        }
        else if(clickedCheckBox != this.checkboxSelectAll && !clickedCheckBox.checked){
            if(this.checkboxSelectAll.checked){
                this.checkboxSelectAll.checked = false;
            }
        }
    
    }

    getlistToDelete =()=>{
        let list = [];
        this.checkboxes.forEach((checkbox) => {
            if(checkbox.checked){
                let id = parseInt(checkbox.getAttribute('name'));
                let token = checkbox.getAttribute('data-csrf-token');
                list.push({ id: id, token: token});
            }
        });

        return list;
    }

}

export default Checkbox;