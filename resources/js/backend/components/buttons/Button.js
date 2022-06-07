import React from "react";

export function ButtonPrimary(props) {
    return (
        <a href={props.path} className="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-wide text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm select-none bg-primary hover:bg-primary/80 active:bg-primary/90 focus:outline-none focus:border-primary/500 focus:ring ring-primary/30 disabled:opacity-25">
           {props.title}
        </a>
    );
}


export default { ButtonPrimary }
