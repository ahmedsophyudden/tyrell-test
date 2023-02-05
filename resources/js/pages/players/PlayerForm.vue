<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="mx-auto col-lg-9 col-12">
        <div class="card card-body">
          <div class="row">
            <div class="col-lg-6">
              <h4>Player Form</h4>
              <p>
                Insert total player and card will be given randomly.
              </p>
            </div>
            <div
              class="
                text-right
                col-lg-6
                d-flex
                flex-column
                justify-content-center
              "
            >
              <argon-button
                @click.prevent="giveCards"
                color="success"
                size="sm"
                variant="gradient"
                class="ms-lg-auto me-lg-0 me-auto mt-lg-0"
                :active="playerStore.loading"
                >Shuffle And Give Card</argon-button
              >
            </div>
          </div>
          <hr class="my-3 horizontal dark" />
          <div class="row">
            <div class="col-12 col-sm-6">
              <label>Total Player</label>
              <argon-input
                type="text"
                placeholder="Total Player"
                name="total_player"
                v-model="total_player"
                size="lg"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useRouter, useRoute } from "vue-router";
import { usePlayerStore } from "@/stores/player";
import ArgonInput from "@argon/components/ArgonInput.vue";
import ArgonButton from "@argon/components/ArgonButton.vue";
import { swalWrapper } from "@/helpers/swal";

const route = useRoute();
const router = useRouter();
const playerStore = usePlayerStore();
const total_player = ref("");

async function giveCards(){
    if(!Number.isInteger(Number(total_player.value)) || Number(total_player.value) < 0){
      return swalWrapper.errorType();
    }
    const { res } = await playerStore.giveCards({total_player: total_player.value});
    if(res.value){
      playerStore.playerWithCards = res.value.data;
    }
}

(async () => {
  total_player.value = playerStore.total_player;
})();
</script>