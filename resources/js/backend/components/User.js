import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
} from "react";
import ReactDOM from "react-dom";
import { useTable } from "react-table";
import TablePaginationControlled from "./reactTable/TablePaginationControlled";

export default function User(props) {
    //   const [dataUsers, setDataUsers] = useState([]);
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
                Header: "Created",
                accessor: "created_at",
                className: "truncate"
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