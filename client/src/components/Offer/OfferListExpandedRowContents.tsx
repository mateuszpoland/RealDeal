import TableCell from "@material-ui/core/TableCell";
import TableRow from "@material-ui/core/TableRow";
import React from "react";
import { GoToOfferDetailsButton } from './Offer_elements';
import EditIcon from "@material-ui/icons/Edit";
import OffersActionSpeedDial from "./OffersActionSpeedDial";
import {SpeedDialActions} from './types';
import { ExpandedRowContainer } from './Offer_elements';
import {Link} from "react-router-dom";
import { useHistory } from "react-router-dom";

export const OfferListExpandedRowContents = (props: {colSpan: any, data: any}) => {
    const data = props.data;
    const colSpan = props.colSpan;
    let history = useHistory();
    const actions: Array<SpeedDialActions> = [
        {
            icon: <EditIcon/>,
            actionName: 'edit_offer',
            clickActionHandler: () => {
                const offerId = data[0].id
                //const offerId = data
                history.push(`/offers/${offerId}`);
            },
            link: <Link to={'/offers/1'}/>
        },
    ];

    return (
        <ExpandedRowContainer>
            <OffersActionSpeedDial
                actions={actions}
            />
            <TableRow>
                <TableCell colSpan={colSpan}>
                    <GoToOfferDetailsButton>Sprzedaj</GoToOfferDetailsButton>
                    {data.map((rowInfo) => {
                        // pass in the styled component
                    })}
                </TableCell>
            </TableRow>
        </ExpandedRowContainer>
    );
}
