import {LOGIN_REQUEST, LOGIN_SUCCESS, LOGIN_FAILURE, LOGOUT} from "../_action_types/user.action_types";
import {Dispatch} from "redux";
import {history} from "../_helpers/history";
import * as userService from '../_services/account.service';

export const login = (username: string, password: string, from) => {
    return (dispatch: Dispatch) => {
        dispatch(request())

        userService.login(username, password)
            .then(resp => {
                const token = resp.token;
                const refreshToken = resp.refresh_token;
                history.push(from);
                userService.startRefreshTokenTimer(token);
                dispatch(success({token: token, refreshToken: refreshToken}))
                window.location.reload();
            })
            .catch(error => dispatch(failure(error)));
    }
}

export const logout = () => {
    userService.logout();
    return { type: LOGOUT };
}



const request = () => { return { type: LOGIN_REQUEST } }
const success = (tokens: Object) => { return {type: LOGIN_SUCCESS, tokens: tokens} }
const failure = (error: Object) => { return {type: LOGIN_FAILURE, error} }
