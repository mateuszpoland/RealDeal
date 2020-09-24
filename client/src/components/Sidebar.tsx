import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { createStyles, makeStyles, useTheme, Theme } from '@material-ui/core/styles';
import Drawer from '@material-ui/core/Drawer';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import List from '@material-ui/core/List';
import CssBaseline from '@material-ui/core/CssBaseline';
import Typography from '@material-ui/core/Typography';
import Divider from '@material-ui/core/Divider';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/icons/Menu';
import ChevronLeftIcon from '@material-ui/icons/ChevronLeft';
import ChevronRightIcon from '@material-ui/icons/ChevronRight';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import InboxIcon from '@material-ui/icons/MoveToInbox';
import MailIcon from '@material-ui/icons/Mail';

const drawerWidth = 240;

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        root: {
            display: 'flex',
        },
        appBar: {
            zIndex: theme.zIndex.drawer + 1,
            transition: theme.transitions.create(['width', 'margin']),
            duration: theme.transitions.duration.leavingScreen,
        },
        appBarShift: {
            marginLeft: drawerWidth,
            width: `calc(100% - ${drawerWidth}px)`,
            transition: theme.transitions.create(['width', 'margin'], {
                easing: theme.transitions.easing.sharp,
                duration: theme.transitions.duration.enteringScreen,
            }),
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

export type navLink = {
    text: string,
    path: string,
    icon: string
}

type SidebarProps = {
    navLinks: navLink[],
    logo: string
}
type navBarState = {
    isOpen: boolean
}
export const Sidebar: React.FC<SidebarProps> = (
    {
        navLinks,
        logo
    }) => {
    const classes = useStyles();
    const [navOpen, setNavOpen] = useState<navBarState>({isOpen: true});
    const [hoveredItemIndex, setHoveredItemIndex] = useState(-1);

    return(
        <div className={classes.root}>
            <CssBaseline/>
            <ul
            >
                <figure className="image-logo" onClick={ () => {
                    const isOpen = !navOpen.isOpen;
                    setNavOpen({isOpen: isOpen}) }
                }>
                    <img src={ logo } height="40px" width="40px" alt="toolbar-logo" />
                </figure>
                {navLinks.map((navLink, index) =>
                    <li
                        key={index}
                        onMouseEnter={ () => { setHoveredItemIndex(index) } }
                        onMouseLeave={ () => { setHoveredItemIndex(-1) } }
                    >
                        <Link
                            to={navLink.path}
                        >
                            {navLink.text}
                            <i className={navLink.icon}/>
                        </Link>
                    </li>
                )}
            </ul>
        </div>
    );
}