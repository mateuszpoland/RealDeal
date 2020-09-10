import React, { useState, useEffect } from "react";
import { fetchOffers, fetchSingleOffer } from './components/service/fetcher/offer/Fetcher';
import { BrowserRouter as Router, Route, Switch, Redirect, Link, RouteComponentProps, RouteProps } from "react-router-dom";
import { Offer, OfferRequestData } from './types/Offer';
import { OfferView } from "./views/offer/OfferView";
import { ListOfferView } from './views/offer/OffersListView';

const Index = () => {
  return <h2>Witaj, Mateusz</h2>
}

const App: React.FC = () => {
    return (
   <Router>
    <div>
        <nav>
            <ul>
                <li>
                    <Link to="/">Home</Link>
                </li>
                <li>
                    <Link to="/offers">Oferty</Link>
                </li>
            </ul>
         </nav>
        <Switch>
            <Route path="/" exact component={Index} />
            <Route path='/offers' exact component={ListOfferView} />
            <Route path="/offers/:id" exact component={OfferView} />
        </Switch>
    </div>
   </Router>
  );
}

export default App;
