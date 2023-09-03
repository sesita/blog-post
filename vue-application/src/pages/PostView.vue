<script setup>
import { ref, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { domain } from '../env';
import axios from 'axios';
import store from '../store/index.js'

const route = useRoute();
const error = ref(null);
const post = ref([]);
const comment = ref({
    body: null,
});
const user = computed(() => store.state.user)

const getPost = () => {
    axios.get(`${domain}/posts/${route.params.id}`).then(res => {
        post.value = res.data;
    });
};

if (route.params.id) {
    getPost();
}

const addComment = () => {
    axios.post(`${domain}/posts/${route.params.id}/comments`, comment.value).then(res => {
        comment.value.body = null;
        getPost();
    }).catch(err => {
        error.value = err.response.data;
    });
};
const deleteComment = (commentId) => {
    axios.delete(`${domain}/posts/${route.params.id}/comments/${commentId}`).then(res => {
        getPost();
    }).catch(err => {
        error.value = err.response.data;
    });
};
</script>
<template>
    <main class="pt-8 pb-16 lg:pb-24 bg-white dark:bg-gray-900">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full" src="../assets/user.webp" alt="Jese Leos">
                            <div>
                                <a rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{
                                    post?.author?.name }}</a>
                                <p class="text-base font-light text-gray-500 dark:text-gray-400"><time pubdate
                                        datetime="2022-02-08" title="February 8th, 2022">{{ post.publish_date }}</time></p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ post.title }}
                    </h1>
                </header>
                <div class="mb-4">
                    {{ post.body }}
                </div>
                <section class="not-format">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{
                            post.comments?.length }})</h2>
                    </div>
                    <form class="mb-6" @submit.prevent="addComment" v-if="user">
                        <div
                            class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="6"
                                class="outline-none px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                placeholder="Write a comment..." required v-model="comment.body"></textarea>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Post comment
                        </button>
                    </form>
                    <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900"
                        v-for="comment in post.comments" :key="comment.id">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                                        class="mr-2 w-6 h-6 rounded-full" src="../assets/user.webp" alt="Michael Gough">{{
                                            comment.user?.name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">{{ comment.created_at }}</time></p>
                            </div>
                            <button
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button" @click="deleteComment(comment.id)">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1"
                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                </svg>
                            </button>
                        </footer>
                        <p>{{ comment.body }}</p>
                    </article>
                </section>
            </article>
        </div>
    </main>
</template>