<template>
    <v-container fill-height fluid>
        <v-layout align-center flex justify-center>
            <v-flex md9 sm8 xs12>
                <v-card class="elevation-1">
                    <v-toolbar color="primary" dark>
                        <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid" @submit.prevent="login">
                            <v-text-field
                                v-model="params.email"
                                :rules="emailRules"
                                label="E-mail"
                                name="login"
                                prepend-icon="person"
                                required
                                type="text"
                            ></v-text-field>
                            <v-text-field
                                id="password"
                                v-model="params.password"
                                :append-icon="isVisible ? 'visibility' : 'visibility_off'"
                                @click:append-icon-cbs="isVisible = !isVisible"
                                :rules="passwordRules"
                                :type="isVisible ? 'password' : 'text'"
                                counter
                                label="Password"
                                min="8"
                                name="password"
                                prepend-icon="lock"
                                required
                                type="password"
                            ></v-text-field>
                            <v-layout justify-space-between>
                                <v-btn
                                    :class=" { 'blue darken-4 white--text' : valid, disabled: !valid }"
                                    type="submit">
                                    Login
                                </v-btn>
                            </v-layout>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

</template>
<script>
import {mapActions} from 'vuex'

export default {
    data() {
        return {
            params: {
                email: null,
                password: null,
            },
            isVisible: false,
            valid: false,
            passwordRules: [
                (v) => !!v || 'Password is required',
            ],
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
        }
    },
    mounted() {
        //
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        login() {
            // console.log(this.params)
            this.signIn(this.params)
                .then(() => {
                    this.$router.replace({
                        name: 'home'
                    })
                }).catch(() => {
                this.$router.replace({
                    name: 'login'
                })
            });

        }

        // get the redirect object
        //     axios.post('api/auth/login', this.params)
        //     .then(response => {
        //         if (response.status === 200) {
        //             this.user = response.data;
        //             this.$store.commit('login', this.user);
        //             window.localStorage.setItem('authUser', JSON.stringify(this.user))
        //             axios.get('api/users/' + this.params,
        //             {headers: { 'Authorization' : 'Bearer '+ api_token}})
        //                 .then(response => {
        //                     this.user = response.data;
        //                     console.log(this.user);
        //                     this.$store.commit('getUser', this.user)
        //                 });
        //             axios.get('api/role',
        //                 {headers: { 'Authorization' : 'Bearer '+ api_token}})
        //                 .then(response => {
        //                     console.log(response.data);
        //                     this.$store.commit('login', response.data)
        //                 })
        //
        //                 this.$router.push('home');
        //         }
        //
        //     })
    },
}
</script>
