import {AnyAction} from "redux";
import {UserState} from "../models/state/UserState";
import {
    LOGIN_REQUEST,
    LOGIN_FAILURE,
    LOGIN_SUCCESS,
    LOGOUT
} from "../_action_types/user.action_types";

const token = localStorage.getItem('token');

const initialUserState: UserState = {
    isSigningIn: !!(token),
    token: token
}

export const user = (prevState: any = initialUserState, action: AnyAction)  => {
    switch (action.type) {
        case LOGIN_REQUEST:
            return {
                isSigningIn: true,
                token: null
            }
        case LOGIN_SUCCESS:
            return {
                isSigningIn: false,
                token: action.token
            }
        case LOGIN_FAILURE:
            return {
                isSigningIn: false,
                token: null
            }
        case LOGOUT:
            return {
                isSigningIn: false,
                token: null
            }
        default:
            return prevState;
    }
}
