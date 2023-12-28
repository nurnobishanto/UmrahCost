import Noty from "noty";

export default {
    mounted() {
        this.handleNoty();
    },
    updated() {
        this.handleNoty();
    },
    methods: {
        notySuccess(message = "Success") {
            new Noty({
                theme: "mint",
                type: "success",
                text: message,
                timeout: 500,
            }).show();
        },
        notyError(message = "Error") {
            new Noty({
                theme: "mint",
                type: "error",
                text: message,
                timeout: 800,
            }).show();
        },
        handleNoty() {
            if (this.$page.props.success != null) {
                new Noty({
                    theme: "mint",
                    type: "success",
                    text: this.$page.props.success,
                    timeout: 500,
                }).show();
            } else if (this.$page.props.error != null) {
                new Noty({
                    theme: "mint",
                    type: "error",
                    text: this.$page.props.error,
                    timeout: 800,
                }).show();
            }
        },
    },
};
