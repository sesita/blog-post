import { createRouter, createWebHistory } from 'vue-router'

// Web Components
import Home from '../pages/Home.vue'
import Posts from '../pages/Posts.vue'
import PostView from '../pages/PostView.vue'
import PostsIndex from '../pages/Posts/Index.vue'
import PostsUpdate from '../pages/Posts/Update.vue'
import Login from '../pages/Auth/Login.vue'
import Register from '../pages/Auth/Register.vue'
import store from '../store/index';

const isAuthenticated = (to, from, next) => {
    if(store.state.user){
       next();
    } else {
        next({name: 'Login'});
    }
}

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '',
            name: 'Home',
            component: Home
        },
        {
            path: '/Posts',
            name: 'Posts',
            component: Posts
        },
        {
            path: '/Post/:id?',
            name: 'PostView',
            component: PostView
        },
        {
            path: '/Crud',
            // beforeEnter: isAuthenticated,
            children: [
                {
                    path: 'Posts',
                    name: 'Posts.Index',
                    component: PostsIndex
                },
                {
                    path: 'Posts/Update/:id?',
                    name: 'Posts.Update',
                    component: PostsUpdate,
                }
            ],
        },
        {
            path: '/Auth',
            children: [
                {
                    path: 'Login',
                    name: 'Login',
                    component: Login
                },
                {
                    path: 'Register',
                    name: 'Register',
                    component: Register
                }
            ]
        }
    ]
})

export default router