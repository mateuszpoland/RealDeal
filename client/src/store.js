import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';
import rootReducer from './reducer'

const store = createStore(rootReducer);

// get variables from store
console.log('Initial state: ', store.getState());
// fetch action
//store.dispatch()

export default store;
