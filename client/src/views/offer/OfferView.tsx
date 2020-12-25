import {RouteComponentProps} from "react-router";
import React, {PropsWithChildren, useEffect, useState} from "react";
import {useDispatch, useSelector} from "react-redux";
import { AppState } from "../../reducer";
import {fetchSingleOffer} from "../../actions/offer";

export interface RouteInfo extends RouteComponentProps<{ id: string }> {}

// @ts-ignore
export const OfferView: React.FC<RouteInfo> =  ({match}) => {
    const [offer, isLoading] = useSelector((state:AppState) => state.offers.data.filter((offer, key) => {
         if(offer.doc_id == match.params.id) return[ offer, state.offers.loading ]; }
    ));
    const dispatch = useDispatch();
    /*
    //const [offer, setOffer] = useState<FakeOffer|undefined>();
    useEffect(() => {
        console.log('all offers' + offer);
        const loadSingleOffer = async() => {
            const request: OfferRequestData = { doc_id: match.params.id };
            const offer: FakeOffer|undefined = await fetchSingleOfferObject(request);
            setOffer(offer);
        }
        loadSingleOffer();
    }, []);
    */

    useEffect(() => {
        dispatch(fetchSingleOffer(match.params.id))
    }, [dispatch]);

    // logic to fix - code situation where offer was not found because it does not exist (based on http return code)
    if(isLoading || offer == undefined) {
        return (
            <p>trwa ładowanie oferty...</p>
        );
    } else {
        return(
            <React.Fragment>
                <h2>Detale oferty:</h2>
                <p><strong>ID: </strong>{offer.doc_id}</p>
                <p><strong>Nazwa: </strong></p>
                <p>{offer.property_name}</p>
                <p><strong>Cena całkowita: </strong></p>
                <p>{offer.property_total_price} PLN</p>
                <p><strong>Klient: </strong>{offer.client_id}</p>
                <p><strong>Liczba pokoi: </strong>{offer.rooms}</p>
            </React.Fragment>
        );
    }
}
