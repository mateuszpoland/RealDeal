import React from "react";
import {useQuery} from "react-query";

export const ClientsListView = () => {
    const { isLoading, error, data } = useQuery('clients', () => {

    });
    return(
        <React.Fragment>
            <h3>Twoje kontakty</h3>
            <p>Dodaj kontakt ..</p>
        </React.Fragment>
    );
}