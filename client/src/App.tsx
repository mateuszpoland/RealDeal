import React from "react";
import { BrowserRouter as Router, Route, Switch, Link } from "react-router-dom";
import { OfferView } from "./views/offer/OfferView";
import { ListOfferView } from './views/offer/OffersListView';
import { ClientsListView } from "./views/client/ClientsListView";

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
                <li>
                    <Link to="/clients">Klienci</Link>
                </li>
            </ul>
         </nav>
        <Switch>
            <Route path="/" exact component={Index} />
            <Route path='/offers' exact component={ListOfferView} />
            <Route path='/clients' exact component={ClientsListView} />
            <Route path="/offers/:id" exact component={OfferView} />
        </Switch>
    </div>
   </Router>
  );
}

export default App;
