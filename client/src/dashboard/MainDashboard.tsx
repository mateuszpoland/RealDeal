import React, {useEffect, useState} from "react";
import {BraintreeClient} from "../components/payments/braintreeClient";
import {useDispatch, useSelector} from "react-redux";
import {fetchClientToken} from "../actions/payments/payments";
import {AppState} from "../reducer";
import {BraintreePaymentForm} from "../views/payments/BraintreePaymentForm";

export const MainDashboard = () => {
    const [paymentProcessingError, setPaymentProcessingError] = useState(null);
    const [dropInVisible, setDropInVisible] = useState(false);
    const [authToken, error] = useSelector((state:AppState) =>
        [
            state.payments.brainTreeAuthToken,
            state.payments.error
        ]);
    const dispatch = useDispatch();

    useEffect(() => {

    }, []);

    const initalizePayment = () => {
        dispatch(fetchClientToken());
        if(error !== null) {
            setPaymentProcessingError(error);
            return;
        }

        if(authToken !== null) {
            const client = new BraintreeClient(authToken);
            console.log(client.testInitalizeClient())
            toggleDropIn();
        }
    }

    const toggleDropIn = () => {
        setDropInVisible(!dropInVisible);
    }

    return(
        <React.Fragment>
            <div>Witaj, user. Kup konto:</div>
            <button onClick={initalizePayment}>KUP KONTO</button>
            {dropInVisible == true &&
                <BraintreePaymentForm
                    clientToken={authToken}
                    amount={100}
                />
            }
        </React.Fragment>
    );
}

