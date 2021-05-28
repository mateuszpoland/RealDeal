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

    const classes = useStyles();
    /* parent component holding configuration for sidebar, appbar and so on */
    return(
        <div className={classes.root}>
            <Sidebar
                isSidebarOpen={true}
            />
            <main className={classes.content}>
                <div className={classes.toolbar}/>
                <ContentView />
            </main>
        </div>
    );
}
