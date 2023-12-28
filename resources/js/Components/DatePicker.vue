<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        id: String,
        format: String,
        modelValue: String,
        placeholder: String,
    },
    emits: ["update:modelValue"],
    mounted() {
        const vm = this;
        const selctor = "#dp-" + this.id;
        $(selctor).datepicker({
            format: this.format ? this.format : "yyyy-mm-dd",
            timepicker: false,
            todayHighlight: true,
            autoclose: true,
        });

        $(selctor).on("change", function (e) {
            vm.$emit("update:modelValue", $(this).val());
        });
    },
});
</script>

<template>
    <div>
        <input
            type="text"
            class="form-control"
            :value="modelValue"
            :id="'dp-' + id"
            :placeholder="placeholder"
            autocomplete="off"
            required
        />
    </div>
</template>
