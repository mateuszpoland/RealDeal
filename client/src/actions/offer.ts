import {
    LOAD_OFFERS,
    ADD_NEW_OFFER,
    DELETE_OFFER,
    LOAD_OFFERS_SUCCESS, LOAD_OFFERS_FAILURE
} from '../action_types/offer_action_types';
import {Offer} from "../models/Offer";

export const loadOffers = () => {
    return {
        type: LOAD_OFFERS
    }
}

export const loadOffersSuccess = (offersList: Offer[]) => {
    return {
        type: LOAD_OFFERS_SUCCESS,
        payload: offersList
    }
}

export const loadOfferFailure = (errors: any) => {
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
