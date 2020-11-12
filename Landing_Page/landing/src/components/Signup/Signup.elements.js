import styled from 'styled-components';
import { Button } from '../../globalStyles';

export const SignupModalContainer = styled.div`
  display: flex;
  justify-content: flex-start;
  flex-basis: auto;
  align-items: center;
  height: 100vh;
  width: 100%;
`;

export const ModalWrapper = styled.div`
  width: 800px;
  height: 500px;
  margin-left: auto;
  margin-right: auto;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
  background: #fff;
  color: #000;
  display: grid;
  grid-template-rows: 1fr 5fr;  
  position: relative;
  z-index: 10;
  border-radius: 10px;
  background: black;
  color: white;
  
  @media screen and (max-width: 960px) {
    width: 100%;
    height: 100%;
  }
`;

export const ModalWrapperHeader = styled.div`
  display: flex;
  justify-content: center;
  align-items: center;
  border-bottom: 1px solid black;
`;

export const FormContainer = styled.div`
  display: flex;
  justify-content: flex-start;
  align-items: center;
`;

export const SignupForm = styled.div`
  display: flex;
  
`;

export const SignupButton = styled(Button)`
  border-radius: 0px;
  min-width: 100px;
  background: black;
  color: azure;
  
  &:hover {
    background: azure;
    color: black;
  }
`;

export const Modal = styled.div`
    
`;

