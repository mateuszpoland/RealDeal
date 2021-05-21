import React from 'react';
import {AppBarTop} from "../../components/AppBarTop";
import SignIn from "./SignIn";
import { Route, Switch } from "react-router-dom";
import Register from "./Register";

export const RegisterPage: React.FC = () => {
    return (
        <div>
            <AppBarTop handleSidebarToggle={() => false}/>
            <Switch>
                <Route path="/signin" exact component={SignIn} />
                <Route path="/register" exact component={Register} />
            </Switch>
        </div>
    );
}
