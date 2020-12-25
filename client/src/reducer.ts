import {AnyAction, combineReducers} from "redux";

// register rest of the reducers
import { offers } from "./reducers/offersReducer";
import { clients } from "./reducers/clientsReducer";
import {AsyncFetchedDataState} from "./models/state/AsyncFetchedDataState";
import {Client} from "./models/Client";
import {Offer} from "./models/Offer";

export interface AppState {
    clients: AsyncFetchedDataState<Client>
    offers: AsyncFetchedDataState<Offer>
}

export default combineReducers({offers, clients});
