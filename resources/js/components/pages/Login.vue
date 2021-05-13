<template>
    <v-container fluid fill-height>
        <v-layout flex align-center justify-center>
            <v-flex xs12 sm8 md9>
                <v-card class="elevation-1">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid">
                            <v-text-field
                                label="E-mail"
                                prepend-icon="person"
                                name="login"
                                type="text"
                                :rules="emailRules"
                                v-model="params.email"
                                required
                            ></v-text-field>
                            <v-text-field
                                label="Password"
                                min="8"
                                id="password"
                                prepend-icon="lock"
                                name="password"
                                type="password"
                                :append-icon="e1 ? 'visibility' : 'visibility_off'"
                                :append-icon-cb="() => (e1 = !e1)"
                                :type="e1 ? 'password' : 'text'"
                                :rules="passwordRules"
                                v-model="params.password"
                                counter
                                required
                            ></v-text-field>
                            <v-layout justify-space-between>
                                <v-btn @click="login" :class=" { 'blue darken-4 white--text' : valid, disabled: !valid }">Login</v-btn>
                            </v-layout>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

</template>
<script>
export default {
    data() {
        return {
            user: {},
            params: {
                email: null,
                password: null,
            },
                e1: true,
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
        login() {
            // get the redirect object
                axios.post('api/auth/login', this.params)
                .then(response => {
                    if (response.status === 200) {
                        this.user = response.data;
                        this.$store.commit('login', this.user);
                        window.localStorage.setItem('authUser', JSON.stringify(this.user))
                        axios.get('api/users/' + this.params,
                        {headers: { 'Authorization' : 'Bearer '+ api_token}})
                            .then(response => {
                                this.user = response.data;
                                console.log(this.user);
                                this.$store.commit('getUser', this.user)
                            });
                        axios.get('api/role',
                            {headers: { 'Authorization' : 'Bearer '+ api_token}})
                            .then(response => {
                                console.log(response.data);
                                this.$store.commit('login', response.data)
                            })

                            this.$router.push('home');
                    }

                })
        },
    }
}
</script>
