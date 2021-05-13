<template>
    <v-app>
        <template>
            <v-app-bar
                app
                color="white"
                flat
            >
                <v-container class="py-0 fill-height">
                    <v-avatar
                        class="mr-10"
                        color="grey darken-1"
                        size="32"
                    ></v-avatar>

                    <v-btn
                        v-for="link in links"
                        :key="link"
                        text
                    >
                        {{ link }}
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
                </v-container>
            </v-app-bar>

            <v-main class="grey lighten-3">
                <v-container>
                    <router-view></router-view>
<!--                    <v-row>-->
<!--                        <v-col cols="2">-->
<!--                            <v-sheet rounded="lg">-->
<!--                                <v-list color="transparent">-->
<!--                                    <v-list-item-->
<!--                                        v-for="n in 5"-->
<!--                                        :key="n"-->
<!--                                        link-->
<!--                                    >-->
<!--                                        <v-list-item-content>-->
<!--                                            <v-list-item-title>-->
<!--                                                List Item {{ n }}-->
<!--                                            </v-list-item-title>-->
<!--                                        </v-list-item-content>-->
<!--                                    </v-list-item>-->

<!--                                    <v-divider class="my-2"></v-divider>-->

<!--                                    <v-list-item-->
<!--                                        link-->
<!--                                        color="grey lighten-4"-->
<!--                                    >-->
<!--                                        <v-list-item-content>-->
<!--                                            <v-list-item-title>-->
<!--                                                Refresh-->
<!--                                            </v-list-item-title>-->
<!--                                        </v-list-item-content>-->
<!--                                    </v-list-item>-->
<!--                                </v-list>-->
<!--                            </v-sheet>-->
<!--                        </v-col>-->

<!--                        <v-col>-->
<!--                            <v-sheet-->
<!--                                min-height="70vh"-->
<!--                                rounded="lg"-->
<!--                            >-->
<!--                                &lt;!&ndash;  &ndash;&gt;-->
<!--                            </v-sheet>-->
<!--                        </v-col>-->
<!--                    </v-row>-->
                </v-container>
            </v-main>
        </template>


        </v-app>
</template>
<script>

import Sidebar from "./components/_sidebar";
import Navbar from "./components/_navbar";

export default {
    components: { Sidebar, Navbar },
    data() {
        return {
            drawer: null,
            links: [
                'Dashboard',
                'Messages',
                'Profile',
                'Updates',
            ],
        }
    },
}
</script>

<style >

</style>
