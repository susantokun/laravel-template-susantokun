import React from "react";
import { Menu } from "@headlessui/react";

export function ButtonPrimary(props) {
    return (
        <a href={props.path} className="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-wide text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm select-none bg-primary hover:bg-primary/80 active:bg-primary/90 focus:outline-none focus:border-primary/500 focus:ring ring-primary/30 disabled:opacity-25">
           {props.title}
        </a>
    );
}

export function MenuButton(props) {
    return (
        <Menu.Button className="inline-flex items-center p-2 text-sm font-semibold tracking-wide transition duration-150 ease-in-out border rounded-md shadow-sm select-none border-secondary/60 text-primary bg-secondary hover:bg-secondary/80 active:bg-secondary/90 focus:outline-none focus:border-secondary/500 focus:ring ring-secondary/30 disabled:opacity-25">
           {props.children}
        </Menu.Button>
    );
}

export function ButtonImportExample(props) {
    return (
        <a href={props.path} className="inline-flex justify-center px-4 py-2 text-sm font-medium border border-transparent rounded-md text-lime-900 bg-success/30 hover:bg-success/40 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-success/50 focus:ring ring-success/50">
           {props.title}
        </a>
    );
}


export default { ButtonPrimary, MenuButton, ButtonImportExample }
