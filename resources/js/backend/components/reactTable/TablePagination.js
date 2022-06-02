/* eslint-disable no-nested-ternary */
import { useTable, usePagination } from "react-table";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/react/solid";
import NumberFormat from 'react-number-format';

function TablePagination({ columns, data, loading = true }) {
    const {
        getTableProps,
        getTableBodyProps,
        headerGroups,
        prepareRow,
        page,

        canPreviousPage,
        canNextPage,
        // pageOptions,
        // pageCount,
        gotoPage,
        nextPage,
        previousPage,
        setPageSize,
        // eslint-disable-next-line no-unused-vars
        state: { pageIndex, pageSize },
    } = useTable(
        {
            columns,
            data,
            initialState: { pageIndex: 0, pageSize: 10 },
        },
        usePagination
    );

    const goNextPage = (e) => {
        e.preventDefault();
        gotoPage(pageIndex + 1);
    };

    const goPreviousPage = (e) => {
        e.preventDefault();
        gotoPage(pageIndex - 1);
    };

    return (
        <div className="flex flex-col w-full">
            {/* <pre>
                <code>
                {JSON.stringify(
                    {
                    pageIndex,
                    pageSize,
                    pageCount,
                    canNextPage,
                    canPreviousPage,
                    },
                    null,
                    2,
                )}
                </code>
            </pre> */}
            <div className="flex flex-col overflow-hidden overflow-x-auto border rounded-md shadow-sm border-primary/300">
                <table {...getTableProps()} className="w-full">
                    <thead>
                        {headerGroups.map((headerGroup) => (
                            <tr {...headerGroup.getHeaderGroupProps()}>
                                {headerGroup.headers.map((column) => (
                                    <th
                                        {...column.getHeaderProps()}
                                        className={`${
                                                    column.className ?? ""
                                                } px-4 py-1 text-base font-semibold text-gray-800 border border-secondary bg-secondary dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200`}
                                    >
                                        {column.render("Header")}
                                    </th>
                                ))}
                            </tr>
                        ))}
                    </thead>
                    {loading ? (
                        <tbody className="text-center">
                            <tr>
                                <td className="py-1.5" colSpan="10000">
                                    Memuat...
                                </td>
                            </tr>
                        </tbody>
                    ) : data.length > 0 ? (
                        <tbody {...getTableBodyProps()}>
                            {page.map((row) => {
                                prepareRow(row);
                                return (
                                    <tr {...row.getRowProps()}>
                                        {row.cells.map((cell) => (
                                            <td
                                                {...cell.getCellProps()}
                                                className={`${
                                                    cell.column.className ?? ""
                                                } p-2 text-sm px-4 border bg-white dark:bg-gray-800 dark:border-gray-600 select-text`}
                                            >
                                                {cell.render("Cell")}
                                            </td>
                                        ))}
                                    </tr>
                                );
                            })}
                        </tbody>
                    ) : (
                        <tbody className="text-center">
                            <tr>
                                <td className="py-2 text-sm" colSpan="10000">
                                    Data Tidak Ditemukan!
                                </td>
                            </tr>
                        </tbody>
                    )}
                </table>
            </div>
            <div className="flex items-center justify-between py-3">
                <div className="inline-flex items-center gap-2">
                    <select
                        className="form-select focus:ring-primary/20 bg-white dark:bg-gray-800 shadow-primary/30 dark:focus:ring-gray-800 dark:shadow-primary/30 rounded-md text-sm 2xl:text-base font-medium shadow-sm transition duration-300 focus:outline-none focus:ring disabled:cursor-not-allowed disabled:opacity-50 border border-primary/50 dark:border-gray-500 py-1.5 tracking-wide inline-flex items-center justify-center"
                        value={pageSize}
                        onChange={(e) => {
                            setPageSize(Number(e.target.value));
                        }}
                    >
                        {[5, 10, 20].map((pageSize) => (
                            <option key={pageSize} value={pageSize}>
                                Tampil {pageSize}
                            </option>
                        ))}
                    </select>
                    <div className="rounded-md text-sm 2xl:text-base transition duration-300 focus:outline-none py-1.5 tracking-wide inline-flex items-center justify-center px-1">
                        <div className="hidden text-sm md:block">
                            <span>
                                Menampilkan <strong>{page.length}</strong> dari{" "}
                                <strong><NumberFormat value={data.length} displayType="text" thousandSeparator="."
                  decimalSeparator="," /></strong> data
                            </span>
                        </div>
                    </div>
                </div>
                <div className="inline-flex items-center gap-2">
                    {" "}
                    <button
                        className="bg-primary/60 focus:ring-primary/20 hover:bg-primary/70 shadow-primary/30 active:bg-primary/60 dark:focus:ring-gray-800 dark:shadow-primary/30 rounded-md border border-transparent px-3 py-1.5 text-sm font-medium shadow-md transition duration-300 focus:outline-none focus:ring disabled:cursor-not-allowed disabled:opacity-50 2xl:text-base text-white tracking-wide inline-flex items-center justify-center"
                        onClick={(e) => goPreviousPage(e)}
                        disabled={!canPreviousPage}
                    >
                        <ChevronLeftIcon className="w-5 h-5" />
                    </button>
                    <button
                        className="bg-primary/60 focus:ring-primary/20 hover:bg-primary/70 shadow-primary/30 active:bg-primary/60 dark:focus:ring-gray-800 dark:shadow-primary/30 rounded-md border border-transparent px-3 py-1.5 text-sm font-medium shadow-md transition duration-300 focus:outline-none focus:ring disabled:cursor-not-allowed disabled:opacity-50 2xl:text-base text-white tracking-wide inline-flex items-center justify-center"
                        onClick={(e) => goNextPage(e)}
                        disabled={!canNextPage}
                    >
                        <ChevronRightIcon className="w-5 h-5" />
                    </button>{" "}
                </div>
            </div>

            <div className="block text-sm md:hidden">
                <span>
                    Menampilkan <strong>{page.length}</strong> dari{" "}
                    <strong><NumberFormat value={data.length} displayType="text" thousandSeparator="."
                  decimalSeparator="," /></strong> data
                </span>
            </div>
        </div>
    );
}

export default TablePagination;
