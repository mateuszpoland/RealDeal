import styled from 'styled-components';
import TableRow from "@material-ui/core/TableRow";

export const GoToOfferDetailsButton = styled.span`
  width: 150px;
  padding: 5px 10px;
  background: green;
  color: white;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  border-radius: 4px;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease-in-out;
  &:hover {
    transform: scale(0.9);
  }
`

export const ExpandedRowContainer = styled.div`
  display: flex;
  align-items: center;
`;

