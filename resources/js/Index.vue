<template>
    <v-app>
        <v-main class="grey darken-4">
            <navbar/>
            <v-container>
                <div v-if="$store.getters['authenticated']">
                <AutoLogout/>
                </div>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>

import Sidebar from "./components/_sidebar";
import Navbar from "./components/_navbar";
import AutoLogout from './components/AutoLogout'

export default {
    components: {Sidebar, Navbar, AutoLogout},
    data() {
        return {
            drawer: null,

        }
    },
}
</script>

<style>

</style>
