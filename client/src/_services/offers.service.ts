import { OfferRequestData } from '../models/Offer';

const API_ENDPOINT_FETCH_ALL_OFFERS = 'http://localhost/offers/all';
const API_ENDPOINT_FETCH_SINGLE_OFFER = 'http://localhost/offers/';

export const fetchOffers = async (): Promise<any> => {
    const response = await fetch(API_ENDPOINT_FETCH_ALL_OFFERS);
    if(!response.ok) {
        throw new Error(response.statusText);
    }
    return await response.json();
}

export const fetchSingleOfferObject = async (request: OfferRequestData) => {
    const id = request.doc_id;
    const response =  await fetch(API_ENDPOINT_FETCH_SINGLE_OFFER + id);
    if(!response.ok) {
        throw new Error(response.statusText);
    }
    return await response.json();
}
