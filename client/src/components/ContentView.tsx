import React from 'react';
import { BrowserRouter as Router, Route, Switch, Link } from "react-router-dom";
//import {ListOfferView} from "../views/offer/OffersListView";
import ListOfferView from "../views/offer/OffersListView";
import {ClientsListView} from "../views/client/ClientsListView";
import {OfferView} from "../views/offer/OfferView";

const Index = () => {
    return <h2>Witaj, Mateusz</h2>
}

/* display contents*/
export const ContentView = () => {
    return(
        <Switch>
            <Switch>
                <Route path="/" exact component={Index} />
                <Route path='/offers' exact component={ListOfferView} />
                <Route path='/clients' exact component={ClientsListView} />
                <Route path="/offers/:id" exact component={OfferView} />
            </Switch>
        </Switch>
    );
}
