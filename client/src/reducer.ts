import {AnyAction, combineReducers} from "redux";

// register rest of the reducers
import { offersReducer } from "./reducers/offersReducer";
import { clientReducer } from "./reducers/clientsReducer";

export default combineReducers({offersReducer, clientReducer});
