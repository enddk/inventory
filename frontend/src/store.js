import { createStore } from 'vuex'

export const store = createStore({
    state(){
        return {
            user_id: 0
        }
    },
    mutations: {
        login: (state, id) => {
            state.user_id = id;
        },
        logout: (state) => {
            state.user_id = 0;
        }
    },
})