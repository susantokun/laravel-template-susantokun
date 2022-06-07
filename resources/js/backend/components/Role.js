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
import {ButtonShow, ButtonEdit, ButtonDelete} from './buttons/ButtonActions';

export default function Role(props) {
    const roles = JSON.parse(props.roles);
    const [dataRoles, setDataRoles] = useState([]);
    const [isLoading, setIsLoading] = useState(false);

    const getRoles = async () => {
        setIsLoading(true);
        await axios
            .get(`/api/roles`)
            .then((res) => {
                const resData = res.data;
                setDataRoles(resData.data);
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
                Header: "Permissions",
                Cell: ({ row: { original, index } }) => {
                    var permissions = [];
                    original.permissions.forEach((item, index) => {
                        permissions[index] = <div className="flex flex-col md:list-item" key={item.name}>{item.name}</div>;
                    });
                    return <div className="list-disc list-inside">{permissions}</div>;
                },
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
                            buttonEdit = <ButtonEdit path={`/roles/${original.id}/edit`} />;
                            buttonDelete = <ButtonDelete />;
                        }
                    });
                    buttonShow = <ButtonShow path={`/roles/${original.id}`} />;
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
        getRoles();
        return () => {
            setDataRoles([]);
        };
    }, []);

    return (
        <>
            <form>
                <div className="mt-4">
                    <TablePagination
                        columns={columns}
                        data={dataRoles}
                        loading={isLoading}
                    />
                </div>
            </form>
        </>
    );
}

if (document.getElementById("role")) {
    const propsContainer = document.getElementById("role");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<Role {...props} />, document.getElementById("role"));
}
