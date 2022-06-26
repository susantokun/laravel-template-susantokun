import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
} from "react";
import { createRoot } from 'react-dom/client';
import { useTable } from "react-table";
import TableBasic from "../../reactTable/TableBasic";

export default function UserBasic(props) {
    const [dataUsers, setDataUsers] = useState([]);
    const [isLoading, setIsLoading] = useState(false);

    const getUsers = async () => {
        setIsLoading(true);
        await axios
            .get(`/users-basic`)
            .then((res) => {
                const resData = res.data;
                setDataUsers(resData.data);
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
                Header: "Email",
                accessor: "email",
            },
            {
                Header: "Created",
                accessor: "created_at",
            },
        ],
        []
    );

    useEffect(() => {
        getUsers();
        return () => {
            setDataUsers([]);
        };
    }, []);

    return (
        <>
            <form>
                <div className="mt-4">
                    <TableBasic
                        columns={columns}
                        data={dataUsers}
                        loading={isLoading}
                    />
                </div>
            </form>
        </>
    );
}

if (document.getElementById("userBasic")) {
    const container = document.getElementById("userBasic");
    const root = createRoot(container);
    const props = Object.assign({}, container.dataset);
    root.render(<UserBasic {...props} />);
}
