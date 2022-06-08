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
import Moment from "react-moment";
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";
import { Dialog, Transition } from "@headlessui/react";
import {
    TrashIcon,
    ExclamationIcon,
    PencilAltIcon,
    PlusIcon
} from "@heroicons/react/outline";

import TablePaginationControlled from "./reactTable/TablePaginationControlled";
import { ButtonShow, ButtonEdit, ButtonDelete, ButtonCreate } from "./buttons/ButtonActions";
import { ButtonPrimary } from "./buttons/Button";

export default function User(props) {
    const roles = JSON.parse(props.roles);
    const [isLoading, setIsLoading] = useState(false);
    const [isOpen, setIsOpen] = useState(false);
    const [deleteLoading, setDeleteLoading] = useState(false);
    const [userId, setUserId] = useState("");
    const [userEmail, setUserEmail] = useState("");
    const [indexDataDelete, setIndexDataDelete] = useState("");
    const [search, setSearch] = useState("");
    const [keyword, setKeyword] = useState("");

    const [countFilter, setCountFilter] = useState(0);
    const [countTotal, setCountTotal] = useState(0);

    const [getPageIndex, setGetPageIndex] = useState(0);
    const [getPageSize, setGetPageSize] = useState(0);

    const [take, setTake] = useState(0);
    const [skip, setSkip] = useState(0);

    const [dataUsers, setDataUsers] = useState([]);
    const [pageCount, setPageCount] = useState(0);
    const fetchIdRef = useRef(0);

    const handleSearch = (e) => {
        if (e.key === 'Enter') {
            fetchAPIData({
            take: take,
            skip: skip,
            keyword: keyword,
        });
        }
    };

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
        setIndexDataDelete(getIndex);
        setUserEmail(getEmail);
        setGetPageIndex(getPageIndex);
        setGetPageSize(getPageSize);
        setIsOpen(true);
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
                Header: "Name",
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
                        roles[index] = (
                            <div
                                className="flex flex-col md:list-item"
                                key={item.name}
                            >
                                {item.name}
                            </div>
                        );
                    });
                    return <div className={roles.length > 1 ? 'list-disc list-inside' : 'list-none'}>{roles}</div>;
                },
            },
            {
                Header: "Created",
                accessor: "created_at",
                className: "truncate",
                Cell: ({ row: { original, index } }) => {
                    return (
                        <Moment
                            format="dddd, DD MMMM YYYY"
                            date={original.created_at}
                        />
                    );
                },
            },
            {
                Header: "Actions",
                className: "text-center",
                Cell: (row) => {
                    // Cell: ({ row: { original, index, state } }) => {
                    const { original, index } = row.row;
                    let buttonShow = "";
                    let buttonEdit = "";
                    let buttonDelete = "";
                    roles.forEach((item) => {
                        if (item === "super-admin") {
                            buttonEdit = (
                                <ButtonEdit
                                    path={`/users/${original.id}/edit`}
                                />
                            );
                            let roles = [];
                            original.roles.forEach((item, index) => {
                                roles[index] = item.name;
                                if (roles.includes("super-admin")) {
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
                        }
                    });
                    buttonShow = <ButtonShow path={`/users/${original.id}`} />;
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

    const fetchAPIData = async ({ take, skip, keyword }) => {
        try {
            setIsLoading(true);
            const response = await axios.get(
                `/users?take=${take}&skip=${skip}&search=${keyword}`
            );
            const data = await response.data;
            setDataUsers(data.data);
            setPageCount(Math.ceil(data.count_filter / take));
            setCountFilter(data.count_filter);
            setCountTotal(data.count_total);
            setIsLoading(false);
        } catch (e) {
            console.log("Error while fetching", e);
        }
    };

    const fetchData = useCallback(({ pageSize, pageIndex, keyword }) => {
        const fetchId = ++fetchIdRef.current;
        setIsLoading(true);
        if (fetchId === fetchIdRef.current) {
            setTake(pageSize);
            setSkip(pageSize * pageIndex);
            fetchAPIData({
                take: pageSize,
                skip: pageSize * pageIndex,
                keyword: keyword,
            });
        }
    }, []);

    const handleDelete = async () => {
        setDeleteLoading(true);
        await axios
            .delete(`/users/${userId}`)
            .then((res) => {
                if (res.data.status) {
                    setIsOpen(false);
                    toast.success(res.data.message);
                    // const removeData = data.filter(
                    //     (item, index) => index !== indexDataDelete
                    // );
                    // setDataUsers(removeData);
                    fetchAPIData({
                        take: take,
                        skip: skip,
                        keyword: keyword,
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

    // const filterData = {
    //     users: dataUsers.filter(
    //         (item) =>
    //             item.name.toLowerCase().includes(search.toLowerCase()) ||
    //             item.email.toLowerCase().includes(search.toLowerCase())
    //     ),
    // };

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
            <div className="inline-flex items-center justify-between w-full">
                <div className="inline-flex items-center gap-2">
                    <ButtonPrimary path="/users/create" title="Buat Pengguna" />
                    <ButtonCreate />
                </div>
                <input
                    onChange={(e) => setKeyword(e.target.value)}
                    onKeyDown={handleSearch}
                    placeholder="Nama/Email"
                    type="search"
                    className="w-full transition duration-300 bg-white border-gray-300 rounded-md shadow-sm form-input md:w-auto focus:ring disabled:cursor-not-allowed disabled:opacity-50 focus:border-primary-300 focus:ring-primary-200/50 dark:border-gray-600 dark:bg-gray-800 dark:focus:border-gray-600 dark:focus:ring-gray-800"
                />
            </div>
            <div className="mt-4">
                <TablePaginationControlled
                    columns={columns}
                    data={dataUsers}
                    fetchData={fetchData}
                    loading={isLoading}
                    pageCount={pageCount}
                    countFilter={countFilter}
                    countTotal={countTotal}
                    keyword={keyword}
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
