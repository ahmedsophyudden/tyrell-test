<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="mx-auto col-lg-9 col-12">
        <div class="card card-body">
          <div class="row">
            <div class="col-lg-6">
              <h4>Players With Cards</h4>
              <p>
                List of player with their cards
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
            </div>
          </div>
          <hr class="my-3 horizontal dark" />
          <div class="row" v-if="playerStore.playerWithCards.length">
            <div class="col-12 col-sm-6" v-for="(playerWithCard, i) in playerStore.playerWithCards" :key="i">
              <label>Player {{ playerWithCard.no }} : {{ playerWithCard.string_cards }}</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePlayerStore } from "@/stores/player";

const playerStore = usePlayerStore();
</script>