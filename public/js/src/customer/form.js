

class Address{

    constructor() {
        this.states = {
            "AC": "Acre",
            "AL": "Alagoas",
            "AM": "Amazonas",
            "AP": "Amapá",
            "BA": "Bahia",
            "CE": "Ceará",
            "DF": "Distrito Federal",
            "ES": "Espírito Santo",
            "GO": "Goiás",
            "MA": "Maranhão",
            "MG": "Minas Gerais",
            "MS": "Mato Grosso do Sul",
            "MT": "Mato Grosso",
            "PA": "Pará",
            "PB": "Paraíba",
            "PE": "Pernambuco",
            "PI": "Piauí",
            "PR": "Paraná",
            "RN": "Rio Grande do Norte",
            "RO": "Rondônia",
            "RS": "Rio Grande do Sul",
            "SC": "Santa Catarina",
            "SE": "Sergipe"
        }
        this.indexFormAdrress = 0;
        this.setLastNumberItemForm();
        this.notObligatory = {
            complement:'complement'
        }
        this.handleClickAddHtmlAddress();
    }

    setLastNumberItemForm(){
        let totalItemAddress = $('#total-item-address')
        if(totalItemAddress[0]){
            totalItemAddress = Number.parseInt(totalItemAddress.val());
            for(let i = 0; i < totalItemAddress; i++){
                this.handleClickRemoveAddress(i)
            }
        }else{
            totalItemAddress = 0;
        }
        this.indexFormAdrress = totalItemAddress;
    }

    handleClickAddHtmlAddress(){
        $('#btn-new-address').click((event)=>{
            if(this.validateAddNewFormAddress()) {
                $('#container-address').prepend(this.getLastHtmlAddress())
                this.handleClickRemoveAddress(this.indexFormAdrress);
            }
        })
    }

    handleClickRemoveAddress(index){
        $(`#btn-remove-address-${index}`).click(event=>{
            let target = event.target;
            if(target.nodeName === 'I'){
                target = target.parentNode;
            }
            target.parentElement.offsetParent.remove();
        })
    }

    validateAddNewFormAddress(){
        let formAddress = $('.form-address');
        for(const element of formAddress){
            if(!this.notObligatory[element.dataset.name]){
                if(!element.value){
                    alert('Por favor complete o endereço pendente!');
                    return false;
                }
            }
        }
        return true;
    }

    getLastHtmlAddress(){
        this.indexFormAdrress ++;

        let htmlOptionsState = '';
        for (let state in this.states){
            htmlOptionsState += `<option value="${state}">${this.states[state]}</option>`;
        }
        return `
        <div id="address-item-${this.indexFormAdrress}" class="form-row col-12 p-0 mt-2">
            <div class="col-12 pr-0">
                <button class="float-right btn btn-danger" type="button" id="btn-remove-address-${this.indexFormAdrress}">
                     <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="form-group col-md-3">
                <label for="address[${this.indexFormAdrress}][cep]">Cep<span style="color: red">*</span></label>
                <input autocomplete="no" type="text" inputmode="numeric" class="form-control form-address" id="address[${this.indexFormAdrress}][cep]"
                       name="address[${this.indexFormAdrress}][cep]" maxlength="9" required>
            </div>
            <div class="form-group col-md-7">
                <label for="address[${this.indexFormAdrress}][address]">Endereço<span style="color: red">*</span>
                </label>
                <input autocomplete="no" type="text" class="form-control form-address" name="address[${this.indexFormAdrress}][address]" id="address[${this.indexFormAdrress}][address]"
                       maxlength="100" required>
            </div>
            <div class="form-group col-md-2">
                <label for="address[${this.indexFormAdrress}][number]">Número<span style="color: red">*</span></label>
                <input autocomplete="no" type="text" class="form-control form-address" required
                 name="address[${this.indexFormAdrress}][number]" id="address[${this.indexFormAdrress}][number]" maxlength="10">
            </div>
            <div class="form-group col-md-3">
                <label for="address[${this.indexFormAdrress}][complement]">Complemento</label>
                <input autocomplete="no" type="text" class="form-control form-address" data-name="complement" 
                 name="address[${this.indexFormAdrress}][complement]" id="address[${this.indexFormAdrress}][complement]"
                       maxlength="60" >
            </div>
            <div class="form-group col-md-3">
                <label for="address[${this.indexFormAdrress}][neighborhood]">Bairro<span style="color: red">*</span>
                </label>
                <input autocomplete="no" type="text" class="form-control form-address" name="address[${this.indexFormAdrress}][neighborhood]"
                       id="address[${this.indexFormAdrress}][neighborhood]" maxlength="60" required>
            </div>
            <div class="form-group col-md-3">
                <label for="address[${this.indexFormAdrress}][city]">Cidade<span style="color: red">*</span></label>
                <input autocomplete="no" type="text" class="form-control form-address" 
                name="address[${this.indexFormAdrress}][city]" id="address[${this.indexFormAdrress}][city]" maxlength="60" required>
            </div>
            <div class="form-group col-md-3">
                <label for="address[${this.indexFormAdrress}][state]">Estado<span style="color: red">*</span></label>
                <select type="text" class="form-control form-address" name="address[${this.indexFormAdrress}][state]" 
                required id="address[${this.indexFormAdrress}][state]" autocomplete="no">
                    <option value="">Estados</option>
                    ${htmlOptionsState}
                </select>
            </div>
        <div class="col-12">
            <hr>    
        </div>
        </div>`;
    }
}


class Customer{

    constructor() {
        this.handleKeyUpRg()
        this.handleKeyUpCpf()
        this.handleKeyUpPhone();
    }

    handleKeyUpRg(){
        $('#rg').keyup((event)=>{
            if(event.target.value.length > 7) {
                event.target.value = event.target.value.slice(0, -1)
            }
        });
    }

    handleKeyUpCpf(){
        $('#cpf').keyup((event)=>{
            if(event.target.value.length > 11) {
                event.target.value = event.target.value.slice(0, -1)
            }
        });
    }

    handleKeyUpPhone(){
        $('#phone').keyup((event)=>{
            if(event.target.value.length > 11) {
                event.target.value = event.target.value.slice(0, -1)
            }
        });
    }

}

new Address();
new Customer();