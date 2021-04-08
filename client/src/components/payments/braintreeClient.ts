export class BraintreeClient {
    authToken: string;

    constructor(authToken: string) {
        this.authToken = authToken;
    }

    testInitalizeClient(): string {
        return 'Initialized Braintree communication';
    }
}
