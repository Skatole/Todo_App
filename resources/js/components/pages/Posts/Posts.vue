<template>
  <div class="grid-2-columns">
    <!--                <div class="row justify-content-between pb-2">-->
    <!--                    <select v-model="params.category_id" class="form-control col-md-5">-->
    <!--                        <option value="">&#45;&#45; choose category &#45;&#45;</option>-->
    <!--                        <option v-for="category in categories"-->
    <!--                                :value="category.id">-->
    <!--                            {{ category.name }}-->
    <!--                        </option>-->
    <!--                    </select>-->
    <!--                </div>-->
    <v-container id="dashbard_container">
      <v-layout>
        <v-row>
          <Reference class="row1" @changeParams="change($event)"></Reference>
        </v-row>
        <div class="row2">
          <v-row>
            <v-sheet color="#2F4F4F" rounded="lg">
              <v-col>
                <v-card>
                  <v-card-title class="justify-content-center">
                    <v-responsive max-width="300">
                      <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        dense
                        flat
                        hide-details
                        label="Search"
                        rounded
                        single-line
                        solo-inverted
                      ></v-text-field>
                    </v-responsive>
                  </v-card-title>
                </v-card>
              </v-col>
              <v-data-table
                :headers="headers"
                :items="params"
                :items-per-page="5"
                :search="search"
                sort-by="Deadline"
                class="elevation-1"
              >
                <template v-slot:top>
                  <v-toolbar flat>
                    <v-toolbar-title>My CRUD</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          color="primary"
                          dark
                          class="mb-2"
                          v-bind="attrs"
                          v-on="on"
                        >
                          New Item
                        </v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                          <v-container>
                            <v-row>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                  v-model="editedParam.title"
                                  label="Title"
                                ></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                  v-model="editedParam.task"
                                  label="Task"
                                ></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                  v-model="editedParam.deadline"
                                  label="Deadline"
                                ></v-text-field>
                              </v-col>
                            </v-row>
                          </v-container>
                        </v-card-text>

                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" text @click="close">
                            Cancel
                          </v-btn>
                          <v-btn color="blue darken-1" text @click="save">
                            Save
                          </v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-toolbar>
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                  <v-icon small class="mr-2" @click="editTask(item)">
                    mdi-pencil
                  </v-icon>
                  <v-icon small @click="deleteTask(item)"> mdi-delete </v-icon>
                  <v-switch
                    v-model="item.is_task_done"
                    :dark="true"
                    @change="switchButton(item.id, item.is_task_done)"
                  ></v-switch>
                </template>
              </v-data-table>
              <!-- <v-col>
                <v-data-table
                dense
                show-select
                  :headers="headers"
                  :items="params"
                  :items-per-page="5"
                  :search="search"
                  calculate-widths: true
                  class="elevation-1"
                >
                  <template v-slot:item.actions="{ item }">
                    <v-icon small @click="deleteItem(item.id)"
                      >mdi-delete
                    </v-icon>
                    <v-switch
                      v-model="item.is_task_done"
                      :dark="true"
                      @change="switchButton(item.id, item.is_task_done)"
                    ></v-switch>
                  </template>
                </v-data-table>
              </v-col> -->
            </v-sheet>
          </v-row>
        </div>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Reference from "./Reference";
import { mapActions, mapGetters } from "vuex";

export default {
  name: "Posts",
  components: {
    Reference,
  },

  data() {
    return {
      search: "",
      dialog: false,
      dialogDelete: false,
      params: [
        {
          id: "",
          title: "",
          task: "",
          is_task_done: false,
          created_at: "",
          deadline: "",
          reference: "",
        },
      ],
      editedIndex: -1,
      editedParam: {
        title: "",
        task: "",
        deadline: "",
        reference: "",
      },
       defaultParam: {
        title: " - ",
        task: " - ",
        deadline: "",
        reference: " - ",
      },
    };
  },

  computed: {
    ...mapGetters({
      postGetter: "posts/posts",
      authenticated: "authenticated",
      user: "user",
      role: "role",
    }),

    formTitle() {
      return this.editedIndex === -1 ? "New Task" : "Edit Task";
    },

    headers() {
      return [
        {
          text: "Title",
          align: "start",
          filterable: true,
          value: "title",
          width: "5rem",
        },
        { text: "Task", filterable: true, value: "task", width: "20rem" },
        {
          text: "Created",
          filterable: true,
          value: "created_at",
          width: "5rem",
        },
        {
          text: "Deadline",
          filterable: true,
          value: "deadline",
          width: "5rem",
        },
        {
          text: "Actions",
          filterable: false,
          sortable: false,
          value: "actions",
          width: "5rem",
        },
      ];
    },
  },

  created() {
    this.getAllTasks();
  },

  methods: {
    ...mapActions({
      allPosts: "posts/getAllPosts",
      update: "posts/updatePost",
      delete: "posts/deletePost",
      userPosts: "posts/getUserPosts",
      allDevPosts: "posts/getAllDevPosts",
      allDevelopers: "getAllDevUsers",
      allManagers: "getAllManUsers",
    }),

    change(value) {
      if (value) {
        this.params = this.postGetter;
      }
    },

    async getAllTasks() {
      await this.allPosts().then(() => {
        this.params = this.postGetter;
      });
    },

    async editTask(item) {
      await this.update(item).then(() => {
        this.editedIndex = this.params.indexOf(item);
        this.editedParam = Object.assign({}, item);
        this.dialog = true;
      });
    },

    async deleteTask(item) {
      await this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0f6848",
        cancelButtonColor: "#731e1e",
        confirmButtonText: "Yes, delete it!",
      })
        .then((result) => {
          if (result.value) {
            this.params.splice(item.id, 1);
            for (let param of this.params) {
              if (item.id === param.id) {
                this.delete(item).then(() => {
                  this.$swal("Post deleted successfully");
                  this.getAllTasks();
                });
              }
            }
          }
        })
        .catch(() => {
          this.$swal({ icon: "error", title: "Error happened" });
        });
    },

    switchButton(item, is_task_done) {
      for (let param of this.params) {
        if (item.id === param.id) {
          param["is_task_done"] = is_task_done;
          this.update(param).then(() => {
            this.getAllTasks();
          });
        }
      }
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedParam = Object.assign({}, this.defaultParam)
        this.editedIndex = -1
      })
    },

    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.params[this.editedIndex], this.editedParam)
      } else {
        this.params.push(this.editedParam)
      }
      this.close()
    },
  },

};
</script>

<style >
.grid-2-rows {
  display: grid;
  justify-items: start;
  column-gap: 12rem;
}
.row2 {
  grid-template-rows: 100%;
}
</style>
