import React from "react";
import { BrowserRouter as Router, Route, Switch, Link } from "react-router-dom";
import { OfferView } from "./views/offer/OfferView";
import { ListOfferView } from './views/offer/OffersListView';
import { ClientsListView } from "./views/client/ClientsListView";
import './App.css';
import HomeRoundedIcon from '@material-ui/icons/HomeRounded';
import BusinessCenterRoundedIcon from '@material-ui/icons/BusinessCenterRounded';
import PermContactCalendarRoundedIcon from '@material-ui/icons/PermContactCalendarRounded';
import {DashBoardLayout} from "./layouts/DashboardLayout";

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
   </Router>
  );
}

export default App;
