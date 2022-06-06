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

import TablePaginationControlled from "./reactTable/TablePaginationControlled";
import {ButtonShow, ButtonEdit, ButtonDelete} from './buttons/ButtonActions';

export default function User(props) {
    const roles = JSON.parse(props.roles)
    const [isLoading, setIsLoading] = useState(false);

    //   const getUsers = async () => {
    //     setIsLoading(true);
    //     await axios.get(`/api/users`).then((res) => {
    //       const resData = res.data;
    //       setDataUsers(resData.data);
    //     }).catch((err) => {
    //       toast.error(err);
    //     });
    //     setIsLoading(false);
    //   };

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
                Header: "Email",
                accessor: "email",
            },
            {
                Header: "Role",
                Cell: ({ row: { original, index } }) => {
                    let roles = [];

                    original.roles.forEach((item, index) => {
                        roles[index] = <div className="list-item" key={item.name}>{item.name}</div>;
                    });
                    return <div className="list-disc list-inside">{roles}</div>;
                },
            },
            {
                Header: "Created",
                accessor: "created_at",
                className: "truncate",
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
                            buttonEdit = <ButtonEdit path={`/users/${original.id}/edit`} />;
                            buttonDelete = <ButtonDelete />;
                        }
                    });
                    buttonShow = <ButtonShow path={`/users/${original.id}`} />;
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

    const [data, setData] = useState([]);
    const [pageCount, setPageCount] = useState(0);
    const fetchIdRef = useRef(0);

    const fetchAPIData = async ({ limit, skip }) => {
        try {
            setIsLoading(true);
            const response = await axios.get(`/api/users/${limit}/${skip}`);
            const data = await response.data;
            setData(data.data);
            setPageCount(Math.ceil(data.total / limit));
            setIsLoading(false);
        } catch (e) {
            console.log("Error while fetching", e);
        }
    };

    const fetchData = useCallback(({ pageSize, pageIndex }) => {
        const fetchId = ++fetchIdRef.current;
        setIsLoading(true);
        if (fetchId === fetchIdRef.current) {
            fetchAPIData({
                limit: pageSize,
                skip: pageSize * pageIndex,
            });
        }
    }, []);

    //   useEffect(() => {
    //     getUsers();
    //     return() => {
    //       setDataUsers([]);
    //     };
    //   }, []);

    return (
        <>
            <form>
                <div className="mt-4">
                    {/* <TablePagination columns={columns}
            data={dataUsers}
            loading={isLoading}/> */}
                    <TablePaginationControlled
                        columns={columns}
                        data={data}
                        fetchData={fetchData}
                        loading={isLoading}
                        pageCount={pageCount}
                        // countAll={pageSize}
                    />
                </div>
            </form>
        </>
    );
}

if (document.getElementById("user")) {
    const propsContainer = document.getElementById("user");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<User {...props} />, document.getElementById("user"));
}
