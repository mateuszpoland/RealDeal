import { React, useEffect } from 'react';
import SignIn from "./SignIn";
import { Route, Switch } from "react-router-dom";
import Register from "./Register";

const Account = () => {

    useEffect(() => {
        //if(accountService.userValue) {
        //    history.push('/');
        //}
    }, []);

    return (
        <div>
            <Switch>
                <Route path="/signin" exact component={SignIn} />
                <Route path="/register" exact component={Register} />
            </Switch>
        </div>
    );
}

export { Account };

