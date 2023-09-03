import { createApp } from 'vue'
import App from './App.vue'
import './base.css'
import 'flowbite';
import router from './router'
import axios from 'axios';

axios.interceptors.request.use(
    (config) => {
        const accessToken = localStorage.getItem('accessToken');
        if (accessToken) {
            config.headers.Authorization = `Bearer ${accessToken}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

const app = createApp(App)
app.use(router)

app.mount('#app')
