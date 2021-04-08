import DropIn from "braintree-web-drop-in-react";
import React, {useState} from "react";

export const BraintreePaymentForm = (props) => {
    const [instance, setInstance] = useState(null);
    const {clientToken, amount} = props;

    const initiatePayment =  async () => {
        const { nonce } = await instance.requestPaymentMethod();
        console.log(nonce);
    }

    return (
        <div>
            <DropIn
                options={
                    {
                        authorization: clientToken,
                        locale: 'pl_PL',
                        vaultManager: true,
                        threeDSecure: true,
                        card: {
                            cardholderName: {
                                required: true
                            },
                        }
                    }
                }
                onInstance={(instance) => (setInstance(instance))}
            />
            <button onClick={(e) => initiatePayment()}>Buy Now!</button>
        </div>
    );
}
