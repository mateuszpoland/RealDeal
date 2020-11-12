import React, {useEffect, useState} from "react";
import FormControl from '@material-ui/core/FormControl';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import TextField from '@material-ui/core/TextField';

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        root: {
            '& > *': {
                margin: theme.spacing(1),
                width: '25ch',
            },
        },
    }),
);

export const OfferForm = () => {
    const classes = useStyles();
    return (
        <div>
            <p>Dodaj ofertę</p>
            <FormControl>
                <form className={classes.root}>
                    <TextField id="offer-name" label="Nazwa" variant="outlined" />
                    <TextField
                        id="offer-total-price"
                        label="Cena"
                        type="number"
                        InputLabelProps={{
                            shrink: true,
                        }}
                    />
                    <TextField
                        id="offer-footage"
                        label="Powierzchnia"
                        type="number"
                        InputLabelProps={{
                            shrink: true,
                        }}
                    />
                </form>
            </FormControl>
        </div>
    );
}
