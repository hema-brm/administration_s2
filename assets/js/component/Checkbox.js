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

    getlistID =()=>{
        let listID = [];
        this.checkboxes.forEach((checkbox) => {
            if(checkbox.checked){
                listID.push(parseInt(checkbox.getAttribute('name')));
                 console.log(typeof parseInt(checkbox.getAttribute('name')));
            }
        });

        return listID;
    }

}

export default Checkbox;
