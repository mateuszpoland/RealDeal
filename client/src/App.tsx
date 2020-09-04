import React, { useState, useEffect } from "react";
import { fetchOffers, fetchSingleOffer } from './components/service/fetcher/offer/Fetcher';
import { BrowserRouter as Router, Route, Switch, Redirect, Link, RouteComponentProps } from "react-router-dom";
import { Offer, OfferRequestData } from './types/Offer';
// fake offers for test
import { FakeOffer } from './fake_data/FakeOffers';


const Index = () => {
  return <h2>Witaj, Mateusz</h2>
}

const ListOfferView = (offers: Offer[]) => {
  return(
    <React.Fragment>
      <h2>Widok ofert</h2>
      <ul>
        {offers.map(offer => (
          <li key={offer.doc_id} data-id={offer.id}>
            <h3>{offer.property_name}</h3>
            <p>Cena: {offer.property_total_price}</p>
            <strong>Szczegóły oferty: </strong><br/>
            <Link to={`/offers/:${offer.doc_id}`}/>
          </li>
        ))}
      </ul>
  </React.Fragment>
  );
}

type TParams = { doc_id: string };

const SingleOfferView = ({match}: RouteComponentProps<TParams>) => {
  const [offer, setOffer] = useState<FakeOffer|undefined|null>();
  useEffect(() => {
    const loadSingleOffer = async() => {
      const request: OfferRequestData = { doc_id: match.params.doc_id };
      const offer: FakeOffer|null = await fetchSingleOffer(request);
      setOffer(offer);
    }
    loadSingleOffer();
  }, []);
  
  if(offer != undefined || offer != null) {
    return(
      <React.Fragment>
        <h2>Detale oferty:</h2>
        <p><strong>ID: </strong>{offer.doc_id}</p>
        <p><strong>Nazwa: </strong></p>
        <p>{offer.property_name}</p>
        <p><strong>Cena całkowita: </strong></p>
        <p>{offer.total_price}</p>
        <p><strong>Klient: </strong>{offer.client}</p>
        <p><strong>Liczba pokoi: </strong>{offer.rooms}</p>
      </React.Fragment>
    );
  }
  //@todo -  else return loading spinner
}

const App = () => {
  //state
  const [offers, setOffers] = useState<Offer[]>([]);
  // fetch Offers
  useEffect(() => {
    const loadOffers = async() => {
      const offersSet = await fetchOffers();
      setOffers(offersSet);
    }
    loadOffers();
  }, []); // activate hook only on component mount

  return (
    /*
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
    */
   <Router>
    <div>
        <nav>
           <ul>
             <li>
               <Link to="/">Home</Link>
             </li>
             <li>
               <Link to="/offers">Oferty</Link>
             </li>
           </ul>
         </nav>
 
         <Route path="/" exact component={Index} />
         <Route path='/offers' component={ListOfferView} />
         <Route path="/offers/:doc_id" component={SingleOfferView} />
       </div>
   </Router>
  );
}

export default App;
