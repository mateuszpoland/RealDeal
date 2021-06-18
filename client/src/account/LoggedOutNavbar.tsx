import React from 'react';
import clsx from 'clsx';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import { DrawerSettings } from '../components/DashboardSettings';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        appBar: {
            zIndex: theme.zIndex.drawer + 1,
            transition: theme.transitions.create(['width', 'margin']),
            duration: theme.transitions.duration.leavingScreen,
        },
        appBarShift: {
            marginLeft: DrawerSettings.desktop.width,
            width: `calc(100% - ${DrawerSettings.desktop.width}px)`,
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
    })
);

export const LoggedOutNavbar: React.FC = () => {
    const classes = useStyles();
    return (
        <AppBar
            position="fixed"
            className={clsx(classes.appBar, {
            })}
        >
            {/* split toolbar to separate component */}
            <Toolbar>
                <Typography variant="h6" noWrap>
                    RealDeal
                </Typography>
            </Toolbar>
        </AppBar>
    );
}
