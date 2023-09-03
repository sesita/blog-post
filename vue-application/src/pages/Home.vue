<script setup>
import Post from '../components/Post.vue';
import axios from 'axios';
import { ref } from 'vue';
import { domain } from '../env';
import { RouterLink } from 'vue-router';

const posts = ref([]);
const comments = ref([]);

axios.get(`${domain}/posts`, {
    params: {
        limit: 2
    }
}).then(res => {
    posts.value = res.data;
});


</script>
<template>
    <div class="flex justify-between items-center mb-4 pr-4">
        <h1 class="text-4xl">Last Posts</h1>
        <RouterLink :to="{name: 'Posts'}" class="text-blue-500">View All</RouterLink>
    </div>
    <div class="grid gap-8 lg:grid-cols-2 mb-12">
        <Post v-for="post in posts.data" :key="post.id" :data="post"></Post>
    </div>
</template>
