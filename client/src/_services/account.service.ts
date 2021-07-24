import * as config from '../config/api.config.json';
import {api, checkResponse} from "./api.service";

export const Login = (username: string, password: string) => {
    return api.post(JSON.stringify({username, password}), 'user/signin_check')
        .then((resp) => {
            console.log('Rattattat');
            localStorage.setItem('token', resp.data.token);
            localStorage.setItem('refresh_token', resp.data.refresh_token);

            return resp.data;
        });
}

let refreshTokenTimeout;

export const startRefreshTokenTimer = (token) => {
    const decoded = JSON.parse(window.atob(token.split('.')[1]));
    const expiration = new Date(decoded.exp * 1000)
    // timeout on 1 minute before token expiration
    const timeout = expiration.getTime() - Date.now() - (60 * 1000);

    refreshTokenTimeout = setTimeout(refreshToken, timeout);
}

const stopRefreshTokenTimeout = () => {
    clearTimeout(refreshTokenTimeout);
}

export const refreshToken = () => {
    const refreshToken = localStorage.getItem('refresh_token');
    fetch(`${config.API_URL}token/refresh`)
        .then((resp) => checkResponse(resp))
        .then((data) => {
            startRefreshTokenTimer(data.token)
        });
}

export const Logout = () => {
    localStorage.removeItem('token');
}

