import React, {useState} from 'react';
import {AppBarTop} from "../../components/AppBarTop";
import SignIn from "./SignIn";

export const RegisterPage: React.FC = () => {
    return (
        <div>
            <AppBarTop handleSidebarToggle={() => false}/>
            <SignIn/>
        </div>
    );
}
