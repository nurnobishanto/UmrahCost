<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        id: String,
        title: String,
        primaryText: String,
        closeText: String,
        onPrimary: Function,
        onClose: Function,
        slim: {
            type: Boolean,
            value: false,
        },
    },
    data() {
        return {
            isClosed: false,
        };
    },
    mounted() {
        const el = $(`#${this.id}`);
        el.modal("show");
        const $this = this;
        el.on("hidden.bs.modal", function (e) {
            if ($this.slim && $this.onPrimary != null) {
                $this.onPrimary();
            } else if ($this.onClose != null) {
                $this.onClose();
            }
            el.modal("hide");
        });
    },
    beforeUnmount() {
        const body = $("body");
        body.removeClass("modal-open");
        body.css("padding-right", 0);
        $(".modal-backdrop").remove();
    },
});
</script>

<template>
    <div
        v-if="$page.props.user"
        class="modal"
        :id="id"
        tabindex="-1"
        role="dialog"
        style="z-index: 9999999999"
    >
        <div
            class="modal-dialog"
            :class="{ 'modal-dialog-one-third': slim }"
            role="document"
        >
            <div class="modal-content">
                <form @submit.prevent="onPrimary">
                    <div class="modal-header" v-if="title">
                        <h5
                            class="modal-title"
                            v-if="title"
                            v-html="title"
                        ></h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div
                        class="modal-footer"
                        v-if="(onPrimary || onClose) && !slim"
                    >
                        <button
                            v-if="onPrimary"
                            @click="onPrimary"
                            type="button"
                            class="btn btn-primary no-border-radius"
                        >
                            {{
                                primaryText && primaryText.length
                                    ? primaryText
                                    : "Save"
                            }}
                        </button>
                        <button
                            v-if="onClose"
                            type="button"
                            class="btn btn-secondary no-border-radius"
                            data-dismiss="modal"
                        >
                            {{
                                closeText && closeText.length
                                    ? closeText
                                    : "Close"
                            }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
h5.modal-title {
    display: inline-block;
    font-size: 20px;
}
.modal-content {
    border-radius: 0;
}
.modal-dialog-centered {
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%, -50%) !important;
    transform: translate(-50%, -50%) !important;
}
.modal-dialog-one-third {
    position: absolute;
    top: 33.33%;
    left: 50%;
    -ms-transform: translate(-50%, -33.33%) !important;
    transform: translate(-50%, -33.33%) !important;
}
</style>
