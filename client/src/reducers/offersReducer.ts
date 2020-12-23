import {AnyAction} from "redux";
import {
    ADD_NEW_OFFER,
    FETCHING_OFFERS,
    LOAD_OFFERS_FAILURE,
    LOAD_OFFERS_SUCCESS
} from "../action_types/offer_action_types";

const initialOffersState = {
    loading: true,
    data: [],
    error: ''
};

export const offersReducer = (prevState: any = initialOffersState, action: AnyAction) => {
   switch (action.type) {
       case ADD_NEW_OFFER: {
           return {
               ...prevState, //prevstate holds all the data, as well about other models, so entire state should be copied here
               offers: [...prevState.offers, action.payload]
           }
       }
       case FETCHING_OFFERS: {
            return {
                ...prevState,
                loading: true
            }
       }
       case LOAD_OFFERS_SUCCESS: {
           return {
               loading: false,
               data: action.payload,
               error: ''
           }
       }

       case LOAD_OFFERS_FAILURE: {
            return {
                loading: false,
                data: [],
                error: action.payload
            }
       }
       default:
           return prevState;
   }
}

