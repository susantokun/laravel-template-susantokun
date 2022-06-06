import React from "react";
import { Edit, Eye, Trash2 } from 'react-feather';

export function ButtonEdit(props) {
    return (
        <a href={props.path} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-warning">
           <Edit className="w-4 h-4" />
        </a>
    );
}

export function ButtonShow(props) {
    return (
        <a href={props.path} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-info">
           <Eye className="w-4 h-4" />
        </a>
    );
}

export function ButtonDelete(props) {
    return (
        <button className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-danger">
           <Trash2 className="w-4 h-4" />
        </button>
    );
}


export default { ButtonShow, ButtonEdit, ButtonDelete}
