import {
    GET_CLIENT_AUTH_TOKEN,
    NO_CLIENT_TOKEN
} from "../../_action_types/payments/action_types";
import {Dispatch} from "redux";
import {brainTreeAuthTokenResponse} from "../../models/payments/brainTreeAuthTokenResponse";

const API_ENDPOINT_FETCH_BRAINTREE_CLIENT_TOKEN = 'http://api.realdeal.pl/user/account/buy_account';

export const fetchClientToken = () => {
    return async(dispatch: Dispatch) => {
        try {
            const response = await fetch(API_ENDPOINT_FETCH_BRAINTREE_CLIENT_TOKEN);
            if(!response.ok) {
                throw new Error(response.statusText);
            }
            let token = await response.json();
            const braintreeTokenResponse: brainTreeAuthTokenResponse = {
                brainTreeAuthToken: token,
                error: null
            }
            dispatch(fetchingBraintreeTokenSuccess(braintreeTokenResponse))
        } catch (error) {
            dispatch(fetchingBraintreeTokenFailure(error))
        }
    }
}

export const fetchingBraintreeTokenSuccess = (payload: brainTreeAuthTokenResponse) => {
    return {
        type: GET_CLIENT_AUTH_TOKEN,
        payload: payload
    }
}

export const fetchingBraintreeTokenFailure = (error: any) => {
    const payload: brainTreeAuthTokenResponse = {
        brainTreeAuthToken: null,
        error: error
    }
    return {
        type: NO_CLIENT_TOKEN,
        payload: payload
    }
}
