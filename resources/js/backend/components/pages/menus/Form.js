import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";

export default function Form(props) {
    const [dataRoles, setDataRoles] = useState([]);
    const [dataMenus, setDataMenus] = useState([]);

    const getRoles = async () => {
        const reqData = await axios.get('/api/roles');
        const resData = await reqData.data
        if (resData.status) {
            setDataRoles(resData.data)
            getMenus(resData.data[0].id)
        }
    }

    const getMenus = async (roleId = '') => {
        const reqData = await axios.get(`/api/menus-select?role=${roleId}`);
        const resData = await reqData.data
        if (resData.status) {
            setDataMenus(resData.data)
        }
    }

    useEffect(() => {
        getRoles();
        return () => {
            setDataRoles([])
            setDataMenus([])
        };
    }, []);

    return (
        <div className="grid gap-4 md:grid-cols-6">
            <div className="col-span-3">
                <label className="form-label">Peran</label>
                <select className="block w-full mt-1 form-select" name="role_id" onChange={(e) => getMenus(e.target.value)}>
                    {dataRoles.map((item) => (
                        <option key={item.id} value={item.id}>{item.name}</option>
                    ))}
                </select>
            </div>
            <div className="col-span-3">
                <label className="form-label">Menu Induk</label>
                <select className="block w-full mt-1 form-select" name="parent_id">
                    {dataMenus.map((item, index) => (
                        <option key={index} value={index}>{item}</option>
                    ))}
                </select>
            </div>
        </div>
    );
}

if (document.getElementById("menuForm")) {
    const propsContainer = document.getElementById("menuForm");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<Form {...props} />, document.getElementById("menuForm"));
}
