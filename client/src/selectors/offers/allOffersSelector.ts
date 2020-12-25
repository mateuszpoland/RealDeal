import {AppState} from "../../reducer";

export const getAllOffers = (state: AppState) => {
    return [state.offers.data, state.offers.loading];
}
