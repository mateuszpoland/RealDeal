import React from "react";
import { BrowserRouter as Router, Route, Switch, Link } from "react-router-dom";
import logo from './assets/logo-usd.svg';
import { Sidebar } from "./components/Sidebar";
import { OfferView } from "./views/offer/OfferView";
import { ListOfferView } from './views/offer/OffersListView';
import { ClientsListView } from "./views/client/ClientsListView";
import './App.css';
import { AppBarTop } from './components/AppBarTop';
import HomeRoundedIcon from '@material-ui/icons/HomeRounded';
import BusinessCenterRoundedIcon from '@material-ui/icons/BusinessCenterRounded';
import PermContactCalendarRoundedIcon from '@material-ui/icons/PermContactCalendarRounded';
import {SvgIconComponent} from "@material-ui/icons";
import {OverridableComponent} from "@material-ui/core/OverridableComponent";
import {SvgIconTypeMap} from "@material-ui/core";
import SvgIcon from "@material-ui/icons/HomeRounded";
import {DashBoardLayout} from "./layouts/DashboardLayout";

const Index = () => {
  return <h2>Witaj, Mateusz</h2>
}

export type navLink = {
    text: string,
    path: string,
    icon: JSX.Element
}



const App: React.FC = () => {
    const [open, setOpen] = React.useState(false);
    const sidebarNavLinks: navLink[] = [
        {
            text: 'Home',
            path: '/',
            icon: <HomeRoundedIcon />
        },
        {
            text: 'Lista Ofert',
            path: '/offers',
            icon: <BusinessCenterRoundedIcon />
        },
        {
            text: 'Klienci',
            path: '/clients',
            icon: <PermContactCalendarRoundedIcon />
        },
    ]

    return (
   <Router>
       <DashBoardLayout
            navigation={sidebarNavLinks}
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
