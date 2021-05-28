import React from 'react';
import { render } from 'react-dom';
import App from './app/App';
import './assets/css/base.css';
import './index.css';
import store from "./store";
import { Provider } from 'react-redux';

render(
    <Provider store={store}>
        <React.StrictMode>
            <App />
        </React.StrictMode>,
    </Provider>,
    document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
