import { OfferRequestData } from '../../../../types/Offer';
import { useQuery } from 'react-query';
const API_ENDPOINT_FETCH_ALL_OFFERS = 'http://localhost/offers/all';
const API_ENDPOINT_FETCH_SINGLE_OFFER = 'http://localhost/offers/';

export const fetchOffers = async () => {
    return await(await fetch(API_ENDPOINT_FETCH_ALL_OFFERS)).json();
}

export const fetchSingleOffer = async (request: OfferRequestData) => {
   const id = request.doc_id;
   return await(await fetch(API_ENDPOINT_FETCH_SINGLE_OFFER + id)).json();
}