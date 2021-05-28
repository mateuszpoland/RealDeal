import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';
import { createLogger } from 'redux-logger';
import rootReducer from './reducer'
import {fetchAllOffers} from "./actions/offer.actions";


const logger = createLogger({});
const store = createStore(rootReducer, applyMiddleware(thunk,logger));

// get variables from store
console.log('Initial state: ', store.getState());
// fetch action
store.dispatch(fetchAllOffers());

console.log('Next state: ', store.getState());
export default store;
