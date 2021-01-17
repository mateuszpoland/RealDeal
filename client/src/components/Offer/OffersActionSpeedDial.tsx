import React, {useState} from 'react';
import { makeStyles } from '@material-ui/core/styles';
import LaunchIcon from '@material-ui/icons/Launch';
import Button from '@material-ui/core/Button';
import SpeedDial from '@material-ui/lab/SpeedDial';
import SpeedDialIcon from '@material-ui/lab/SpeedDialIcon';
import SpeedDialAction from '@material-ui/lab/SpeedDialAction';
import FileCopyIcon from '@material-ui/icons/FileCopyOutlined';
import SaveIcon from '@material-ui/icons/Save';
import PrintIcon from '@material-ui/icons/Print';
import ShareIcon from '@material-ui/icons/Share';
import FavoriteIcon from '@material-ui/icons/Favorite';
import EditIcon from '@material-ui/icons/Edit';
import {SvgIconComponent} from "@material-ui/icons";
import {OverridableComponent} from "@material-ui/core/OverridableComponent";
import {SvgIcon} from "@material-ui/core";
import {SvgIconTypeMap} from "@material-ui/core/SvgIcon/SvgIcon";
import { SpeedDialActions } from './types';

const useStyles = makeStyles((theme) => ({
    root: {
        height: 380,
        transform: 'translateX(0px)',
        flexGrow: 1,
    },
    speedDial: {
        padding: '10px 10px'
    },
}));

const OffersActionSpeedDial = (props: {actions: Array<SpeedDialActions>}) => {
    const classes = useStyles();
    const [open, setOpen] = useState(false);
    const actions = props.actions;

    const handleOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    return (
        <SpeedDial
            ariaLabel={'Offer actions menu'}
            className={classes.speedDial}
            icon={<SpeedDialIcon openIcon={<LaunchIcon />} />}
            onClose={handleClose}
            direction={'right'}
            onOpen={handleOpen}
            open={open}
        >
            {actions.map((action) => (
                <SpeedDialAction
                    title={"Oferta"}
                    key={action.actionName}
                    icon={action.icon}
                    tooltipTitle={action.actionName}
                    onClick={action.clickActionHandler}
                />
            ))}
        </SpeedDial>
    );
}

export default OffersActionSpeedDial;
