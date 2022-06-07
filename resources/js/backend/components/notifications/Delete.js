import React, { useEffect } from "react";
import ReactDOM from "react-dom";
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";

export default function NotificationDelete(props) {
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

if (document.getElementById("notificationDelete")) {
    const propsContainer = document.getElementById("notificationDelete");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<NotificationDelete {...props} />, document.getElementById("notificationDelete"));
}
