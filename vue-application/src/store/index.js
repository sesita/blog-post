import { domain } from '../env'
import axios from 'axios'
import { createStore } from "vuex";

export default createStore({
    state: {
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        logoutUser(state) {
            localStorage.removeItem('accessToken');
            state.user = null;
        }
    },
    actions: {
        async fetchUser({ commit }) {
            try {
                const response = await axios.post(`${domain}/Auth/Me`);
                commit('setUser', response.data);
            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },
        async logout({ commit }) {
            try {
                await axios.post(`${domain}/Auth/Logout`);
                commit('logoutUser');
            } catch (error) {
                console.error('Error logging out:', error);
            }
        }
    }
});
