import axios from 'axios';


export default function Login(submitEvent, state, stateApp) {

    submitEvent.preventDefault();

    const form = submitEvent.target;

    const bodyFormData = new FormData();
    bodyFormData.append('email', form[0].value);
    bodyFormData.append('password', form[1].value);

    axios.post(form.action, bodyFormData)
    .then(resp => {
        if(resp.status === 200){
            stateApp({logado:true});
            return true
        }else{
            state({displayMessageErro:'d-flex', MessageErro:'Login ou senha inválido'})
        }
    })
    .catch(error => {
        state({displayMessageErro:'d-flex', MessageErro:'Login ou senha inválido'})
    })
}
