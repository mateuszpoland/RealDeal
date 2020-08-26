import React, { useState, useEffect } from "react";
import { fetchOffers } from './components/service/fetcher/offer/Fetcher';
import { BrowserRouter as Router, Route, Switch, Redirect, Link } from "react-router-dom";
import { Offer } from './types/Offer';

const App = () => {
  //state
  const [offers, setOffers] = useState<Offer[]>([]);
  // fetch Offers
  useEffect(() => {
    loadOffers();
  });

  const loadOffers = async() => {
    const offersSet = await fetchOffers();
    setOffers(offersSet);
  }

  return (
    <React.Fragment>
      <h2>Widok ofert</h2>
      <ul>
        {offers.map(offer => (
          <li key={offer.doc_id} data-id={offer.id}>
            <h3>{offer.property_name}</h3>
            <p>Price: {offer.property_total_price}</p>
          </li>
        ))}
      </ul>
    </React.Fragment>
  );
}

export default App;
