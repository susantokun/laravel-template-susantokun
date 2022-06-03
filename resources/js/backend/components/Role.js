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

export default function Role(props) {
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
                        permissions[index] = item.name;
                    });
                    return <div className="flex-wrap inline-flex w-18">{permissions.join(', ')}</div>;
                },
            },
            {
                Header: "Created",
                accessor: "created_at",
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
