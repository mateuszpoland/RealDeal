import React, {useEffect, useState} from "react";
import {Router, Route, Switch, Redirect} from "react-router-dom";
import '../App.css';
import {HTML5Backend}  from 'react-dnd-html5-backend';
import {Dashboard} from "../dashboard/Dashboard";
import {DndProvider} from "react-dnd";
import {PrivateRoute} from "../components/PrivateRoute";
import SignIn from "../account/SignIn";
import { createBrowserHistory } from 'history';

const App = () => {
    const history = createBrowserHistory();
    return (
        <Router history={history}>
            <DndProvider backend={HTML5Backend}>
                <Switch>
                    <PrivateRoute path="/" component={Dashboard} />
                    <Route path="/signin" component={SignIn} />
                </Switch>
            </DndProvider>
        </Router>
  );
}

export default App;
