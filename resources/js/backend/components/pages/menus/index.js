import React, {
    useState,
    useEffect,
    useMemo,
    useRef,
    useCallback,
    Fragment,
} from "react";
import { createRoot } from 'react-dom/client';
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

import TableBasic from "../../reactTable/TableBasic";
import {
    ButtonShow,
    ButtonEdit,
    ButtonDelete,
    ButtonCreate,
} from "../../buttons/ButtonActions";
import { ButtonPrimary } from "../../buttons/Button";

export default function Menu(props) {
    const roles = JSON.parse(props.roles);
    const can_menus_delete = props.can_menus_delete;
    const can_menus_edit = props.can_menus_edit;
    const [dataMenus, setDataMenus] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [isOpen, setIsOpen] = useState(false);
    const [deleteLoading, setDeleteLoading] = useState(false);
    const [menuId, setMenuId] = useState("");
    const [menuTitle, setMenuTitle] = useState("");
    const [menuIndex, setMenuIndex] = useState("");
    const [keyword, setKeyword] = useState("");

    const handleSearch = (e) => {
        setKeyword(event.target.value);
    };

    const closeModalDelete = () => {
        setIsOpen(false);
    };

    const openModalDelete = (getMenuId, getMenuTitle, getMenuIndex) => {
        setMenuId(getMenuId);
        setMenuTitle(getMenuTitle);
        setMenuIndex(getMenuIndex);
        setIsOpen(true);
    };

    const handleDelete = async () => {
        setDeleteLoading(true);
        await axios
            .delete(`/menus/${menuId}`)
            .then((res) => {
                if (res.data.status) {
                    setIsOpen(false);
                    toast.success(res.data.message);
                    const removeData = dataMenus.filter(
                        (item, index) => index !== menuIndex
                    );
                    setDataMenus(removeData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
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

    const getMenus = async () => {
        setIsLoading(true);
        await axios
            .get(`/api/menus`)
            .then((res) => {
                const resData = res.data;
                setDataMenus(resData.data);
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
                Header: "Name",
                accessor: "title",
            },
            {
                Header: "Parent",
                Cell: (row) => {
                    const { original, index } = row.row;
                    let parentName = "";
                    if (original.parent_id === 0) {
                        parentName = "Menu Induk";
                    } else {
                        parentName = original.parent.title;
                    }
                    return parentName;
                },
            },
            {
                Header: "Role",
                accessor: "role.name",
            },
            {
                Header: "Actions",
                className: "text-center",
                Cell: (row) => {
                    const { original, index } = row.row;
                    let buttonShow = <ButtonShow disabled />;
                    let buttonEdit = <ButtonEdit disabled />;
                    let buttonDelete = <ButtonDelete disabled />;

                    buttonShow = (
                        <a href={`/menus/${original.id}`}>
                            <ButtonShow />
                        </a>
                    );
                    buttonEdit = (
                        <a href={`/menus/${original.id}/edit`}>
                            <ButtonEdit />
                        </a>
                    );
                    buttonDelete = (
                        <ButtonDelete
                            type="button"
                            onClick={() =>
                                openModalDelete(
                                    original.id,
                                    `${original.title} - ${original.role.name}`,
                                    index
                                )
                            }
                        />
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

    const filterData = {
        menus: dataMenus.filter((item) =>
            item.title.toLowerCase().includes(keyword.toLowerCase())
        ),
    };

    useEffect(() => {
        getMenus();
        return () => {
            setDataMenus([]);
        };
    }, []);

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
                                        {menuTitle}
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
                    <ButtonPrimary path="/menus/create" title="Buat Menu" />
                </div>

                <input
                    onChange={handleSearch}
                    placeholder="Nama"
                    type="search"
                    className="w-full transition duration-300 bg-white border-gray-300 rounded-md shadow-sm form-input md:w-auto focus:ring disabled:cursor-not-allowed disabled:opacity-50 focus:border-primary-300 focus:ring-primary-200/50 dark:border-gray-600 dark:bg-gray-800 dark:focus:border-gray-600 dark:focus:ring-gray-800"
                />
            </div>
            <div className="mt-4">
                <TableBasic
                    columns={columns}
                    data={filterData.menus}
                    loading={isLoading}
                />
            </div>
        </>
    );
}
if (document.getElementById("menu")) {
    const container = document.getElementById("menu");
    const root = createRoot(container);
    const props = Object.assign({}, container.dataset);
    root.render(<Menu {...props} />);
}
