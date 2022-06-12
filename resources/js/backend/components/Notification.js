import React, { useEffect } from "react";
import ReactDOM from "react-dom";
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
    const propsContainer = document.getElementById("notification");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<Notification {...props} />, document.getElementById("notification"));
}
