import React from 'react';
import {Card, CardHeader, CardContent, CardMedia, Typography } from '@material-ui/core';
import {Offer} from "../../models/Offer";
import {Link} from "react-router-dom";
import theme from "../../theme";
import { makeStyles, withStyles } from '@material-ui/core/styles';

const useStyles = makeStyles({
    root: {
        minWidth: 275,
    },
    bullet: {
        display: 'inline-block',
        margin: '0 2px',
        transform: 'scale(0.8)',
    },
    title: {
        fontSize: 14,
    },
    pos: {
        marginBottom: 12,
    },
});

const OfferCard = (props: {
    offer: Offer
}): JSX.Element => {
    const classes = useStyles();

    const offer = props.offer;
    return (
        <li key={offer.doc_id} data-id={offer.id}>
            <h3>{offer.property_name}</h3>
            <p>Cena: {offer.property_total_price}</p>
            <strong>Zarządzaj ofertą: </strong><br/>
            <Link to={`/offers/${offer.doc_id}`}>Link</Link>
        </li>
    )
}

export default OfferCard;
