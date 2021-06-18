import { OfferRequestData } from '../models/Offer';
import * as config from '../config/api.config.json';
import {authHeader} from "./api.service";

const headers = {}

export const fetchOffers = async (): Promise<any> => {
    const response = await fetch(
        `${config.API_URL}offers`, {
            method: 'GET',
            headers: headerBag()
        }
    );
    if(!response.ok) {
        throw new Error(response.statusText);
    }
    return await response.json();
}

export const fetchSingleOfferObject = async (request: OfferRequestData) => {
    const id = request.doc_id;
    const response =  await fetch(`${config.API_URL}offers/${id}`, {
        method: 'GET',
        headers: headerBag()
    });
    if(!response.ok) {
        throw new Error(response.statusText);
    }

    return await response.json();
}

const headerBag = () => {
    return { ...authHeader(), ...headers}
}
