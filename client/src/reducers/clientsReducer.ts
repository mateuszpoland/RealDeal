import {AnyAction} from "redux";
import {ADD_NEW_CLIENT, DELETE_CLIENT, LOAD_CLIENTS} from "../_action_types/client.action_types";
import {AsyncFetchedDataState} from "../models/state/AsyncFetchedDataState";
import {Client} from "../models/Client";

const initialClientsState: AsyncFetchedDataState<Client> = {
    loading: true,
    data: [],
    error: ''
};

export const clients = (prevState: any = initialClientsState, action: AnyAction) => {
    switch(action.type) {
        case ADD_NEW_CLIENT: {
            return null;
        }
        case DELETE_CLIENT: {
            return null;
        }
        case LOAD_CLIENTS: {
            return null;
        }
        default:
            return prevState;
    }
}
