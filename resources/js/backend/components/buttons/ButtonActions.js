import React from "react";
import { Edit, Eye, Trash2 } from 'react-feather';

export function ButtonEdit(props) {
    return (
        <a href={props.path} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-warning focus:border-warning/60 focus:ring focus:ring-warning/10 focus:ring-opacity-50 hover:bg-warning/80">
           <Edit className="w-4 h-4" />
        </a>
    );
}

export function ButtonShow(props) {
    return (
        <a href={props.path} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-info focus:border-info/60 focus:ring focus:ring-info/10 focus:ring-opacity-50 hover:bg-info/80">
           <Eye className="w-4 h-4" />
        </a>
    );
}

export function ButtonDelete(props) {
    return (
        <button {...props} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-danger focus:border-danger/60 focus:ring focus:ring-danger/10 focus:ring-opacity-50 hover:bg-danger/80 disabled:opacity-25 disabled:cursor-not-allowed disabled:hover:bg-danger">
           <Trash2 className="w-4 h-4" />
        </button>
    );
}


export default { ButtonShow, ButtonEdit, ButtonDelete}
