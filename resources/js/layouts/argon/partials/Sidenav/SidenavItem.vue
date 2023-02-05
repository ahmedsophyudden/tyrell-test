<template>
  <router-link :to="url" class="nav-link" v-bind="$attrs">
    <div
      class="
        icon icon-shape icon-sm
        text-center
        d-flex
        align-items-center
        justify-content-center
      "
    >
      <slot name="icon"></slot>
    </div>
    <span class="nav-link-text" :class="layoutStore.isRTL ? ' me-1' : 'ms-1'">{{
      navText
    }}</span>
  </router-link>

  <div class="collapse">
    <ul class="nav ms-4">
      <li class="nav-item">
        <a href="#/applications/kanban" class="nav-link"
          ><span class="sidenav-mini-icon">K</span
          ><span class="sidenav-normal">Kanban</span></a
        >
      </li>
    </ul>
  </div>
</template>
<script setup>
import { ref } from "vue";
import { useLayoutStore } from "@/stores/layout";

const layoutStore = useLayoutStore();

const props = defineProps(["url", "navText"]);
// const url = ref('');
// const navText = ref('');

// export default {
//   name: "sidenav-item",
//   props: {
//     url: {
//       type: String,
//       required: true
//     },
//     navText: {
//       type: String,
//       required: true
//     }
//   }
// };
</script>
