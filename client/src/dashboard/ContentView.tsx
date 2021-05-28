import React from 'react';
import { Route, Switch } from "react-router-dom";
import ListOfferView from "../offers/OffersListView";
import {ClientsListView} from "../clients/ClientsListView";
import {OfferView} from "../offers/OfferView";
import {MainDashboard} from "./MainDashboard";

/* display contents*/
export const ContentView = () => {
    return(
        <Switch>
            <Switch>
                <Route path='/offers' exact component={ListOfferView} />
                <Route path='/clients' exact component={ClientsListView} />
                <Route path="/offers/:id" exact component={OfferView} />
            </Switch>
        </Switch>
    );
}
