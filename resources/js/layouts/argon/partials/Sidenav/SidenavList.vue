<template>
  <div
    class="collapse navbar-collapse w-auto h-auto h-100"
    id="sidenav-collapse-main"
  >
    <ul class="navbar-nav">
      <li class="nav-item">
        <sidenav-item
          url="/"
          :class="getRoute() === '' ? 'active' : ''"
          :navText="layoutStore.isRTL ? 'لوحة القيادة' : 'Home'"
        >
          <template v-slot:icon>
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </template>
        </sidenav-item>
      </li>
      <!-- <li class="nav-item">
        <sidenav-item
          url="/users"
          :class="getRoute() === 'users' ? 'active' : ''"
          :navText="layoutStore.isRTL ? 'لوحة القيادة' : 'Users'"
        >
          <template v-slot:icon>
            <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
          </template>
        </sidenav-item>
      </li> -->
    </ul>
  </div>
  <!-- <div class="pt-3 mx-3 mt-3 sidenav-footer">
    <sidenav-card
      :class="cardBg"
      textPrimary="Need Help?"
      textSecondary="Please check our docs"
    />
  </div> -->
</template>
<script setup>
import SidenavItem from "./SidenavItem.vue";
import SidenavCard from "./SidenavCard.vue";
import { ref } from "vue";
import { useRoute } from 'vue-router'
import { useLayoutStore } from "@/stores/layout";

const title = "Tyrell Test";
const controls = "dashboardsExamples";
const isActive = "active";

const props = defineProps(["cardBg"]);
// props: {
//     cardBg: String
//   },

const route = useRoute();
const layoutStore = useLayoutStore();

function getRoute() {
  const routeArr = route.path.split("/");
  return routeArr[1];
}
</script>
