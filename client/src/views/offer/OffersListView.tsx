import React, {useEffect, useState} from "react";
import {Offer, OfferAttributeKeys} from "../../models/Offer";
import { fetchOffers } from "../../components/service/fetcher/offer/Fetcher";
// try useSelector and useDispatch Redux hooks instead of custom fetcher.
import {connect, useDispatch, useSelector} from "react-redux";
import { Link, Route } from "react-router-dom";
import { AddNewOfferForm } from '../../components/form/offer/AddNewOfferForm';
import {AppState} from "../../reducer";
import {Dispatch} from "redux";
import {fetchAllOffers} from "../../actions/offer";
import OfferCard from "../../components/Offer/OfferCard";
import MUIDataTable from "mui-datatables";
import Collapse from '@material-ui/core/Collapse';
import TableRow from "@material-ui/core/TableRow";
import TableCell from "@material-ui/core/TableCell";
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

//export default connect(mapStateToProps, mapDispatchToProps)(ListOfferView);
export default ListOfferView;
