import axios from 'axios';
import React from 'react';
import { Redirect } from 'react-router'


export default function Login(submitEvent, state) {
    submitEvent.preventDefault();

    const form = submitEvent.target;

    const bodyFormData = new FormData();
    bodyFormData.append('email', form[0].value);
    bodyFormData.append('password', form[1].value);

    axios.post(form.action, bodyFormData)
    .then(resp => {
        if(resp.status === 200){
            console.log(resp)

            return  <Redirect to="/Gerenciador-de-clientes/teste" />

        }else{
            state({displayMessageErro:'d-flex', MessageErro:'Login ou senha inválido'})
        }
    })
    .catch(error => {
        console.log(error)
        state({displayMessageErro:'d-flex', MessageErro:'Login ou senha inválido'})
    })
}
