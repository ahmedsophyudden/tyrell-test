<template>
  <nav aria-label="breadcrumb">
    <ol
      class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb"
      :class="`${layoutStore.isRTL ? '' : ' me-sm-6'} ${layoutStore.isNavFixed ? 'text-dark' : 'text-white' }`"
    >
      <li class="text-sm breadcrumb-item">
        <a
          v-if="layoutStore.isRTL"
          class="opacity-5 ps-2"
          href="#"
          :class="layoutStore.isNavFixed ? 'text-dark' : 'text-white'"
          >لوحات القيادة</a
        >
        <a v-else 
        :class="layoutStore.isNavFixed ? 'text-dark' : 'text-white'"
         class="opacity-8" href="#">Pages</a>
      </li>
      <li
        class="text-sm breadcrumb-item active"
        :class="layoutStore.isNavFixed ? 'text-dark' : 'text-white'"
        aria-current="page"
      >
        {{ currentPage }}
      </li>
    </ol>
    <h6 class="mb-0 font-weight-bolder" :class="layoutStore.isNavFixed ? 'text-dark' : 'text-white'">
      {{ currentPage }}
    </h6>
  </nav>
</template>

<script setup>
import { useLayoutStore } from "@/stores/layout";

const layoutStore = useLayoutStore();

const props = defineProps(["currentPage", "textWhite"]);
// export default {
//   name: "breadcrumbs",
//   props: {
//     currentPage: {
//       required: true
//     },
//     textWhite: {
//       type: String
//     }
//   }
// };
</script>
