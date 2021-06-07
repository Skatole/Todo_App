import axios from 'axios'

export default {
    namespaced: true,

    state: {
      developers: '',
        allUsers: '',
    },

    mutations: {
        SET_ALL_USERS(state, data) {
            for (const dataElement of data) {

            }
            state.allUsers = data
        }

    },

   actions: {
      async getAllManagers({ commit }) {
          await axios.get('api/auth/users/managers')
              .then(response => {
                  commit('SET_ALL_USERS', response.data)
              })

      },

      async addReference(user) {
          await axios.post('api/auth/add', user)
              .then(() => {
                  this.$router.push('dashboard')
              })
      }

   }
}
