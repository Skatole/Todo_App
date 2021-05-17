<template>
</template>
<script>

import {mapActions, mapGetters} from "vuex";
import Swal from "sweetalert2";

export default {
    name: 'AutoLogout',

    data() {
        return {
            events: ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load', this.$store.getters["auth/authenticated"]],
            warningTimer: null,
            logOutTimer: null,
            warningZone: false,
        }
    },
    computed: {},

    mounted() {
        const vm = this;
        this.events.forEach((event) => {
            if (event) {
                window.addEventListener(event, this.resetTimer);
            }
        })

        this.setTimers();
    },

    methods: {
        ...mapActions({
            logOutAction: 'logout'
        }),

        setTimers() {
            this.warningTimer = setTimeout(this.warningMessage, 14 * 60 * 1000); // 14min = 14 * 60 * 1000

        },

        warningMessage() {
            this.logoutTimer = setTimeout(this.logOut, 60 * 1000); // 1min after warning
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 60 * 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter' || 'click', Swal.stopTimer, this.resetTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'info',
                title: 'Sign out due to inactivity'
            })
        },
        logOut() {
            if (this.$store.getters["auth/authenticated"]) {
                this.logOutAction()
            }
        },
        resetTimer() {
            clearTimeout(this.warningTimer);
            clearTimeout(this.logOutTimer)
            this.setTimers();
        }
    }
}
</script>
