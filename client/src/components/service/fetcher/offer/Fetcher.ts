
export const fetchOffers = async () => {
    const endpoint = 'http://localhost:8080/offers/all';
    const data = await(await fetch(endpoint)).json();
    return data;
}