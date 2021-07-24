import {LOGIN_REQUEST, LOGIN_SUCCESS, LOGIN_FAILURE, LOGOUT} from "../_action_types/user.action_types";
import {Dispatch} from "redux";
import * as userService from '../_services/account.service';

export const Login = (username: string, password: string) => {
    return (dispatch: Dispatch) => {
        dispatch(request())

        userService.Login(username, password)
            .then(resp => {
                const token = resp.token;
                const refreshToken = resp.refresh_token;
                userService.startRefreshTokenTimer(token);
                dispatch(success({token: token, refreshToken: refreshToken}))
            })
            .catch(error => dispatch(failure(error)));
    }
}

export const Logout = () => {
    userService.Logout();
    return { type: LOGOUT };
}



const request = () => { return { type: LOGIN_REQUEST } }
const success = (tokens: Object) => { return {type: LOGIN_SUCCESS, tokens: tokens} }
const failure = (error: Object) => { return {type: LOGIN_FAILURE, error} }
