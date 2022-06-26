import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";

export default function MenuForm(props) {
    const [dataRoles, setDataRoles] = useState([]);
    const [dataMenus, setDataMenus] = useState([]);
    const [roleSelected, setRoleSelected] = useState(props.role_selected);
    const [menuSelected, setMenuSelected] = useState(props.menu_selected);

    const getRoles = async () => {
        const reqData = await axios.get("/api/roles");
        const resData = await reqData.data;
        if (resData.status) {
            setDataRoles(resData.data);
            getMenus(roleSelected);
        }
    };

    const getMenus = async (roleId = "") => {
        const reqData = await axios.get(`/api/menus-select?role=${roleId}`);
        const resData = await reqData.data;
        if (resData.status) {
            setDataMenus(resData.data);
        }
    };

    useEffect(() => {
        getRoles();
        return () => {
            setDataRoles([]);
            setDataMenus([]);
        };
    }, []);

    const handleChange = (event) => {
        setRoleSelected(event.target.value);
    };

    return (
        <div className="grid gap-4 md:grid-cols-6">
            <div className="col-span-3">
                <label className="form-label">Peran</label>
                <select
                    className="block w-full mt-1 form-select"
                    name="role_id"
                    onChange={(e) => [
                        getMenus(e.target.value),
                        setRoleSelected(e.target.value),
                    ]}
                    value={roleSelected}
                >
                    {dataRoles.map((item) => (
                        <option key={item.id} value={item.id}>
                            {item.name}
                        </option>
                    ))}
                </select>
            </div>
            <div className="col-span-3">
                <label className="form-label">Menu Induk</label>
                <select
                    className="block w-full mt-1 form-select"
                    name="parent_id"
                    onChange={(e) => setMenuSelected(e.target.value)}
                    value={menuSelected}
                >
                    {dataMenus.map((item) => (
                        <option key={item.id} value={item.id}>
                            {item.title}
                        </option>
                    ))}
                </select>
            </div>
        </div>
    );
}

if (document.getElementById("menuForm")) {
    const container = document.getElementById("menuForm");
    const root = createRoot(container);
    const props = Object.assign({}, container.dataset);
    root.render(<MenuForm {...props} />, container);
}
