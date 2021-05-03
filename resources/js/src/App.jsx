import React from 'react';
import FormLogin from './auth/FormLogin';
import Login from './auth/login';

export default props => {

    return (
        <div className="App">
            <FormLogin onSubmit={Login}/>
        </div>
    );

}