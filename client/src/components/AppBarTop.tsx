import React from 'react';
import clsx from 'clsx';
import { createStyles, makeStyles, useTheme, Theme } from '@material-ui/core/styles';
import { DrawerSettings } from './DashboardSettings';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import {icon} from "@fortawesome/fontawesome-svg-core";
import Typography from '@material-ui/core/Typography';
import MenuIcon from '@material-ui/icons/Menu';

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        appBar: {
            height: '8vh',
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

export type clickCallbackFunction = {
    (): void
}

export interface AppBarTopInterface {
}

export const AppBarTop: React.FC<AppBarTopInterface> = () => {
    const classes = useStyles();
    const [open, setOpen] = React.useState(false);
    return (
        <AppBar
            position="fixed"
            className={clsx(classes.appBar, {
                [classes.appBarShift]: open,
            })}
        >
            {/* split toolbar to separate component */}
            <Toolbar>
                <IconButton
                    color="inherit"
                    aria-label="open drawer"
                    onClick={() => {console.log('open drawer')}}
                    edge="start"
                    className={clsx(classes.menuButton, {
                        [classes.hide]: open,
                    })}
                >
                    <MenuIcon />
                </IconButton>
                <Typography variant="h6" noWrap>
                    RealDeal
                </Typography>
            </Toolbar>
        </AppBar>
    );
}