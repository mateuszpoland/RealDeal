import React, {useEffect, useState} from 'react';
import { Link } from 'react-router-dom';
import clsx from 'clsx';
import { createStyles, makeStyles, useTheme, Theme } from '@material-ui/core/styles';
import Drawer from '@material-ui/core/Drawer';
import List from '@material-ui/core/List';
import CssBaseline from '@material-ui/core/CssBaseline';
import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import HomeRoundedIcon from "@material-ui/icons/HomeRounded";
import BusinessCenterRoundedIcon from "@material-ui/icons/BusinessCenterRounded";
import PermContactCalendarRoundedIcon from "@material-ui/icons/PermContactCalendarRounded";
import FitnessCenter from "@material-ui/icons/FitnessCenter";

const drawerWidth = 180;

const useStyles = makeStyles((theme) =>
    createStyles({
        root: {
            display: 'flex',
        },
        "& a": {
            textDecoration: 'none',
        },
        menuButton: {
            marginRight: 36,
        },
        hide: {
            display: 'none',
        },
        drawer: {
            width: drawerWidth,
            flexShrink: 0,
            whiteSpace: 'nowrap',
        },
        drawerOpen: {
            width: drawerWidth,
            transition: theme.transitions.create('width', {
                easing: theme.transitions.easing.sharp,
                duration: theme.transitions.duration.enteringScreen,
            }),
        },
        drawerClose: {
            transition: theme.transitions.create('width', {
                easing: theme.transitions.easing.sharp,
                duration: theme.transitions.duration.leavingScreen,
            }),
            overflowX: 'hidden',
            width: theme.spacing(7) + 1,
            [theme.breakpoints.up('sm')]: {
                width: theme.spacing(9) + 1,
            },
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

export const Sidebar = ({isSidebarOpen}) => {
    // instead of isSidebarOpen as a dependency, use RxJS and use toggling on message


    const classes = useStyles();
    const theme = useTheme();

    const navLinks = [
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

    useEffect((() => {
        console.log('inside sidebar: ' + isSidebarOpen);
    }), [isSidebarOpen]);

    return(
        <div className={classes.root}>
            <CssBaseline/>
            <Drawer
                variant="permanent"
                className={clsx(classes.drawer, {
                    [classes.drawerOpen]: isSidebarOpen,
                    [classes.drawerClose]: !isSidebarOpen,
                })}
                classes={{
                    paper: clsx({
                        [classes.drawerOpen]: isSidebarOpen,
                        [classes.drawerClose]: !isSidebarOpen,
                    }),
                }}
            >
                <Divider />
                <div className={classes.toolbar}/>
                <List>
                    {navLinks.map((navLink, index) => (
                        <ListItem button key={index}>
                            <Link to={navLink.path}>
                                <ListItemIcon>{navLink.icon}</ListItemIcon>
                                {navLink.text}
                            </Link>
                        </ListItem>
                    ))}
                </List>
                <Divider />
            </Drawer>
        </div>
    );
}
