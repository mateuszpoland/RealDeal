import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import './assets/css/base.css';
import './index.css';
import store from "./store";
import { Provider } from 'react-redux';

ReactDOM.render(
  <React.StrictMode>
      // wrap all in Redux store
      <Provider store={store}>
        <App />
      </Provider>
  </React.StrictMode>,
  document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
