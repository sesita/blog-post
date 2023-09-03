<script setup>
import { ref } from 'vue';
import env from '/src/env';
import axios from 'axios';
import store from "../../store/index";
import { useRouter } from 'vue-router';

const user = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const error = ref(null);
const router = useRouter();

const register = () => {
    error.value = null;
    axios.post(`${env.domain}/Auth/Register`, user.value).then(res => {
        router.push({ name: 'Login' });
    }).catch(err => {
        error.value = err.response.data;
    });
};
</script>
<template>
    <div class="flex flex-col items-center justify-center px-6 mx-auto py-8">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create Account
                </h1>
                <form class="space-y-4 md:space-y-6" @submit.prevent="register">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            name</label>
                        <input type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Name..." required="" v-model="user.name">
                        <span class="text-red-600 text-sm" v-if="error?.name">{{ error.name?.message }}</span>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" required="" v-model="user.email">
                        <span class="text-red-600 text-sm" v-if="error?.email">{{ error.email?.message }}</span>
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="" v-model="user.password">
                        <span class="text-red-600 text-sm" v-if="error?.password">{{ error.email?.message }}</span>
                    </div>
                    <div>
                        <label for="confirm-password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                            password</label>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="" v-model="user.password_confirmation">
                    </div>
                    <div v-if="error">
                        <span class="text-red-600 text-sm">{{ error }}</span>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Create an account
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account?
                        <RouterLink :to="{ name: 'Login' }"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                            Login here
                        </RouterLink>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>