import './FormLogin.css';
import React from 'react';
import Button from 'react-bootstrap/Button';
import { Form } from 'react-bootstrap';


export default (props) => {
  console.log(props)
    return (
        <div className="w-100 h-100  justify-content-center" style={{display:"flex"}}>
            <div className="col-12 col-md-4">
                <Form action={'http://localhost/Gerenciador-de-clientes/login'} method='post' onSubmit={(e)=>props.onSubmit(e)}>
                    <Form.Group>
                        <Form.Label htmlFor="email">E-mail</Form.Label>
                        <Form.Control type="email" id="email" placeholder="Email" name="email"/>
                    </Form.Group>
                    <Form.Group>
                        <Form.Label htmlFor="password">Senha</Form.Label>
                        <Form.Control type="password" id="password" placeholder="Senha" name="password"/>
                    </Form.Group>
                    <Button type="submit">Entrar</Button>
                </Form>
            </div>
        </div>
    );
}
