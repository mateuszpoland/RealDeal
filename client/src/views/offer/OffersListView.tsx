import React, {useEffect, useState} from "react";
import {Offer} from "../../models/Offer";
import { fetchOffers } from "../../components/service/fetcher/offer/Fetcher";
// try useSelector and useDispatch Redux hooks instead of custom fetcher.
import {connect, useDispatch, useSelector} from "react-redux";
import { Link, Route } from "react-router-dom";
import { AddNewOfferForm } from '../../components/form/offer/AddNewOfferForm';
import {AppState} from "../../reducer";
import {getAllOffers} from "../../selectors/offers/allOffersSelector";
import {Dispatch} from "redux";
import {fetchAllOffers} from "../../actions/offer";

type FetchingStatus = {
    isLoading: boolean
}

interface OfferQuery {
    term?: null
}


const ListOfferView: React.FC = () => {
    //derive state form useSelector hook
    const [offers, isListLoading] = useSelector((state: AppState) => [state.offers.data, state.offers.loading]);
    const dispatch = useDispatch();
    //state
    const [offerQuery, setOfferQuery] = useState<OfferQuery>({term: null});

    // fetch Offers
    useEffect(() => {
        dispatch(fetchAllOffers())
    }, [dispatch])

    if(isListLoading) {
        return (
            <p>pobieram oferty ...</p>
        );
    } else {
        return(
                <React.Fragment>
                    <h2>Twoje oferty</h2>
                    <ul>
                        {offers.map((offer: Offer) => (
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

//export default connect(mapStateToProps, mapDispatchToProps)(ListOfferView);
export default ListOfferView;
