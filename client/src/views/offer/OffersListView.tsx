import React, {useEffect, useState} from "react";
import {Offer, OfferAttributeKeys} from "../../models/Offer";
import {connect, useDispatch, useSelector} from "react-redux";
import {AppState} from "../../reducer";
import {fetchAllOffers} from "../../actions/offer";
import OffersTable from "../../components/Offer/OfferTable";

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
        const getOnlyColumnAttuributes = (value: string) => {
           const columnAttuributes = ['id', 'property_name', 'property_total_price', 'client_id', 'rooms']
           return (columnAttuributes.includes(value));
        }
        const columns = Object.keys(OfferAttributeKeys).filter(getOnlyColumnAttuributes).map((attibuteName: string) => {
           return {
               name: attibuteName,
               label: attibuteName.toUpperCase(),
               options: {
                   filter: true,
                   sort: true,
               }
           }
        });

        // @ts-ignore
        return(
            <OffersTable
                title={"Oferty"}
                data={offers}
                columns={columns}
            />
        );
    }
}

export default ListOfferView;
