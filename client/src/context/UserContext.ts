import React from 'react';

type UserState = {

};

const UserContext = React.createContext({
    isAuthenticated: false
});

export default class UserProvider extends React.Component<any, any> {
    constructor(props: any) {
        super(props)

        this.state = {
            isAuthenticated: false
        }
    }
}
