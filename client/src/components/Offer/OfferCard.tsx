import React from 'react';
import {Card, CardHeader, CardContent, Typography } from '@material-ui/core';
import {Offer} from "../../models/Offer";
import {Link} from "react-router-dom";

const OfferCard = (props: {
    offer: Offer
}): JSX.Element => {
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
