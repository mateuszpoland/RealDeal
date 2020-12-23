import React, {useEffect, useState} from "react";
import {Offer} from "../../models/Offer";
import { fetchOffers } from "../../components/service/fetcher/offer/Fetcher";
// try useSelector and useDispatch Redux hooks instead of custom fetcher.
//import { useSelector, useDispatch } from "react-redux";
import { Link, Route } from "react-router-dom";
import { AddNewOfferForm } from '../../components/form/offer/AddNewOfferForm';

type FetchingStatus = {
    isLoading: boolean
}

interface OfferQuery {
    term?: null
}

export const ListOfferView = () => {
    //state
    const [status, setStatus] = useState<FetchingStatus>({isLoading: true})
    const [offerQuery, setOfferQuery] = useState<OfferQuery>({term: null});
    const [offers, setOffers] = useState<Offer[]>([]);
    // fetch Offers
    useEffect(() => {
        const loadOffers = async() => {
            const offersSet = await fetchOffers().catch((error) => {
                console.log(error);
            });
            setOffers(offersSet);
            setStatus({isLoading: false});
        }
        loadOffers();
    }, []); // activate hook only on component mount

    // activate hook on queryterm change
    useEffect(() => {

    }, [offerQuery]);

    if(status.isLoading) {
        return (
            <p>pobieram oferty ...</p>
        );
    } else {
        return(
                <React.Fragment>
                    <h2>Widok ofert</h2>
                    <ul>
                        {offers.map(offer => (
                            <li key={offer.doc_id} data-id={offer.id}>
                                <h3>{offer.property_name}</h3>
                                <p>Cena: {offer.property_total_price}</p>
                                <strong>Szczegóły oferty: </strong><br/>
                                <Link to={`/offers/${offer.doc_id}`}>Link</Link>
                            </li>
                        ))}
                    </ul>

                    {/* add new  offer Form */}
                    <AddNewOfferForm />
                </React.Fragment>

        );
    }

}
