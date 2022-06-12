import React from "react";
import { Edit, Eye, Trash2, Plus } from 'react-feather';

export function ButtonCreate(props) {
    return (
        <button {...props} className="inline-flex items-center justify-center p-2 font-bold border rounded-md shadow-sm border-slate-300 text-primary bg-secondary/80 focus:border-slate-400 focus:ring focus:ring-slate-200 focus:bg-slate-50 focus:ring-opacity-50 hover:bg-slate-100 disabled:opacity-25 disabled:cursor-not-allowed disabled:hover:bg-secondary/80 focus:outline-none">
           <Plus className="w-5 h-5" />
        </button>
    );
}


export function ButtonEdit(props) {
    return (
        <button {...props} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-warning focus:border-warning/60 focus:ring focus:ring-warning/10 focus:ring-opacity-50 hover:bg-warning/80 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:bg-warning focus:outline-none">
           <Edit className="w-4 h-4" />
        </button>
    );
}

export function ButtonShow(props) {
    return (
        <button {...props} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-info focus:border-info/60 focus:ring focus:ring-info/10 focus:ring-opacity-50 hover:bg-info/80 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:bg-info focus:outline-none">
           <Eye className="w-4 h-4" />
        </button>
    );
}

export function ButtonDelete(props) {
    return (
        <button {...props} className="p-1.5 inline-flex items-center justify-center text-white rounded-md shadow-sm bg-danger focus:border-danger/60 focus:ring focus:ring-danger/10 focus:ring-opacity-50 hover:bg-danger/80 disabled:opacity-25 disabled:cursor-not-allowed disabled:hover:bg-danger focus:outline-none">
           <Trash2 className="w-4 h-4" />
        </button>
    );
}


export default { ButtonShow, ButtonEdit, ButtonDelete}
