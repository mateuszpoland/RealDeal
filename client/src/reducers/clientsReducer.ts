import {AnyAction} from "redux";
import {ADD_NEW_CLIENT, DELETE_CLIENT, LOAD_CLIENTS} from "../action_types/client_action_types";

const initialClientsState = {
    loading: true,
    data: [],
    error: ''
};

export const clientReducer = (prevState: any = initialClientsState, action: AnyAction) => {
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
