import React, {useEffect, useState} from "react";
import {Offer} from "../../types/Offer";
import { fetchOffers } from "../../components/service/fetcher/offer/Fetcher";
import { Link, Route } from "react-router-dom";
import { Switch, BrowserRouter as Router } from 'react-router-dom';
import { OfferView } from "./OfferView";

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
            const offersSet = await fetchOffers();
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
            <Router>

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
                </React.Fragment>
                <Switch>
                    <Route path="/offers/:id" exact component={OfferView} />
                </Switch>
            </Router>
        );
    }

}