<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { domain } from '../../env';
import { RouterLink } from 'vue-router';

const posts = ref([]);

const getPosts = () => {
    axios.get(`${domain}/posts`).then(res => {
        posts.value = res.data;
    });
};

getPosts();

const goToPage = (url) => {
    axios.get(url).then(response => {
        posts.value = response.data;
    });
}
const deletePost = (id) => {
    axios.delete(`${domain}/posts/${id}`).then(res => {
        getPosts();
    });
};

</script>
<template>
    <div class="flex justify-between mb-8">
        <h1 class="text-3xl font-medium">Posts Crud</h1>
        <RouterLink :to="{ name: 'Posts.Update' }" class="border-0 bg-blue-600 text-white px-6 py-3 rounded-lg">Create
        </RouterLink>
    </div>

    <div class="relative overflow-x-auto shadow-[0px_0px_14px_0px_rgba(0,0,0,0.15)] rounded-xl">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b" v-for="post in posts.data" :key="post.id">
                    <td class="px-6 py-4 text-blue-400">
                        <RouterLink :to="{ name: 'PostView', params: { id: post.id } }" class="w-full">
                            {{ post.id }}
                        </RouterLink>
                    </td>
                    <td scope="row" class="px-6 py-4">
                        {{ post.title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ post.author.name }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-4">
                            <RouterLink :to="{ name: 'Posts.Update', params: { id: post.id } }"
                                class="bg-blue-600 p-4 text-white px-6 py-3 rounded-lg">
                                Edit
                            </RouterLink>
                            <button class="bg-red-600 p-4 text-white px-6 py-3 rounded-lg"
                                @click="deletePost(post.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>