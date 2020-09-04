import { OfferRequestData } from '../../../../types/Offer';

// fake data - Offer details
import { fakeOffers } from '../../../../fake_data/FakeOffers';

export const fetchOffers = async () => {
    const endpoint = 'http://localhost:8080/offers/all';
    const data = await(await fetch(endpoint)).json();
    return data;
}

export const fetchSingleOffer = async (request: OfferRequestData) => {
   const id = request.doc_id;
   let searchedOffer = null;
   fakeOffers.forEach((offer) => {
        if(offer.doc_id == id) searchedOffer = offer;
   });
   
   return searchedOffer;
}