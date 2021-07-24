import React from 'react';
import {Router, Route, Switch, Redirect, useHistory} from "react-router-dom";
import ListOfferView from "../offers/OffersListView";
import {ClientsListView} from "../clients/ClientsListView";
import {OfferView} from "../offers/OfferView";
import {MainDashboard} from "./MainDashboard";


/* display contents*/
export const ContentView = () => {
    const history = useHistory();
    return(
        <Router history={history}>
            <Switch>
                <Route exact path='/'>
                    <MainDashboard />
                </Route>
                <Route path='/offers'>
                    <ListOfferView/>
                </Route>
                <Route path='/clients'>
                    <ClientsListView />
                </Route>
                <Route path="/offers/:id">
                    <OfferView/>
                </Route>
                <Redirect from="*" to="/" />
            </Switch>
        </Router>
    );
}