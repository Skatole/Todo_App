<template>
    <div>
        <v-container fill-height fluid>
            <v-layout align-center flex justify-center>
                <v-flex md9 sm8 xs12>
                    <v-card class="elevation-1">
                        <v-toolbar color="primary" dark>
                            <v-toolbar-title color="primary" >Register form</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form  v-model="valid"  @submit.prevent="addPost">
                                <v-container>
                                    <v-row
                                        justify="space-between"
                                        class="darken-4">
                                        <v-col>

                                            <v-text-field
                                                v-model="params.title"
                                                :counter="10"
                                                :rules="rules.titleRules"
                                                dense
                                                filled
                                                label="Post title"
                                                required
                                                rounded
                                            ></v-text-field>

                                        </v-col>
                                        <v-col>

                                            <v-textarea
                                                v-model="params.task"
                                                :rules="rules.taskRules"
                                                dense
                                                filled
                                                label="Task"
                                                required
                                                rounded
                                            ></v-textarea>

                                        </v-col>
                                        <v-col>

                                            <v-datetime-picker
                                                v-model="params.deadline"
                                                datetime="Date"
                                                label="Select Deadline"></v-datetime-picker>

                                        </v-col>
                                        <!--            Category:-->
                                        <!--            <select v-model="params" class="form-control">-->
                                        <!--                <option-->
                                        <!--                    v-for="category in categories"-->
                                        <!--                    :value="category.id">{{ category.name }}-->
                                        <!--                </option>-->
                                        <!--            </select>-->
                                        <!--            <div v-if="errors && errors.category_id" class="alert alert-danger">-->
                                        <!--                {{ errors.category_id[0] }}-->
                                        <!--            </div>-->
                                        <!--            <br/>-->
                                        <v-btn
                                            :disabled="!valid"
                                            :class=" { 'blue darken-4 white--text' : valid, disabled: !valid }"
                                            color="success"
                                            class="mr-4"
                                            type="submit"
                                        >
                                            Add
                                        </v-btn>

                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>



    </div>
</template>

<script>

import {mapActions} from "vuex";

export default {

    data() {
        return {
            valid: false,
            params: {
                title: '',
                task: '',
                deadline: '',
                user_id: null,
                is_task_done: false
            },
            rules: {
                titleRules: [
                    v => !!v || 'Title is required'
                ],
                taskRules: [
                    v => !!v || 'Task is required'
                ],
                deadlineRules: [
                    v => !!v || 'Deadline is required'
                ],
            },
            errors: {},
        }
    },
    mounted() {

    },
    methods: {
        ...mapActions({
           add: 'posts/addNewDeveloperPost'
        }),
        addPost() {
            this.add(this.params)
                .then(() => {
                    this.$swal({
                        position: 'middle',
                        title: 'Your task has been saved!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        this.$router.push('/');
                    })
                }).catch(error => {
               console.log(error);
            })
        },

    }
}
</script>
