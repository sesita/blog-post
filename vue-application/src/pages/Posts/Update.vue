<script setup>
import { ref } from 'vue';
import { domain } from '../../env';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const post = ref({
    title: '',
    body: '',
    publish_date: '',
});

const error = ref(null);
const route = useRoute();
const router = useRouter();

const postUpd = async () => {
    error.value = null;
    if (route.params.id) {
        const res = await axios.patch(`${domain}/posts/${route.params.id}`, post.value);
        post.value = res.data;
    } else {
        const res = await axios.post(`${domain}/posts`, post.value);
        post.value = res.data;
    }
    router.push({name: 'Posts.Index'});
};

if (route.params.id) {
    axios.get(`${domain}/posts/${route.params.id}`).then(res => {
        post.value = res.data;
    });
}

</script>
<template>
    <div class="lg:w-1/2 mx-auto">
        <form @submit.prevent="postUpd">
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-none"
                    placeholder="Title..." required v-model="post.title">
                <span class="text-red-600 text-sm" v-if="error?.title">{{ error.title?.message }}</span>
            </div>
            <div class="mb-6">
                <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
                <textarea id="body"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-none"
                    placeholder="Body..." rows="4" v-model="post.body"></textarea>
                <span class="text-red-600 text-sm" v-if="error?.body">{{ error.body?.message }}</span>

            </div>
            <div class="mb-6">
                <label for="publish_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publish
                    Date</label>
                <input type="datetime-local" id="publish_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-none"
                    v-model="post.publish_date" required>
                <span class="text-red-600 text-sm" v-if="error?.publish_date">{{ error.publish_date?.message }}</span>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ route.params.id ? 'Update' : 'Create' }}
            </button>
        </form>
    </div>
</template>