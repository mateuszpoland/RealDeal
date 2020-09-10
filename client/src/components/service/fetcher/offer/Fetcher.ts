import { OfferRequestData } from '../../../../types/Offer';

// fake data - Offer details
import { fakeOffers } from '../../../../fake_data/FakeOffers';

const API_ENDPOINT_FETCH_ALL_OFFERS = 'http://realdeal.pl/offers/all';
const API_ENDPOINT_FETCH_SINGLE_OFFER = 'http://realdeal.pl/offers/';

export const fetchOffers = async () => {
    return await(await fetch(API_ENDPOINT_FETCH_ALL_OFFERS)).json();
}

export const fetchSingleOffer = async (request: OfferRequestData) => {
   const id = request.doc_id;
   return await(await fetch(API_ENDPOINT_FETCH_SINGLE_OFFER + id)).json();
}