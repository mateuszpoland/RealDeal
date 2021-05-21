import React from "react";
import { BrowserRouter as Router, Route, Switch, Link } from "react-router-dom";
import './App.css';
import HomeRoundedIcon from '@material-ui/icons/HomeRounded';
import BusinessCenterRoundedIcon from '@material-ui/icons/BusinessCenterRounded';
import PermContactCalendarRoundedIcon from '@material-ui/icons/PermContactCalendarRounded';
import FitnessCenter from '@material-ui/icons/FitnessCenter';
import {HTML5Backend}  from 'react-dnd-html5-backend';
import {DashBoardLayout} from "./layouts/DashboardLayout";
import {DndProvider} from "react-dnd";
import {useSelector} from "react-redux";
import {AppState} from "./reducer";
import {RegisterPage} from "./layouts/RegisterPage/RegisterPage";

export type navLink = {
    text: string,
    path: string,
    icon: JSX.Element
}

const App: React.FC = () => {
    // just for tests
    const isLogged = false;
    const [isUserLoggedIn, userData] = useSelector(
        (state: AppState) => [state.user.isUserLoggedIn, state.user.userData]
    )
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
        {
            text: 'Sprzedaż',
            path: '/sell',
            icon: <FitnessCenter/>
        }
    ]

    // @ts-ignore
    return (
        <Router>
            {isLogged
                ?
                <DndProvider backend={HTML5Backend}>
                    <DashBoardLayout
                        navigation={sidebarNavLinks}
                        //user={userData}
                    />
                </DndProvider>
                :
                <RegisterPage />
            }
        </Router>
  );
}

export default App;
