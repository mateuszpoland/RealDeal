import {
    FETCHING_OFFERS,
    ADD_NEW_OFFER,
    DELETE_OFFER,
    LOAD_OFFERS_SUCCESS, LOAD_OFFERS_FAILURE, FETCHING_SINGLE_OFFER
} from '../action_types/offer_action_types';
import {Offer} from "../models/Offer";
import {Dispatch} from "redux";
import {fetchOffers, fetchSingleOfferObject} from "../components/service/fetcher/offer/Fetcher";
import store from "../store";

const handleErrors = (dispatch: Dispatch, error: Error) => {
    dispatch(loadOffersFailure(error));
}

// async action using thunk middleware
export const fetchAllOffers = () => {
    return async (dispatch: Dispatch) => {
        await dispatch(fetchingOffers());

        try {
            const offerList = await fetchOffers();
            dispatch(loadOffersSuccess(offerList));
        } catch (error) {
            handleErrors(dispatch, error);
        }
    }
}


/**
 * fetch single offer object
 * use if there is no object in array in redux store
 */
export const fetchSingleOffer = (id: string) => {
    return async (dispatch: Dispatch) => {
        await dispatch(fetchingOffers());

        try {
            const offer = await fetchSingleOfferObject({doc_id: id})
            dispatch(loadOffersSuccess(offer));
        } catch (error) {
            handleErrors(dispatch, error);
        }
    }
}

export const fetchingOffers = () => {
    return {
        type: FETCHING_OFFERS
    }
}

export const loadOffersSuccess = (offersList: Offer[]) => {
    return {
        type: LOAD_OFFERS_SUCCESS,
        payload: offersList
    }
}

export const loadOffersFailure = (errors: any) => {
    return {
        type: LOAD_OFFERS_FAILURE,
        payload: errors
    }
}

// check if this function actually returns something
export const addNewOffer = (payload: Offer) => {
    return {
        type: ADD_NEW_OFFER,
        payload: payload
    }
};

// subscribe to store
//store.subscribe()

