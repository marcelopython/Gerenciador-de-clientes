import React from 'react';
import FormLogin from './auth/FormLogin';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";

const URI =  '/Gerenciador-de-clientes';

function teste(){
    return (
        <div><h1>Logado</h1></div>
    );
}

export default props => {

    return (
        <div className="App">
            <Router>
                <div>
                    <Route path={URI+"/login1"}  component={FormLogin} />
                    <Route path={URI+"/teste"}  component={teste} />
                </div>
            </Router>
        </div>
    );

}