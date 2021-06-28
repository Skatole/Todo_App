<template>
  <div>
    <v-col cols="2" class="row1">
      <v-list color="transparent" class="list">
        <v-divider class="my-2"></v-divider>
        <v-list-item link @click="userTasks">
          <v-list-item-content>
            <v-list-item-title> My Tasks </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider class="my-2"></v-divider>

        <v-list-item link @click="allTasks">
          <v-list-item-content>
            <v-list-item-title> All Tasks </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider class="my-2"></v-divider>

        <v-list-item v-if="$can('view developers')" link @click="viewDevelopers">
          <v-list-item-content>
            <v-list-item-title>
                <v-combobox
                label="Developers"
                dense
                :items="developers"
                >
                <option value="items"></option>
                </v-combobox> </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider class="my-2" v-if="$can('view developers')"></v-divider>

        <v-list-item v-show="$can('view managers')" link >
          <v-list-item-content>

            <v-list-item-title

            >
                <v-combobox
                :items="managers"
                @change="selectedRefUser"
                label="Managers"
                item-text="Manager"
                dense
                clearable
                >
                </v-combobox>
            </v-list-item-title>

          </v-list-item-content>
        </v-list-item>

        <v-divider class="my-2" v-show="$can('view managers')"></v-divider>



      </v-list>
    </v-col>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

export default {
  created () {
      this.viewManager(),
      this.viewDevelopers()
  },




  data() {
    return {
      posts: [],
      user: {},
      developers: [],
      managers: []
    };
  },

  computed: {
    ...mapGetters({
      userGetter: "user",
      roleGetter: "role",
      developersGetter: "developers",
      managersGetter: "managers",
    }),
  },


  methods: {
    ...mapActions({
      allPosts: "posts/getAllPosts",
      userPosts: "posts/getUserPosts",
      allDevelopers: "getAllDevUsers",
      allManagers: "getAllManUsers",
      reference: "getUserReferences",
      referencedPost: "posts/getReferencedPosts"
    }),

    async userTasks(event) {
        this.user = this.userGetter
      await this.userPosts(this.user).then(() => {
          this.$emit('changeParams', true);
      })
    },

    async allTasks() {
        await this.allPosts().then(() => {
          this.$emit('changeParams', true);
      })
    },

    async viewManager() {
        await this.reference().then(() => {
            this.managersGetter.forEach(element => {
                this.managers.push(element.name)
            });
        })
        return this.users

    },

    async viewDevelopers() {
        await this.reference().then(() => {
            // this.developersGetter.forEach(element => {
            //     this.developers.push(element.name)
            // })
        })
    },

    async selectedRefUser(value) {
         await this.managersGetter.forEach(element => {

                 if (element.name === value) {
                     this.referencedPost(element)
                        .then(() => {
                            this.$emit('changeParams', true);
                        })
                 }


         })
    }
  },

};
</script>
<style >
.row1 {
  display: grid;
  grid-template-rows: 25%;

  margin: 1rem;
  padding: 2rem;
}

.list {
    width: min(15rem);
    text-align: center;
}
</style>
