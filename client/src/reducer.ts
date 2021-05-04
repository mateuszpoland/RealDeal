import {AnyAction, combineReducers} from "redux";

// register rest of the reducers
import { offers } from "./reducers/offersReducer";
import { clients } from "./reducers/clientsReducer";
import { payments } from "./reducers/payments/paymentsReducer";
import { user } from "./reducers/account_management/user.reducer";
import {AsyncFetchedDataState} from "./models/state/AsyncFetchedDataState";
import {UserState} from "./models/state/UserState";
import {Client} from "./models/Client";
import {Offer} from "./models/Offer";
import {brainTreeAuthTokenResponse} from "./models/payments/brainTreeAuthTokenResponse";

export interface AppState {
    user: UserState
    clients: AsyncFetchedDataState<Client>
    offers: AsyncFetchedDataState<Offer>
    payments: brainTreeAuthTokenResponse
}

export default combineReducers({
    user,
    offers,
    clients,
    payments
});
