import React from "react";
import MUIDataTable from "mui-datatables";
import { OfferListExpandedRowContents } from "./OfferListExpandedRowContents";

const OffersTable = ({title, data, columns}) => {
    const options = {
        caseSensitive: true,
        filter: true,
        filterType: "dropdown",
        responsive: "standard",
        expandableRows: true,
        expandableRowsOnClick: true,
        isRowExpandable: (dataIndex, expandedRows) => {
            return !(expandedRows.data.length > 4 && expandedRows.data.filter((d) => d.dataIndex === dataIndex).length === 0);
        },
        renderExpandableRow: (rowData, rowMeta) => {
            const colSpan = rowData.length + 1;
            const id = rowData[0];
            const filteredFullRow = data.filter((row) => row.id === id);
            return (
                <OfferListExpandedRowContents key={id} colSpan={colSpan} data={filteredFullRow} />
            );
        },
    };
    // @ts-ignore
    return(
        <MUIDataTable
            title={title}
            data={data}
            columns={columns}
            options={options}
        />
    );
}

export default OffersTable;
