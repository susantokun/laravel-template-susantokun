import React, { useEffect } from "react";
import { createRoot } from 'react-dom/client';
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";

export default function Notification(props) {
    const { message, status } = props;
    useEffect(() => {
        if (status === "success") {
            toast.success(message);
        } else {
            toast.error(message);
        }
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
        </>
    );
}

if (document.getElementById("notification")) {
    const container = document.getElementById("notification");
    const root = createRoot(container);
    root.render(<Notification {...props} />, document.getElementById("notification"));
}
