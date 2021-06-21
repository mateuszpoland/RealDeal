import React from 'react';
import { Route, Switch, Redirect } from "react-router-dom";
import ListOfferView from "../offers/OffersListView";
import {ClientsListView} from "../clients/ClientsListView";
import {OfferView} from "../offers/OfferView";
import {MainDashboard} from "./MainDashboard";

/* display contents*/
export const ContentView = () => {
    return(
        <Switch>
            <Route path='/' component={MainDashboard} />
            <Route path='/offers' component={ListOfferView} />
            <Route path='/clients' exact component={ClientsListView} />
            <Route path="/offers/:id" exact component={OfferView} />
            <Redirect from="*" to="/" />
        </Switch>
    );
}
