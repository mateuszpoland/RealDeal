import {AnyAction, combineReducers} from "redux";

// register rest of the reducers
import { offers } from "./reducers/offersReducer";
import { clients } from "./reducers/clientsReducer";
import { payments } from "./reducers/payments/paymentsReducer";
import {AsyncFetchedDataState} from "./models/state/AsyncFetchedDataState";
import {Client} from "./models/Client";
import {Offer} from "./models/Offer";
import {brainTreeAuthTokenResponse} from "./models/payments/brainTreeAuthTokenResponse";

export interface AppState {
    clients: AsyncFetchedDataState<Client>
    offers: AsyncFetchedDataState<Offer>,
    payments: brainTreeAuthTokenResponse
}

export default combineReducers({offers, clients, payments});
