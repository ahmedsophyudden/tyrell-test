<template>
  <div
    v-show="layoutStore.layout === 'landing'"
    class="landing-bg h-100 bg-gradient-primary position-fixed w-100"
  ></div>
  <sidenav :custom_class="layoutStore.mcolor" v-if="layoutStore.showSidenav" />
  <main
    class="
      main-content
      position-relative
      max-height-vh-100
      h-100
      border-radius-lg
    "
  >
    <!-- nav -->
    <navbar
      :class="[navClasses]"
      :textWhite="
        layoutStore.isAbsolute ? 'text-white opacity-8' : 'text-white'
      "
      :minNav="layoutStore.navbarMinimize"
      v-if="layoutStore.showNavbar"
    />
    <router-view />
    <app-footer v-show="layoutStore.showFooter" />
    <configurator
      :toggle="layoutStore.toggleConfigurator"
      :class="[
        layoutStore.showConfig ? 'show' : '',
        layoutStore.hideConfigButton ? 'd-none' : '',
      ]"
    />
  </main>
</template>

<script setup>
import Sidenav from "./partials/Sidenav";
import Configurator from "./partials/Configurator.vue";
import Navbar from "./partials/Navbars/Navbar.vue";
import AppFooter from "./partials/Footer.vue";

import { computed, onBeforeMount } from "vue";
import { useLayoutStore } from "@/stores/layout";

const layoutStore = useLayoutStore();

const navClasses = computed(() => {
  return {
    "position-sticky bg-white left-auto top-2 z-index-sticky":
      layoutStore.isNavFixed && !layoutStore.darkMode,
    "position-sticky bg-default left-auto top-2 z-index-sticky":
      layoutStore.isNavFixed && layoutStore.darkMode,
    "position-absolute px-4 mx-0 w-100 z-index-2": layoutStore.isAbsolute,
    "px-0 mx-4": !layoutStore.isAbsolute,
  };
});

onBeforeMount(() => {
  layoutStore.isTransparent = "bg-white";
});
</script>

<style scoped>
::v-deep(.vtl-table .vtl-thead .vtl-thead-th) {
  color: #000;
  background-color: #d4ffe3;
  border-color: #99ffd2;
}

::v-deep(.vtl-paging-info div) {
  padding-left: 0.5em;
}

::v-deep(a.vtl-paging-pagination-page-link span) {
  width: 0px !important;
  height: auto !important;
}

::v-deep(a.vtl-paging-pagination-page-link-first span) {
  color: #007bff;
}

::v-deep(a.vtl-paging-pagination-page-link-prev span) {
  color: #007bff;
}

::v-deep(a.vtl-paging-pagination-page-link-next span) {
  color: #007bff;
}

::v-deep(a.vtl-paging-pagination-page-link-last span) {
  color: #007bff;
}

::v-deep(.page-item.disabled
    a.vtl-paging-pagination-page-link-first span) {
  color: #6c757d;
  pointer-events: none;
  cursor: auto;
  background-color: #fff;
  border-color: #dee2e6;
}

::v-deep(.page-item.disabled
    a.vtl-paging-pagination-page-link-prev span) {
  color: #6c757d;
  pointer-events: none;
  cursor: auto;
  background-color: #fff;
  border-color: #dee2e6;
}

::v-deep(.page-item.disabled
    a.vtl-paging-pagination-page-link-next span) {
  color: #6c757d;
  pointer-events: none;
  cursor: auto;
  background-color: #fff;
  border-color: #dee2e6;
}

::v-deep(.page-item.disabled
    a.vtl-paging-pagination-page-link-last span) {
  color: #6c757d;
  pointer-events: none;
  cursor: auto;
  background-color: #fff;
  border-color: #dee2e6;
}
</style>