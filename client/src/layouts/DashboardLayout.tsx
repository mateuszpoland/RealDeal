import React, {useState} from 'react';
import {AppBarTop} from "../components/AppBarTop";
import {Sidebar} from "../components/Sidebar";
import { createStyles,  makeStyles, useTheme, Theme } from '@material-ui/core/styles';
import {navLink} from "../App";
import {ContentView} from "../components/ContentView";

type DashboardComponentsList = {
    navigation: navLink[]
}

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        root: {
            display: 'flex',
        },
        toolbar: {
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'flex-end',
            padding: theme.spacing(0, 1),
            // necessary for content to be below app bar
            ...theme.mixins.toolbar,
        },
        content: {
            flexGrow: 1,
            padding: theme.spacing(3),
        },
    })
);

export const DashBoardLayout: React.FC<DashboardComponentsList> = (
    {
        navigation,
    }
) => {
    const handleSidebarToggle = () => {
        setSidebarOpen(!isSidebarOpen);
        console.log('changing state: ' + isSidebarOpen);
    }

    const [isSidebarOpen, setSidebarOpen] = useState(false);
    const classes = useStyles();
    /* parent component holding configuration for sidebar, appbar and so on */
    return(
        <div className={classes.root}>
            <AppBarTop
                handleSidebarToggle={handleSidebarToggle}
            />
            <Sidebar
                navLinks={navigation}
                isSidebarOpen={isSidebarOpen}
            />
            <main className={classes.content}>
                <div className={classes.toolbar}/>
                <ContentView />
            </main>
        </div>
    );
}