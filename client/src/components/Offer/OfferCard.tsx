import React from 'react';
import {Card, CardHeader, CardContent, Typography } from '@material-ui/core';
import {Offer} from "../../models/Offer";
import {Link} from "react-router-dom";

const OfferCard = (offer: any) => {
    const offerSerialized = offer['offer'];
   //console.log(offerSerialized);
    return (
        <li key={offerSerialized.doc_id} data-id={offer.id}>
            <h3>{offerSerialized.property_name}</h3>
            <p>Cena: {offer.property_total_price}</p>
            <strong>Zarządzaj ofertą: </strong><br/>
            <Link to={`/offers/${offer.doc_id}`}>Link</Link>
        </li>
    )
}

export default OfferCard;
