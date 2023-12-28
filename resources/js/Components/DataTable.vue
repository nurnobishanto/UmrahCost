<script>
import { defineComponent } from "vue";
import debounce from "lodash/debounce";
import Pagination from "v-pagination-3";

export default defineComponent({
    props: {
        paginate_data: Object,
        filter: Function,
        fontSize: String | null,
    },
    components: {
        Pagination,
    },
    data() {
        return {
            filterText: null,
        };
    },
    computed: {
        debouncedSearch() {
            return debounce(this.filter, 400);
        },
    },
    watch: {
        filterText(v) {
            this.debouncedSearch(1, v);
        },
    },
});
</script>

<template>
    <div class="row">
        <div class="col-md-8">
            <slot name="actions"></slot>
        </div>
        <div class="col-md-4 mb-3">
            <input
                v-if="filter"
                type="text"
                class="from-control"
                v-model="filterText"
                placeholder="Search here..."
                style="border: 1px solid #ddd; border-radius: 0; width: 100%"
            />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table
                class="table table-bordered"
                :style="{ 'font-size': fontSize }"
            >
                <slot></slot>
            </table>

            <pagination
                v-if="paginate_data"
                v-model="paginate_data.current_page"
                :records="paginate_data.total"
                :per-page="paginate_data.per_page"
                @paginate="filter"
                :options="{ theme: 'bootstrap4' }"
            />
        </div>
    </div>
</template>

<style>
.VuePagination__pagination-item-next-chunk {
    display: none;
}

.VuePagination__pagination-item-prev-chunk {
    display: none;
}
</style>
