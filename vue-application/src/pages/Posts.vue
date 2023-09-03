<script setup>
import Post from '../components/Post.vue';
import axios from 'axios';
import { ref } from 'vue';
import { domain } from '../env';

const posts = ref([]);

axios.get(`${domain}/posts`).then(res => {
    posts.value = res.data;
});

const goToPage = (url) => {
    axios.get(url).then(response => {
        posts.value = response.data;
    });
}

</script>
<template>
    <h1 class="text-4xl mb-4">All Posts</h1>
    <div class="grid gap-8 lg:grid-cols-2 mb-12">
        <Post v-for="post in posts.data" :key="post.id" :data="post"></Post>
    </div>
    <div class="flex items-center justify-center mt-4" v-if="posts?.total > posts?.per_page">
        <nav class="flex items-center">
            <button type="button" v-for="link in posts?.links" :key="link.label" @click="goToPage(link.url)"
                :class="[
                    'px-3 py-2 transition-all transition-200 cursor-pointer',
                    link.active ? 'text-blue-500 font-bold' : 'text-gray-500',
                    'hover:text-blue-500'
                ]" :disabled="!link.url" v-html="link.label">
            </button>
        </nav>
    </div>
</template>
