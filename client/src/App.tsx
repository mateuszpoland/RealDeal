import React from "react";
import { BrowserRouter as Router, Route, Switch, Link } from "react-router-dom";
import logo from './assets/logo-usd.svg';
import { Sidebar } from "./components/Sidebar";
import { OfferView } from "./views/offer/OfferView";
import { ListOfferView } from './views/offer/OffersListView';
import { ClientsListView } from "./views/client/ClientsListView";
import { navLink } from "./components/Sidebar";
import './App.css';
import { AppBarTop } from './components/AppBarTop';

const Index = () => {
  return <h2>Witaj, Mateusz</h2>
}

const App: React.FC = () => {
    const [open, setOpen] = React.useState(false);
    const sidebarNavLinks: navLink[] = [
        {
            text: 'Home',
            path: '/',
            icon: 'ion-ios-home'
        },
        {
            text: 'Lista Ofert',
            path: '/offers',
            icon: 'ion-ios-business'
        },
        {
            text: 'Klienci',
            path: '/clients',
            icon: 'ion-ios-briefcase'
        },
    ]


    return (
   <Router>
        <AppBarTop/>
        <Sidebar
            navLinks={sidebarNavLinks}
            logo={logo}
        />
        <Switch>
            <Route path="/" exact component={Index} />
            <Route path='/offers' exact component={ListOfferView} />
            <Route path='/clients' exact component={ClientsListView} />
            <Route path="/offers/:id" exact component={OfferView} />
        </Switch>
   </Router>
  );
}

export default App;
