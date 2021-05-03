import 'bootstrap/dist/css/bootstrap.min.css';
import './app.css';
import React from 'react'
import ReactDom from 'react-dom';
import App from './src/App';

ReactDom.render(
    <App/>
    , 
    document.getElementById('app')
);
