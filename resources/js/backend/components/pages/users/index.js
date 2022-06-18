import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
    Fragment,
} from "react";
import ReactDOM from "react-dom";
import { useTable } from "react-table";
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";
import { Dialog, Transition } from "@headlessui/react";
import {
    TrashIcon,
    ExclamationIcon,
    PencilAltIcon,
    PlusIcon,
} from "@heroicons/react/outline";
import TableControlled from "../../reactTable/TableControlled";
import {
    ButtonShow,
    ButtonEdit,
    ButtonDelete,
    ButtonCreate,
} from "../../buttons/ButtonActions";
import { ButtonPrimary } from "../../buttons/Button";

export default function User(props) {
    const auth = JSON.parse(props.auth);
    const can_users_delete = props.can_users_delete;
    const can_users_edit = props.can_users_edit;
    const [isOpen, setIsOpen] = useState(false);
    const [deleteLoading, setDeleteLoading] = useState(false);
    const [userId, setUserId] = useState("");
    const [userEmail, setUserEmail] = useState("");
    const [userIndex, setUserIndex] = useState("");
    const [dataUsers, setDataUsers] = useState([]);

    const fetchIdRef = useRef(0);
    const [pageCount, setPageCount] = useState(0);
    const [getPageIndex, setGetPageIndex] = useState(0);
    const [getPageSize, setGetPageSize] = useState(0);
    const [loading, setLoading] = useState(false);
    const [searchTerm, setSearchTerm] = useState("");
    const [dataFrom, setDataFrom] = useState(0);
    const [dataTo, setDataTo] = useState(0);
    const [dataTotal, setDataTotal] = useState(0);
    const dataPageSize = 10;

    const avatarUI = "https://ui-avatars.com/api/?background=random&name=";

    const closeModalDelete = () => {
        setIsOpen(false);
    };

    const openModalDelete = (
        getId,
        getIndex,
        getEmail,
        getPageIndex,
        getPageSize
    ) => {
        setUserId(getId);
        setUserIndex(getIndex);
        setUserEmail(getEmail);
        setIsOpen(true);
    };

    const columns = useMemo(
        () => [
            {
                Header: "No.",
                accessor: "created_at",
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
                Header: "Profile",
                Cell: ({ row: { original, index } }) => {
                    return (
                        <div className="flex flex-row items-center justify-start">
                            <img
                                className="w-10 h-10 overflow-hidden rounded-md shadow-sm shrink-0"
                                src={
                                    original.image_file
                                        ? `/storage/${original.image_file}`
                                        : `${avatarUI}${original.full_name}`
                                }
                            />
                            <div className="flex flex-col ml-2 text-left truncate">
                                <span>{original.full_name}</span>
                                <span className="font-medium">
                                    {original.username}
                                </span>
                            </div>
                        </div>
                    );
                },
            },
            {
                Header: "Email",
                accessor: "email",
            },
            {
                Header: "Role",
                Cell: ({ row: { original, index } }) => {
                    let roles = [];

                    if (!original.roles || !original.roles.length) {
                        return <span>-</span>;
                    }

                    original.roles &&
                        original.roles.forEach((item, index) => {
                            roles[index] = (
                                <div
                                    className="flex flex-col md:list-item"
                                    key={item.name}
                                >
                                    {item.name}
                                </div>
                            );
                        });
                    return (
                        <div
                            className={
                                roles.length > 1
                                    ? "list-disc list-inside"
                                    : "list-none"
                            }
                        >
                            {roles}
                        </div>
                    );
                },
            },
            {
                Header: "Status",
                accessor: "status",
                className: "text-center",
            },
            {
                Header: "Actions",
                className: "text-center",
                Cell: (row) => {
                    // Cell: ({ row: { original, index, state } }) => {
                    const { original, index } = row.row;
                    let buttonShow = <ButtonShow disabled />;
                    let buttonEdit = <ButtonEdit disabled />;
                    let buttonDelete = <ButtonDelete disabled />;
                    let roleAuth = [];
                    auth.roles.forEach((role, index) => {
                        roleAuth[index] = role.name;
                        let rolesField = [];

                        if (!original.roles.length) {
                            buttonEdit = (
                                <a href={`/users/${original.id}/edit`}>
                                    <ButtonEdit />
                                </a>
                            );
                            buttonDelete = (
                                <ButtonDelete
                                    type="button"
                                    onClick={() =>
                                        openModalDelete(
                                            original.id,
                                            index,
                                            original.email,
                                            row.state.pageIndex,
                                            row.state.pageSize
                                        )
                                    }
                                />
                            );
                        }

                        original.roles.forEach((item, index) => {
                            rolesField[index] = item.name;

                            if (
                                can_users_edit &&
                                rolesField.includes("admin") &&
                                original.id === auth.id
                            ) {
                                buttonEdit = (
                                    <a href={`/users/${original.id}/edit`}>
                                        <ButtonEdit />
                                    </a>
                                );
                            } else if (
                                can_users_edit &&
                                !rolesField.includes("admin") &&
                                !rolesField.includes("superadmin")
                            ) {
                                buttonEdit = (
                                    <a href={`/users/${original.id}/edit`}>
                                        <ButtonEdit />
                                    </a>
                                );
                            } else if (
                                can_users_edit &&
                                roleAuth.includes("superadmin")
                            ) {
                                buttonEdit = (
                                    <a href={`/users/${original.id}/edit`}>
                                        <ButtonEdit />
                                    </a>
                                );
                            } else {
                                buttonEdit = <ButtonEdit disabled />;
                            }

                            if (rolesField.includes("superadmin")) {
                                buttonDelete = <ButtonDelete disabled />;
                            } else if (
                                rolesField.includes("admin") &&
                                original.id === auth.id &&
                                can_users_delete
                            ) {
                                buttonDelete = (
                                    <ButtonDelete
                                        type="button"
                                        onClick={() =>
                                            openModalDelete(
                                                original.id,
                                                index,
                                                original.email,
                                                row.state.pageIndex,
                                                row.state.pageSize
                                            )
                                        }
                                    />
                                );
                            } else if (
                                rolesField.includes("admin") &&
                                original.id !== auth.id &&
                                !role.name.includes("superadmin")
                            ) {
                                buttonDelete = <ButtonDelete disabled />;
                            } else {
                                buttonDelete = (
                                    <ButtonDelete
                                        type="button"
                                        onClick={() =>
                                            openModalDelete(
                                                original.id,
                                                index,
                                                original.email,
                                                row.state.pageIndex,
                                                row.state.pageSize
                                            )
                                        }
                                    />
                                );
                            }
                        });
                    });
                    buttonShow = (
                        <a href={`/users/${original.id}`}>
                            <ButtonShow />
                        </a>
                    );
                    return (
                        <div className="inline-flex gap-1">
                            {buttonShow}
                            {buttonEdit}
                            {buttonDelete}
                        </div>
                    );
                },
            },
        ],
        []
    );

    const handleSearch = (e) => {
        if (e.key === "Enter") {
            fetchAPIData({
                pageIndex: getPageIndex,
                pageSize: getPageSize,
                search: searchTerm,
                orderBy: '',
                orderType: 'DESC',
            });
        }
    };

    const fetchAPIData = async ({
        pageIndex,
        pageSize,
        search,
        orderBy,
        orderType,
    }) => {
        try {
            setLoading(true);
            const reqData = await axios.get(
                `/api/users?page=${pageIndex}&per_page=${pageSize}&order_by=${orderBy}&order_type=${orderType}&search=${search}`
            ).then((res) => res.data);

            const resData = await reqData.data;
            if (reqData.status) {
                setDataUsers(resData.data);
                setPageCount(Math.ceil(resData.total / resData.per_page));
                setDataFrom(resData.from || 0);
                setDataTo(resData.to || 0);
                setDataTotal(resData.total || 0);
                setLoading(false);
            } else {
                console.log(reqData.message);
            }

        } catch (e) {
            console.log("Error while fetching", e);
        }
    };

    const fetchData = useCallback(
        ({ pageIndex, pageSize, searchTerm, sortBy }) => {
            const fetchId = ++fetchIdRef.current;
            setLoading(true);
            if (fetchId === fetchIdRef.current) {
                setGetPageIndex(pageIndex + 1);
                setGetPageSize(pageSize);
                fetchAPIData({
                    pageIndex: pageIndex + 1,
                    pageSize: pageSize,
                    search: searchTerm,
                    orderBy: sortBy[0]?.id || '',
                    orderType: sortBy[0]?.desc ? 'ASC' : 'DESC',
                });
            }
        },
        []
    );

    const handleDelete = async () => {
        setDeleteLoading(true);
        await axios
            .delete(`/users/${userId}`)
            .then((res) => {
                if (res.data.status) {
                    setIsOpen(false);
                    toast.success(res.data.message);
                    fetchAPIData({
                        pageIndex: getPageIndex,
                        pageSize: getPageSize,
                        search: searchTerm,
                        orderBy: '',
                        orderType: 'DESC',
                    });
                } else {
                    setIsOpen(true);
                    toast.warn(res.data.message);
                }
            })
            .catch((error) => {
                setIsOpen(true);
                toast.error(error.response.data?.message);
            });
        setTimeout(() => {
            setDeleteLoading(false);
        }, 1000);
    };

    return (
        <>
            <ToastContainer
                position="bottom-right"
                autoClose={3000}
                hideProgressBar={false}
                newestOnTop
                draggable={false}
                pauseOnVisibilityChange
                closeOnClick
                pauseOnHover
            />
            <Transition appear show={isOpen} as={Fragment}>
                <Dialog
                    as="div"
                    className="fixed inset-0 z-40 overflow-y-auto"
                    onClose={closeModalDelete}
                >
                    <Dialog.Overlay className="fixed inset-0 bg-black opacity-60" />
                    <div className="min-h-screen px-4 text-center">
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0"
                            enterTo="opacity-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                        >
                            <Dialog.Overlay className="fixed inset-0" />
                        </Transition.Child>

                        {/* This element is to trick the browser into centering the modal contents. */}
                        <span
                            className="inline-block h-screen align-middle"
                            aria-hidden="true"
                        >
                            &#8203;
                        </span>
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0 scale-95"
                            enterTo="opacity-100 scale-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100 scale-100"
                            leaveTo="opacity-0 scale-95"
                        >
                            <div className="inline-flex flex-col items-center justify-center w-full max-w-md p-6 my-8 overflow-hidden align-middle transition-all transform bg-white shadow-xl select-none rounded-2xl">
                                <ExclamationIcon className="w-24 h-24 text-red-500" />
                                <Dialog.Title
                                    as="h3"
                                    className="text-lg font-medium leading-6 text-gray-900"
                                >
                                    <div className="mb-1 text-base font-normal truncate">
                                        {userEmail}
                                    </div>
                                    <div className="text-xl">
                                        Yakin ingin dihapus?
                                    </div>
                                </Dialog.Title>
                                <div className="mt-2">
                                    <p className="text-sm text-gray-500">
                                        Anda tidak akan dapat mengembalikan data
                                        ini!
                                    </p>
                                </div>

                                <div className="inline-flex items-center gap-2 mt-4">
                                    <button
                                        type="button"
                                        disabled={deleteLoading}
                                        className="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                        onClick={handleDelete}
                                    >
                                        {deleteLoading
                                            ? "Proses..."
                                            : "Ya, hapus ini!"}
                                    </button>
                                    <button
                                        type="button"
                                        className="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-gray-500"
                                        onClick={closeModalDelete}
                                    >
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </Transition.Child>
                    </div>
                </Dialog>
            </Transition>
            <div className="inline-flex flex-col items-center justify-center w-full gap-3 md:flex-row md:justify-between">
                <div className="inline-flex items-center gap-2">
                    <ButtonPrimary path="/users/create" title="Buat Pengguna" />
                    <ButtonCreate />
                </div>
                <input
                    onChange={(e) => setSearchTerm(e.target.value)}
                    onKeyDown={handleSearch}
                    placeholder="Email/Peran"
                    type="search"
                    className="w-full transition duration-300 bg-white border-gray-300 rounded-md shadow-sm form-input md:w-auto focus:ring disabled:cursor-not-allowed disabled:opacity-50 focus:border-primary-300 focus:ring-primary-200/50 dark:border-gray-600 dark:bg-gray-800 dark:focus:border-gray-600 dark:focus:ring-gray-800"
                />
            </div>
            <div className="mt-4">
                <TableControlled
                    dataFrom={dataFrom}
                    dataTo={dataTo}
                    dataTotal={dataTotal}
                    dataPageSize={dataPageSize}
                    searchTerm={searchTerm}
                    pageCount={pageCount}
                    fetchData={fetchData}
                    columns={columns}
                    loading={loading}
                    data={dataUsers}
                />
            </div>
        </>
    );
}

if (document.getElementById("user")) {
    const propsContainer = document.getElementById("user");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<User {...props} />, document.getElementById("user"));
}
