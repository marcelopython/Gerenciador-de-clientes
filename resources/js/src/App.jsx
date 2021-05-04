import React, { useState } from 'react';
import { BrowserRouter as Router, Route, Switch, Redirect} from "react-router-dom";
import FormLogin from './views/auth/FormLogin';
import Home from './views/home/Home';



const URI =  '/Gerenciador-de-clientes';

const stateApp = {
    logado:false
}

export default props => {

    const [state, setState] = useState(stateApp);
    
    return (
        <Router>
            <div>
                <Switch>
                    
                    <Route path={URI+"/login"}>
                        <FormLogin stateApp={setState}/>
                        { state.logado ? <Redirect to={URI+"/"}/> : '' }
                    </Route>
                     
                    <Route path={URI+"/"}>
                        <Home />
                    </Route>

                </Switch>
            </div>
        </Router>
    );
}