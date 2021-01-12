import TableRow from "@material-ui/core/TableRow";
import TableCell from "@material-ui/core/TableCell";
import React from "react";
import MUIDataTable from "mui-datatables";

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
        return (
            <TableRow>
                <TableCell colSpan={colSpan}>
                    Custom expandable row option. Data: {JSON.stringify(rowData)}
                </TableCell>
            </TableRow>
        );
    },
    rowsExpanded: [0, 1],
};

const OffersTable = ({title, data, columns}) => {
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
