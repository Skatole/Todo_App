<template>
    <div>
        <v-app-bar
            app
            color="white"
            flat
        >
            <v-container class="py-0 fill-height">

<!--                Authenticated=false             -->
                <template v-if="!authenticated">
                <v-btn
                    class="flex align-content-around"
                    text>
                    <router-link to="login">Login</router-link>

                </v-btn>
                <v-btn
                    class="flex align-content-around"
                    text>
                    <router-link to="register">Register</router-link>
                </v-btn>
                </template>

<!--                Authenticated=true                  -->
                <template v-else-if="authenticated">
                    <v-avatar
                        class="mr-10"
                        color="grey darken-1"
                        size="32"
                    ></v-avatar>
                    <li v-for="role in user.role"> {{role.name}}</li>
                    <v-btn
                        class="flex align-content-around"
                        text>
                        <router-link to="home">Home</router-link>

                    </v-btn>

                    <v-btn
                        class="flex align-content-around"
                        text>
                        <router-link to="add">Add</router-link>

                    </v-btn>
                    <v-btn
                        class="flex align-content-around"
                        text>
                        <a href="#" @click.prevent="logOut">Logout</a>

                    </v-btn>

                <v-spacer></v-spacer>

                <v-responsive max-width="260">
                    <v-text-field
                        dense
                        flat
                        hide-details
                        rounded
                        solo-inverted
                    ></v-text-field>
                </v-responsive>
                </template>
            </v-container>
        </v-app-bar>
    </div>
</template>

<script>

import { mapGetters, mapActions} from 'vuex'

export default {
    data() {
        return {}
    },

    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',

        })
    },

    methods: {
        ...mapActions({
            logOutAction: 'auth/logout'
        }),

        logOut() {
            this.logOutAction()

        }
    }
}
</script>
