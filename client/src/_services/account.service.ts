import * as config from '../config/api.config.json';

export const authenticationHeader = () => {
    let user = JSON.parse(localStorage.getItem('user'));

    if(!(user && user.token)) {
        return {};
    }

    return { 'Authorization': 'Bearer ' + user.token }
}
