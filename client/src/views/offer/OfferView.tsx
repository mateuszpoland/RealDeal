import {RouteComponentProps} from "react-router";
import React, {PropsWithChildren, useEffect, useState} from "react";
// fake offers for test
import {FakeOffer} from "../../fake_data/FakeOffers";
import {OfferRequestData} from "../../models/Offer";
import {fetchSingleOffer} from "../../components/service/fetcher/offer/Fetcher";

export interface RouteInfo extends RouteComponentProps<{ id: string }> {}

export const OfferView: React.FC<RouteInfo> =  ({match}) => {
    const [offer, setOffer] = useState<FakeOffer|undefined>();
    useEffect(() => {
        const loadSingleOffer = async() => {
            const request: OfferRequestData = { doc_id: match.params.id };
            const offer: FakeOffer|undefined = await fetchSingleOffer(request);
            setOffer(offer);
        }
        loadSingleOffer();
    }, []);

    if(offer != undefined) {
        console.log(Object.values(offer)[0]);
        const offerVal: any = Object.values(offer)[0];
        return(
            <React.Fragment>
                <h2>Detale oferty:</h2>
                <p><strong>ID: </strong>{offerVal.doc_id}</p>
                <p><strong>Nazwa: </strong></p>
                <p>{offerVal.property_name}</p>
                <p><strong>Cena całkowita: </strong></p>
                <p>{offerVal.property_total_price} PLN</p>
                <p><strong>Klient: </strong>{offerVal.client_id}</p>
                <p><strong>Liczba pokoi: </strong>{offerVal.rooms}</p>
            </React.Fragment>
        );
    }
    return <p>Loading offer..</p>
    //@todo -  else return loading spinner
}
