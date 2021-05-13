<template>
    <v-toolbar  fixed>
        <v-toolbar-items @click.stop="drawer = !drawer"></v-toolbar-items>
        <v-toolbar-title>Todo App</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-menu
            offset-y
            origin="center center"
            class="elevation-1"
            :nudge-bottom="14"
            transition="scale-transition"
        >
            <!--            <v-btn @click="markAsRead" icon flat slot="activator">-->
            <!--                <v-badge color="red" overlap>-->
            <!--                    <span slot="badge">{{unreadNotifications.length}}</span>-->
            <!--                    <v-icon medium>notifications</v-icon>-->
            <!--                </v-badge>-->
            <!--            </v-btn>-->

            <!--            <v-list>-->
            <!--                <v-list-item :class="{'green': notification.read_at==null}" @click="markAsRead" v-for="notification in allNotifications" :key="notification.id">-->
            <!--                    <v-list-item-content>-->
            <!--                        <v-list-item-title>{{notification.data.createdUser.name}} has just registered on {{notification.created_at}}</v-list-item-title>-->
            <!--                    </v-list-item-content>-->
            <!--                </v-list-item>-->
            <!--            </v-list>-->
        </v-menu>
        <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
            <v-btn icon large text
                   d
            >
                <v-avatar size="30px">
                    <img src="https://via.placeholder.com/150" alt="Michael Wang">
                </v-avatar>
            </v-btn>
            <v-list class="pa-0">
                <v-list-item ripple="ripple" rel="noopener">
                    <v-list-item-content>
                        <v-list-item-title>{{this.$store.state.user.name}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list class="pa-0">
                <v-list-item @click="logout" ripple="ripple" rel="noopener">
                    <v-list-item-action>
                        <v-icon>account_circle</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-toolbar>
</template>


<script>
export default {
    data: () => ({
        drawer: null,
        // allNotifications: [],
        // unreadNotifications: [],
    }),
    // watch:{
    //     allNotifications(val){
    //         this.unreadNotifications =  this.allNotifications.filter(notification => {
    //             return notification.read_at == null;
    //         });
    //     }
    // },
    methods: {

        logout() {
            axios.post('api/logout')
                .then(() => {
                    this.$store.state.user.isLoggedIn = !this.$store.state.user.isLoggedIn ;
                    this.$router.push('login');
                });
        }

        // markAsRead() {
        //     axios.get("/mark-all-read/" + this.user.id).then(response=>{
        //         this.unreadNotifications = [];
        //     });
        // }
    },

    created() {
        // this.allNotifications = this.user.notifications;
        // this.unreadNotifications =  this.allNotifications.filter(notification => {
        //     return notification.read_at == null;
        // });
        // Echo.private("App.User." + this.user.id).notification(notification => {
        //   this.allNotifications.unshift(notification.notification);
        // });
    }
};
</script>
