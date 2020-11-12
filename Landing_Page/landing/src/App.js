import React, { useState } from 'react';
import {Navbar} from "./components/Navbar/Navbar";
import GlobalStyle from "./globalStyles";
import {BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import {Signup} from "./components/Signup/Signup";

function App() {
    const [showSignup, setShowSignup] = useState(false);

    const openSignup = () => {
        setShowSignup(prev => !prev);
    }
  return (
      <Router>
        <GlobalStyle />
          {showSignup ? (
                  <Signup showModal={showSignup} setShowModal={openSignup}/>
          ) : (
              <Navbar
                  onShowSignup={openSignup} />
          )}

      </Router>
  );
}

export default App;
