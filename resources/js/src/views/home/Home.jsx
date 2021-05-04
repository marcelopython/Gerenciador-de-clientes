import React from 'react';
import {Nav, Navbar} from 'react-bootstrap'
import {NavLink} from 'react-router-dom'
const URI =  '/Gerenciador-de-clientes';

export default () =>{
    return (
        <Navbar bg="dark" >
            <Navbar.Collapse >
                <NavLink to={URI+"/"}  activeClassName="selected" className="nav-link">
                    Home
                </NavLink>
                <NavLink to={URI+"/login"}  activeClassName="selected" className="nav-link">
                    Clientes
                </NavLink>
                <NavLink to={URI+"/login"}  activeClassName="selected" className="nav-link">
                    Sair
                </NavLink>
            </Navbar.Collapse >
        </Navbar>
    );
}