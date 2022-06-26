import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
    Fragment,
} from "react";
import { createRoot } from "react-dom/client";
import { useTable } from "react-table";
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";
import { Dialog, Transition, Menu } from "@headlessui/react";
import {
    TrashIcon,
    ExclamationIcon,
    PencilAltIcon,
    PlusIcon,
    UploadIcon as UploadIconOutline,
    DownloadIcon as DownloadIconOutline,
    DocumentIcon,
    CloudUploadIcon,
} from "@heroicons/react/outline";
import TableControlled from "../../reactTable/TableControlled";
import {
    ButtonShow,
    ButtonEdit,
    ButtonDelete,
    ButtonCreate,
    ButtonSubmit,
    ButtonCancel,
} from "../../buttons/ButtonActions";
import { MenuButton, ButtonImportExample } from "../../buttons/Button";
import {
    ChevronDownIcon,
    ChevronUpIcon,
    UploadIcon as UploadIconSolid,
    DownloadIcon as DownloadIconSolid,
} from "@heroicons/react/solid";
import { ButtonPrimary } from "../../buttons/Button";
import Modal from "../../Modal";
import { FileUploader } from "react-drag-drop-files";

const fileTypes = ["XLSX"];

export default function User(props) {
    const auth = JSON.parse(props.auth);
    const can_users_delete = props.can_users_delete;
    const can_users_edit = props.can_users_edit;
    const can_users_import = props.can_users_import;
    const can_users_export = props.can_users_export;
    const can_users_download = props.can_users_download;
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

    const [isOpenImport, setIsOpenImport] = useState(false);
    const [importLoading, setImportLoading] = useState(false);
    const [importFile, setImportFile] = useState("");
    const [importFileName, setImportFileName] = useState("");
    const [importFileSize, setImportFileSize] = useState(0);
    const [importErrors, setImportErrors] = useState([]);
    const [importError, setImportError] = useState("");
    const [isDownload, setIsDownload] = useState(false);

    const avatarUI = "https://ui-avatars.com/api/?background=random&name=";

    const humanFileSize = (size) => {
        var i = Math.floor(Math.log(size) / Math.log(1024));
        return (
            (size / Math.pow(1024, i)).toFixed(2) * 1 +
            " " +
            ["B", "kB", "MB", "GB", "TB"][i]
        );
    };

    const handleChange = (file) => {
        setImportFile(file);
        setImportFileName(file.name);
        setImportFileSize(humanFileSize(file.size));
        setImportErrors([]);
        setImportError("");
    };

    const onTypeError = (err) => {
        setImportError(err);
    };

    const closeModalDelete = () => {
        setIsOpen(false);
    };

    const closeModalImport = () => {
        setIsOpenImport(false);
        setImportFile("");
        setImportFileName("");
        setImportErrors([]);
        setImportError("");
    };

    const openModalImport = () => {
        setIsOpenImport(true);
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
                        <div className="flex flex-row items-center justify-start w-40">
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
                orderBy: "",
                orderType: "DESC",
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
            const reqData = await axios
                .get(
                    `/api/users?page=${pageIndex}&per_page=${pageSize}&order_by=${orderBy}&order_type=${orderType}&search=${search}`
                )
                .then((res) => res.data);

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
                    orderBy: sortBy[0]?.id || "",
                    orderType: sortBy[0]?.desc ? "ASC" : "DESC",
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
                        orderBy: "",
                        orderType: "DESC",
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

    const handleImport = async () => {
        setImportLoading(true);
        const formData = new FormData();
        formData.append("file", importFile);
        const reqData = await axios.post("/users-import", formData);
        const resData = await reqData.data;
        if (resData.status === true) {
            setIsOpenImport(false);
            setImportFile("");
            setImportFileName("");
            setImportErrors([]);
            setImportError("");
            toast.success(resData.message);
            setImportLoading(false);
            fetchAPIData({
                pageIndex: getPageIndex,
                pageSize: getPageSize,
                search: searchTerm,
                orderBy: "",
                orderType: "DESC",
            });
        } else if (resData.status === "error") {
            setIsOpenImport(true);
            setImportFile("");
            setImportFileName("");
            setImportErrors([]);
            setImportError(resData.error);
            toast.error(resData.message);
        } else {
            setIsOpenImport(true);
            setImportFile("");
            setImportFileName("");
            setImportErrors(resData.errors);
            setImportError("");
            toast.warn(resData.message);
        }
        setImportLoading(false);
    };

    const handleDownloadExample = async () => {
        setIsDownload(true);
        const reqData = await axios.post("api/download", {
            file_path: "documents/excel/example-users.xlsx",
            permission_download: can_users_download ? "users download" : false,
        });
        const resData = await reqData.data;
        if (resData.status) {
            setTimeout(() => {
                toast.success(resData.message);
            }, 1000);
            window.open(resData.data);
        } else {
            toast.warn(resData.message);
        }
        setTimeout(() => {
            setIsDownload(false);
        }, 2000);
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

            <Modal isOpen={isOpenImport} closeModal={closeModalImport}>
                <Dialog.Title
                    as="h3"
                    className="text-xl font-medium leading-6 text-gray-900"
                >
                    <div className="text-xl">Import Data</div>
                </Dialog.Title>
                <div className="w-full mt-2">
                    <p className="text-sm text-gray-500">
                        Silakan unduh terlebih dahulu format excel untuk import
                        data!
                    </p>

                    <div className="my-3">
                        <ButtonImportExample
                            disabled={isDownload}
                            onClick={handleDownloadExample}
                        >
                            {isDownload ? "Mengunduh..." : "Unduh Format Excel"}
                        </ButtonImportExample>
                    </div>

                    {importErrors.length ? (
                        <div className="px-4 py-2 my-3 border rounded-lg border-danger/60 bg-danger/30">
                            <ul className="flex flex-col justify-start w-full text-left list-disc list-inside">
                                {importErrors.map((item, index) => (
                                    <li key={index} className="list-item">
                                        Baris{" "}
                                        <span className="font-medium">
                                            {item.row}
                                        </span>
                                        : {item.errors[0]}
                                    </li>
                                ))}
                            </ul>
                        </div>
                    ) : null}

                    {importError && (
                        <div className="px-4 py-2 my-3 break-all border rounded-lg border-danger/60 bg-danger/30">
                            {importError}
                        </div>
                    )}

                    <div className="w-full">
                        <FileUploader
                            handleChange={handleChange}
                            name="file"
                            types={fileTypes}
                            classes="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                            onTypeError={onTypeError}
                        >
                            {importFileName ? (
                                <div className="flex flex-col items-center justify-center">
                                    <DocumentIcon className="w-10 h-10 mb-1" />
                                    {importFileName} {importFileSize}
                                </div>
                            ) : (
                                <div className="flex items-center space-x-2">
                                    <span className="font-medium text-gray-600">
                                        Drop files to Attach, or
                                        <span className="text-blue-600 underline">
                                            {" "}
                                            browse
                                        </span>
                                    </span>
                                </div>
                            )}
                        </FileUploader>
                    </div>
                </div>

                <div className="inline-flex items-center gap-2 mt-4">
                    <ButtonSubmit
                        type="button"
                        disabled={importLoading}
                        onClick={handleImport}
                    >
                        {importLoading ? "Proses..." : "Ya, import data ini!"}
                    </ButtonSubmit>
                    <ButtonCancel type="button" onClick={closeModalImport}>
                        Batal
                    </ButtonCancel>
                </div>
            </Modal>
            <div className="inline-flex flex-col items-center justify-center w-full gap-3 md:flex-row md:justify-between">
                <div className="inline-flex items-center gap-2">
                    <ButtonPrimary path="/users/create" title="Buat Pengguna" />

                    {(can_users_import || can_users_export) && (
                        <Menu
                            as="div"
                            className="relative inline-block text-left"
                        >
                            <MenuButton>
                                <PlusIcon
                                    className="w-5 h-5 text-primary hover:text-primary/80"
                                    aria-hidden="true"
                                />
                            </MenuButton>
                            <Transition
                                as={Fragment}
                                enter="transition ease-out duration-100"
                                enterFrom="transform opacity-0 scale-95"
                                enterTo="transform opacity-100 scale-100"
                                leave="transition ease-in duration-75"
                                leaveFrom="transform opacity-100 scale-100"
                                leaveTo="transform opacity-0 scale-95"
                            >
                                <Menu.Items className="absolute left-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    {can_users_export && (
                                        <div className="px-1 py-1">
                                            <Menu.Item>
                                                {({ active }) => (
                                                    <a
                                                        href="/users-export"
                                                        className={`${
                                                            active
                                                                ? "bg-primary/50 text-white"
                                                                : "text-gray-900"
                                                        } group flex w-full items-center rounded-md px-2 py-2 text-sm`}
                                                    >
                                                        {active ? (
                                                            <DownloadIconOutline
                                                                className="w-5 h-5 mr-2 text-primary/40"
                                                                aria-hidden="true"
                                                            />
                                                        ) : (
                                                            <DownloadIconSolid
                                                                className="w-5 h-5 mr-2 text-primary/40"
                                                                aria-hidden="true"
                                                            />
                                                        )}
                                                        Export Excel
                                                    </a>
                                                )}
                                            </Menu.Item>
                                        </div>
                                    )}
                                    {can_users_import && (
                                        <div className="px-1 py-1">
                                            <Menu.Item>
                                                {({ active }) => (
                                                    <button
                                                        tyoe="button"
                                                        onClick={() =>
                                                            openModalImport()
                                                        }
                                                        className={`${
                                                            active
                                                                ? "bg-primary/50 text-white"
                                                                : "text-gray-900"
                                                        } group flex w-full items-center rounded-md px-2 py-2 text-sm`}
                                                    >
                                                        {active ? (
                                                            <UploadIconOutline
                                                                className="w-5 h-5 mr-2 text-primary/40"
                                                                aria-hidden="true"
                                                            />
                                                        ) : (
                                                            <UploadIconSolid
                                                                className="w-5 h-5 mr-2 text-primary/40"
                                                                aria-hidden="true"
                                                            />
                                                        )}
                                                        Import Excel
                                                    </button>
                                                )}
                                            </Menu.Item>
                                        </div>
                                    )}
                                </Menu.Items>
                            </Transition>
                        </Menu>
                    )}
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
    const container = document.getElementById("user");
    const root = createRoot(container);
    const props = Object.assign({}, container.dataset);
    root.render(<User {...props} />);
}
