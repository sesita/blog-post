<script setup>
import Header from "./components/Header.vue";
import { RouterView } from "vue-router";
import store from './store/index.js';

store.dispatch('fetchUser');
</script>

<template>
    <Header class="mb-8"></Header>
    <div class="container mx-auto px-8">
        <RouterView />
    </div>
</template>

