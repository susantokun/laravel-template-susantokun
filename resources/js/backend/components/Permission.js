import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
} from "react";
import ReactDOM from "react-dom";
import { useTable } from "react-table";
import Moment from 'react-moment';

import TablePagination from "./reactTable/TablePagination";

export default function Permission(props) {
    const roles = JSON.parse(props.roles);
    const [dataPermissions, setDataPermissions] = useState([]);
    const [isLoading, setIsLoading] = useState(false);

    const getPermissions = async () => {
        setIsLoading(true);
        await axios
            .get(`/api/permissions`)
            .then((res) => {
                const resData = res.data;
                setDataPermissions(resData.data);
            })
            .catch((err) => {
                toast.error(err);
            });
        setIsLoading(false);
    };

    const columns = useMemo(
        () => [
            {
                Header: "No.",
                accessor: "#",
                className: "text-center",
                Cell: (row) => {
                    return (
                        <div>
                            {row.state.pageIndex * row.state.pageSize +
                                Number(row.row.id) +
                                1}
                        </div>
                    );
                },
            },
            {
                Header: "Nama",
                accessor: "name",
            },
            {
                Header: "Guard",
                accessor: "guard_name",
            },
            {
                Header: "Created",
                accessor: "created_at",
                Cell: ({ row: { original, index } }) => {
                    return <Moment format="dddd, DD MMMM YYYY" date={original.created_at} />;
                },
            },
            {
                Header: "Actions",
                className: "text-center",
                Cell: ({ row: { original, index } }) => {
                    let buttonShow = '';
                    let buttonEdit = '';
                    let buttonDelete = '';
                    roles.forEach(item => {
                        if (item === 'super-admin') {
                            buttonEdit = <a href={`/users/${original.id}`}>Edit</a>;
                            buttonDelete = <div className="">Delete</div>;
                        }
                    });

                    buttonShow = <a href={`/users/${original.id}`}>Show</a>;

                    return <div className="inline-flex gap-1">
                        {buttonShow}
                        {buttonEdit}
                        {buttonDelete}
                    </div>;
                },
            },
        ],
        []
    );

    useEffect(() => {
        getPermissions();
        return () => {
            setDataPermissions([]);
        };
    }, []);

    return (
        <>
            <form>
                <div className="mt-4">
                    <TablePagination
                        columns={columns}
                        data={dataPermissions}
                        loading={isLoading}
                    />
                </div>
            </form>
        </>
    );
}

if (document.getElementById("permission")) {
    const propsContainer = document.getElementById("permission");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<Permission {...props} />, document.getElementById("permission"));
}
