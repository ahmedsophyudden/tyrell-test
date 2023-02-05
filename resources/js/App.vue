<template>
  <component :is="selectLayout($route.meta.layout)" />
</template>
 
<script setup>
import ArgonLayout from "@/layouts/argon";

import { computed, onMounted } from "vue";
import { useRoute } from "vue-router";

function selectLayout(layout){
  if(layout == 'ArgonLayout'){
    return ArgonLayout;
  }
}
</script> 