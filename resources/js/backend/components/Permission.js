import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
} from "react";
import ReactDOM from "react-dom";
import { useTable } from "react-table";
import TablePagination from "./reactTable/TablePagination";

export default function Permission(props) {
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
