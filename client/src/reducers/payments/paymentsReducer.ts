import {AnyAction} from "redux";
import {GET_CLIENT_AUTH_TOKEN} from "../../_action_types/payments/action_types";
import {brainTreeAuthTokenResponse} from "../../models/payments/brainTreeAuthTokenResponse";

interface paymentProcessState {
    authToken: string
}

const initialPaymentProcessState: brainTreeAuthTokenResponse  = {
    brainTreeAuthToken: null,
    error: null
}

export const payments = (prevState: any = initialPaymentProcessState, action: AnyAction)  => {
    switch (action.type) {
        case GET_CLIENT_AUTH_TOKEN: {
            return action.payload
        }
        default:
            return prevState;
    }
}
