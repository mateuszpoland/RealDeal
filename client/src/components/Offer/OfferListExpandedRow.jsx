import TableCell from "@material-ui/core/TableCell";
import TableRow from "@material-ui/core/TableRow";
import React from "react";
import { GoToOfferDetailsButton } from './Offer_elements';

const OfferListExpandedRow = ({colSpan, data}) => {
    return (
        <TableRow>
            <TableCell colSpan={colSpan}>
                <GoToOfferDetailsButton>Detale Oferty</GoToOfferDetailsButton>
                {data.map((rowInfo) => {
                    // pass in the styled component
                })}
            </TableCell>
        </TableRow>
    );
}

export default OfferListExpandedRow;
