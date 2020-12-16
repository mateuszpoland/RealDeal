import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';
import { createLogger } from 'redux-logger';
import rootReducer from './reducer'

const logger = createLogger({});
const store = createStore(rootReducer, applyMiddleware(logger));

// get variables from store
console.log('Initial state: ', store.getState());
// fetch action
//store.dispatch()

export default store;
