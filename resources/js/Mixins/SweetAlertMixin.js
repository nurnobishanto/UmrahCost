import Swal from "sweetalert2";

export default {
    methods: {
        swalAlert(title, html, icon = "warning", confirmBtnText = "Yes") {
            Swal.fire({
                title: title,
                html: html,
                icon: icon,
                confirmButtonText: confirmBtnText,
                focusConfirm: true,
            });
        },
    },
};
