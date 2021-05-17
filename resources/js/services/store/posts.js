import axios from 'axios'
import store from "./store";
import {root} from "postcss";

export default {
    namespaced: true,
    state: {
        posts: [],
        newPost: '',
    },

    getters: {
      posts(state) {
          return state.posts;
      }
    },

    mutations: {
        SET_POSTS(state, data) {
            state.posts = data.posts;
        },

        NEW_POST(state, data) {
            state.newPost = data.post
        },

        ADD_CURRENT_USER_ID(state, data) {
            state.newPost.push(data)
        },

        ADD_POST(state) {
            state.posts.push(state.newPost)
        }

    },

    actions: {
        async getAllPosts({ dispatch, commit }) {
            await axios.get('/api/posts')
                .then(response => {
                    commit('SET_POSTS', response.data)
                })
        },

        async getUserPosts({ dispatch, commit }) {
            await axios.get('/api/posts/', store.state.user.id)
                .then(response => {
                    commit('SET_POSTS', response.data)
                    })
        },

        async addNewDeveloperPost({ commit, rootState }, post) {

           // post[ 'user_id' ] = rootState.user.id;
            if (post.user_id === null) {
                post.user_id = rootState.user.id
                console.log(post)
            };
            await axios.post('/api/posts', post)
                .then(response => {
                    commit('NEW_POST', response.data)
                    commit('ADD_POST')
                })
        }
    }


}

