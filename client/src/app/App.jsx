import React, {useEffect, useState} from "react";
import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";
import '../App.css';
import {HTML5Backend}  from 'react-dnd-html5-backend';
import {Dashboard} from "../dashboard/Dashboard";
import {DndProvider} from "react-dnd";
import {useDispatch, useSelector} from "react-redux";

import {history} from "../_helpers/history";
import {Navbar} from "./Navbar";
import {PrivateRoute} from "../components/PrivateRoute";
import SignIn from "../account/SignIn";
import Register from "../account/Register";

const App = () => {
    const dispatch = useDispatch();
    const [isSidebarOpen, setSidebarOpen] = useState(false);
    useEffect(() => {

    });
    const [isUserLoggedIn, userData] = useSelector(
        (state) => [state.user.isUserLoggedIn, state.user.userData]
    );

    const handleSidebarToggle = () => {
        setSidebarOpen(!isSidebarOpen);
        console.log('sidebar open: ' + isSidebarOpen);
    }

    return (
        <DndProvider backend={HTML5Backend}>
            <Navbar handleSidebarToggle={handleSidebarToggle} />
            <Router history={history}>
                <Switch>
                    <PrivateRoute exact path="/" component={Dashboard} />
                    <Route path="/signin" component={SignIn} />
                    <Route path="/signup" component={Register} />
                    <Redirect from="*" to="/" />
                </Switch>
            </Router>
        </DndProvider>
  );
}

export default App;
