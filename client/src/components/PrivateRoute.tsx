import React, {Component} from "react";
import { Route, Redirect } from 'react-router-dom';

export const PrivateRoute = ({component: Component, roles, ...rest}) => {
    return (
        <Route {...rest} render={props => {
            if (!localStorage.getItem('token')) {
                // not logged in so redirect to login page with the return url
                return <Redirect to={{ pathname: '/signin', state: { from: props.location } }} />
            }

            // check if token is valid
            //if(accountService.checkIfTokenExpired())
            return <Component {...props} />
        }} />
    );
}
