import React, { useState, useEffect } from 'react';
import { SignupModalContainer, ModalBackground, ModalWrapper, SignupButton, ModalWrapperHeader, FormContainer, SignupForm } from './Signup.elements';

export const Signup = (showModal, setShowModal) => {
    return (
        <>
        <SignupModalContainer>
            <ModalWrapper>
                <ModalWrapperHeader>Zapisz się na wersję beta!</ModalWrapperHeader>
                <FormContainer>
                    <SignupForm>

                    </SignupForm>
                </FormContainer>
            </ModalWrapper>
        </SignupModalContainer>
        </>
    );
}
