import axios from "axios";
import * as config from '../config/api.config.json';
import {Logout} from "./account.service";

export const authHeader = () => {
    let token = localStorage.getItem('token');

    if(!(token)) {
        return {};
    }

    return { 'Authorization': 'Bearer ' + token }
}

axios.interceptors.request.use((config) => {
    const accessToken = localStorage.getItem('token');
    config.headers['Content-Type'] = 'application/json';

    if(accessToken) {
        config.headers['Authorization'] = 'Bearer ' + accessToken;
    }

   return config;
}, error => Promise.reject(error));

axios.interceptors.response.use((response) => {
    return response
}, (error) => {
    const originalRequest = error.config;
    let refreshToken = localStorage.getItem('refresh_token');

    if(refreshToken && error.response.status == 401 && !originalRequest._retry) {
        originalRequest._retry = true;
        return axios
            // add body to the request
            .post(`${config.API_URL}/token/refresh`)
            .then((resp) => {
                if(resp.status == 200) {
                    localStorage.setItem('refresh_token', resp.data.refresh_token);
                    localStorage.setItem('token', resp.data.token);
                    console.log('Refreshing token: ', resp.data.refresh_token);

                    return axios(originalRequest);
                }
            })
    }
    return Promise.reject(error);
});

export const api = {
    post: (body: Object, url: string) => {
        return axios.post(`${config.API_URL}${url}`, body)
    },
    get: (url: string) => {
        return axios.get(`${config.API_URL}${url}`)
    }
}

export const checkResponse = async (resp: Response) => {
    const respJson = await resp.json();
    if(!resp.ok) {
        if(resp.status == 401) {
            Logout();
            window.location.reload();
        }
        const error = (respJson && respJson.message) || resp.statusText;
        return Promise.reject(error);
    }

    return respJson;
}


