import React, {useState} from 'react';
import { Navbar } from "../app/Navbar";
import {Sidebar} from "./Sidebar";
import { createStyles,  makeStyles, useTheme, Theme } from '@material-ui/core/styles';
import {ContentView} from "./ContentView";

const useStyles = makeStyles((theme) =>
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

export const Dashboard = () => {
    const [isSidebarOpen, setSidebarOpen] = useState(true);

    const handleSidebarToggle = () => {
        setSidebarOpen(!isSidebarOpen);
    }

    const classes = useStyles();
    return(
        <div className={classes.root}>
            <Navbar handleSidebarToggle={handleSidebarToggle} />
            <Sidebar
                isSidebarOpen={isSidebarOpen}
            />
            <div className={classes.content}>
                <div className={classes.toolbar}/>
                <div>
                    <ContentView/>
                </div>
            </div>
        </div>
    );
}
