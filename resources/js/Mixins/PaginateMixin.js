import axios from "axios";
import Swal from "sweetalert2";
import Noty from "noty";

export default {
    data() {
        return {
            pageData: null,
        };
    },
    mounted() {
        this.filter(1, "");
        this.handleNoty();
    },
    updated() {
        this.handleNoty();
    },
    methods: {
        filter(page = 1, search = "") {
            axios
                .get(this.pageUrl + "?page=" + page + "&search=" + search)
                .then((res) => {
                    this.pageData = res.data;
                });
        },
        destroy(id) {
            Swal.fire({
                title: "Warning",
                html: "This record will be deleted permanently!<br>Do you want to continue?",
                icon: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    const destroyUrl = this.pageUrl.replace(
                        "paginate",
                        id + "/delete"
                    );
                    this.$inertia.get(destroyUrl);
                }
            });
        },
        handleNoty() {
            if (this.$page.props.success != null) {
                new Noty({
                    theme: "mint",
                    type: "success",
                    text: this.$page.props.success,
                    timeout: 1000,
                }).show();
            } else if (this.$page.props.error != null) {
                new Noty({
                    theme: "mint",
                    type: "error",
                    text: this.$page.props.error,
                    timeout: 1000,
                }).show();
            }
        },
    },
};
