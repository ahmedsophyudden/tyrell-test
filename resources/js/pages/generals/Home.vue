<template>
    <h1>{{ title }}</h1>

    <player-form></player-form>
    <player-with-card-view v-if="playerStore.playerWithCards.length"></player-with-card-view>
</template>

<script setup>
import { usePlayerStore } from "@/stores/player";
import PlayerForm from "@/pages/players/PlayerForm";
import PlayerWithCardView from "@/pages/players/PlayerWithCardView";

const title = 'Playing Card';
const playerStore = usePlayerStore();

</script>