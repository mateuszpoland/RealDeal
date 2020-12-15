import React, {useEffect, useState} from "react";
import FormControl from '@material-ui/core/FormControl';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import TextField from '@material-ui/core/TextField';
// connect to store to add new Offer to the state
import { connect } from 'react-redux';

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

export const AddNewOfferForm = () => {
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
                                                                // action
//export default connect(null, { addNewOffer })(AddNewOfferForm)
