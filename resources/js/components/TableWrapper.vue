<template>
  <VueTableLite
    :is-slot-mode="true"
    :is-loading="table.isLoading"
    :columns="table.columns"
    :rows="table.rows"
    :total="table.totalRecordCount"
    :sortable="table.sortable"
    :hasCheckbox="table.hasCheckbox"
    :pageOptions="table.pageOptions"
    @do-search="doSearch"
    @is-finished="table.isLoading = false"
  >
    <template v-slot:action="data">
      <argon-button
        :url="{
          name: 'User Update',
          params: { id: data.value.id },
        }"
        color="primary"
        size="sm"
        variant="gradient"
        class="ms-lg-auto me-lg-1 me-auto mt-lg-0 p-2 px-3"
        ><i class="fa fa-edit"></i
      ></argon-button>
      <argon-button
        @click.prevent="deleteRow(data.value.id)"
        color="danger"
        size="sm"
        variant="gradient"
        class="ms-lg-auto me-lg-0 me-auto mt-lg-0 p-2 px-3"
        ><i class="fa fa-remove"></i
      ></argon-button>
    </template>
  </VueTableLite>
</template>

<script setup>
import { ref, reactive, toRefs } from "vue";
import { useAxios } from "@/helpers/axios";
import VueTableLite from "vue3-table-lite";
import ArgonButton from "@argon/components/ArgonButton.vue";
import { swalWrapper } from "@/helpers/swal";

const props = defineProps({
  url: {
    type: String,
    default: "",
  },
  filters: {
    type: Object,
    default: () => {
      return {};
    },
  },
  columns: {
    type: Array,
    default: () => {
      return [];
    },
  },
  hasCheckbox: {
    type: Boolean,
    default: false,
  },
});

const { url, filters, columns, hasCheckbox } = toRefs(props);

const table = reactive({
  isLoading: false,
  columns: columns,
  rows: [],
  totalRecordCount: 0,
  currentPage: 1,
  offset: 0,
  limit: 0,
  sortable: {
    order: "id",
    sort: "asc",
  },
  hasCheckbox: hasCheckbox,
  pageOptions: [{value: 10, text: 10}, {value: 25, text: 25}, {value: 100, text: 100}],
});

const deleteRow = async (id) => {
  const result = await swalWrapper.confirmDialog(url.value + "/" + id);
  if (result.isConfirmed) {
    doSearch(
      table.offset,
      table.limit,
      table.sortable.order,
      table.sortable.sort
    );
  }
};

const doSearch = async (offset, limit, order, sort) => {
  table.isLoading = true;

  let data = {
    page: parseInt(offset / limit) + 1,
    filters: {
      per_page: limit,
      order_by: { [order]: sort },
      ...filters.value,
    },
  };

  const { res, error } = await useAxios("get", url.value, data);

  table.rows = res.value.data.data;
  table.offset = offset;
  table.limit = limit;
  table.sortable.order = order;
  table.sortable.sort = sort;
  table.totalRecordCount = res.value.data.meta.total;
  if (res.value.data.meta.current_page > res.value.data.meta.last_page) {
    table.currentPage = 1;
    doSearch(0, limit, order, sort);
  } else {
    table.currentPage = res.value.data.meta.current_page;
  }
};

doSearch(0, table.pageOptions[0].value, "id", "asc");
</script>
