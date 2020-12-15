import {
    LOAD_OFFERS,
    ADD_NEW_OFFER,
    DELETE_OFFER
} from '../action_types/offer_action_types';
import {Offer} from "../models/Offer";

export const loadOffers = (payload: Offer[]) => ({
    type: LOAD_OFFERS,
    payload: payload
})

// check if this function actually returns something
export const addNewOffer = (payload: Offer) => ({
    type: ADD_NEW_OFFER,
    payload: payload
});
