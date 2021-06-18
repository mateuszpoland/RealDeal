import React, {useEffect, useState} from "react";
import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";
import '../App.css';
import {HTML5Backend}  from 'react-dnd-html5-backend';
import {Dashboard} from "../dashboard/Dashboard";
import {DndProvider} from "react-dnd";
import {history} from "../_helpers/history";
import {PrivateRoute} from "../components/PrivateRoute";
import SignIn from "../account/SignIn";

const App = () => {
    return (
        <DndProvider backend={HTML5Backend}>
            <Router history={history}>
                <Switch>
                    <PrivateRoute exact path="/" component={Dashboard} />
                    <Route path="/signin" component={SignIn} />
                </Switch>
            </Router>
        </DndProvider>
  );
}

export default App;
