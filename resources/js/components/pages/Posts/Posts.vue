<template>
    <div>
<!--                <div class="row justify-content-between pb-2">-->
<!--                    <select v-model="params.category_id" class="form-control col-md-5">-->
<!--                        <option value="">&#45;&#45; choose category &#45;&#45;</option>-->
<!--                        <option v-for="category in categories"-->
<!--                                :value="category.id">-->
<!--                            {{ category.name }}-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </div>-->
                <div>
                    <v-container>


                        <v-row>
                            <v-col>
                                <v-card>
                                    <v-card-title>

                            <v-responsive max-width="260">
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="Search"
                                    single-line
                                    dense
                                    flat
                                    hide-details
                                    rounded
                                    solo-inverted
                                ></v-text-field>
                            </v-responsive>
                                    </v-card-title>
                                </v-card>
                                <v-data-table
                                    :headers="headers"
                                    :items="params"
                                    :items-per-page="2"
                                    :search="search"
                                    class="elevation-1">
                                    <template v-slot:item.actions="{item}">
                                        <v-icon small @click="deleteItem(item.id)">mdi-delete</v-icon>
                                    </template>
                                </v-data-table>

                            </v-col>
                        </v-row>
                    </v-container>
                </div>

    </div>
</template>

<script>


// import SwitchButton from "./SwitchButton";

import {mapActions, mapGetters} from "vuex";

export default {
    name: 'Posts',
    components: {
        // SwitchButton
    },

    data() {
        return {
            search: '',

            params: [
                {
                    title: '',
                    task: '',
                    is_task_done: '',
                    created_at: '',
                    deadline: ''
                }
            ],

        }
    },

    computed: {
        headers() {
            return [
                {text: "Title", align: 'start', filterable: true, value: "title"},
                {text: "Task", filterable: true, value: "task"},
                {text: "Created", filterable: true, value: "created_at"},
                {text: "Deadline", filterable: true, value: "deadline"},
                {text: "Actions", filterable: false, sortable: false, value: "actions"},

            ];
        }
    },

    created() {
        this.getAllTasks()
    },

    methods: {
        getAllTasks() {
          return this.$store.dispatch('posts/getAllPosts')
            .then(() => {
                this.params = this.$store.getters['posts/posts'];
            })
        },
       async deleteItem(id) {
           await this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0f6848',
                cancelButtonColor: '#731e1e',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    this.params.splice(id, 1);
                    for (let param of this.params) {
                        if (id === param.id) {
                            axios.delete('/api/posts/' + id)
                                .then(() => {
                                    this.$swal('Post deleted successfully');
                                    this.getAllTasks();
                                }).catch(() => {
                                this.$swal({icon: 'error', title: 'Error happened'});
                            })
                        }
                    }
                }
            });
        },
    },
}

</script>

<style>

</style>
