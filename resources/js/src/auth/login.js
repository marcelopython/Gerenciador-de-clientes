import axios from 'axios';

// myHeaders = new Headers({

//   });

export default function Login(submitEvent) {

    submitEvent.preventDefault();
    const form = submitEvent.target;
    let body = { email: form[0].value, password: form[1].value };

    let config = {
        headers:{
            'Content-Type':'application/json',
            'Accept':'application/json',
                "Content-Type": "text/plain",
    "X-Custom-Header": "ProcessThisImmediately",
        }
        }
        axios.post(form.action, body, config)
        .then(resp => {
            console.log(resp.data )
        })
        .catch(error => {
            console.log(error);
        })


    
    // axios.post(form.action, data, config)
    // .then(resp=>{
    //     console.log(resp.data)
    // }).catch(err => console.error(err));;

}
// {crossDomain: true}{
            //     'Content-Type':'application/x-www-form-urlencoded',
            //     'Access-Control-Allow-Origin':'*',
            // }