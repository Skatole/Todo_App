<template>
    <v-container fill-height fluid>
        <v-layout align-center flex justify-center>
            <v-flex md9 sm8 xs12>
                <v-card class="elevation-1">
                    <v-toolbar color="primary" dark>
                        <v-toolbar-title>Register form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid" @submit.prevent="register">
                            <v-text-field
                                v-model="params.name"
                                :rules="rules.nameRules"
                                label="Name"
                                name="Name"
                                prepend-icon="person"
                                required
                                type="text"
                            ></v-text-field>
                            <v-text-field
                                v-model="params.email"
                                :rules="rules.emailRules"
                                label="E-mail"
                                name="Email"
                                prepend-icon="person"
                                required
                                type="text"
                            ></v-text-field>
                            <v-text-field
                                id="password"
                                v-model="params.password"
                                :append-icon="passwordVisible ? 'visibility' : 'visibility_off'"
                                :error-messages="errorMessages"
                                :rules="rules.PasswordRules"
                                :type="passwordVisible ? 'password' : 'text'"
                                :value="passwordVisible"
                                counter
                                label="Password"
                                name="password"
                                prepend-icon="lock"
                                required
                                @click:append="() => (passwordVisible = !passwordVisible)"
                            ></v-text-field>
                            <v-text-field
                                id="password2"
                                v-model="params.password_confirmation"
                                :append-icon="confirmPasswordVisible ? 'visibility' : 'visibility_off'"
                                :error-messages="errorMessages"
                                :rules="rules.PasswordConfirmationRules"
                                :type="confirmPasswordVisible ? 'password' : 'text'"
                                :value="confirmPasswordVisible"
                                counter
                                label="Confirm Password"
                                name="password"
                                prepend-icon="lock"
                                required
                                @click:append="() => (confirmPasswordVisible = !confirmPasswordVisible)"
                            ></v-text-field>


                            <v-select
                                v-model="params.role"
                                :items="roles"
                                item-text="name"
                                item-value="id"
                                label="Role">
                            </v-select>


                            <v-layout justify-space-between>
                                <v-btn
                                    :class=" { 'blue darken-4 white--text' : valid, disabled: !valid }"
                                    :disabled="!valid"
                                    type="submit"
                                >
                                    Register
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
            valid: false,
            passwordVisible: true,
            confirmPasswordVisible: true,
            params: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                role: '',
            },
            roles: [],
            errorMessages: [],
            rules: {
                nameRules: [
                    v => !!v || "Name is required",
                    v => (v && v.length <= 20) || "Name must be less than 20 characters"
                ],
                emailRules: [
                    v => !!v || "E-mail is required",
                    v => /.+@.+/.test(v) || "E-mail must be valid"
                ],
                PasswordRules: [v => !!v || "Password is required", v => (v && v.length >= 3) || "password must be valid"],
                PasswordConfirmationRules: [
                    v => !!v || "Password is required",
                    v => (v && v.length >= 3) || "password must be valid",
                    v => (this.params.password_confirmation === this.params.password) || "Passwords are not identical. The password confirmation does not match.."
                ],
            },
        }
    },

    async created() {

        await axios.get('api/roles')
            .then(response => {
                for (let responseElement of response.data.roles) {
                    if (responseElement["name"] !== "Admin") {
                        this.roles.push(responseElement);

                    }
                }
            })
    },

    methods: {
        register() {
            axios.post('api/auth/register', this.params)
                .then(response => {
                    this.$router.replace("login");
                }).catch((e) => {
                    console.log(e);
            })

        },


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
