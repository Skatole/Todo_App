import axios from 'axios'
import store from "./store";
import { root } from "postcss";

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

        ADD_POST(state) {
            state.posts.push(state.newPost)
        },

        UPDATE_POSTS_SCOPE(state, data) {
            state.posts = [];
            state.posts = data

        },

    },

    actions: {
        async getAllPosts({ commit }) {
            await axios.get('/api/posts')
                .then(response => {
                    commit('SET_POSTS', response.data)

                })
        },

        async getUserPosts({ commit, rootGetters }, user) {
            await axios.get('/api/posts/' + user.id)
                .then(response => {
                    commit('UPDATE_POSTS_SCOPE', response.data.posts)
                })
        },

        async getReferencedPosts({commit, rootGetters}, user) {
            let refPost = rootGetters["referencedUserPosts"]
            for (const element of refPost) {

                if (user.id === element.pivot.reference_id) {
                    commit('UPDATE_POSTS_SCOPE', refPost)
                    console.log(refPost)
                }
            }
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
        },

        async updatePost({ commit }, post) {
            axios.put('/api/posts/' + post.id, post)
                .then(response => {
                    commit('NEW_POST', response.data)
                    commit('ADD_POST')
                })
        },

        async deletePost( post) {
            axios.delete("/api/posts/" + post.id)
        },

        async postReference({commit, rootGetters}) {
            commit('UPDATE_POSTS_SCOPE', rootGetters['referencedPosts'])
        }
    }


}

