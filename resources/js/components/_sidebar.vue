<template>
    <v-list dense>
        <v-list-item exact to="/admin">
            <v-list-item-action>
                <v-icon>dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-group no-action>
            <v-list-item slot="activator">
                <v-list-item-action>
                    <v-icon>account_circle</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>User Management</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-item-title to="/admin/users">
                <v-list-item-action>
                    <v-icon>account_circle</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Users</v-list-item-title>
                </v-list-item-content>
            </v-list-item-title>

            <v-list-item to="/admin/roles">
                <v-list-item-action>
                    <v-icon>account_circle</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Roles</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-item to="/admin/permissions">
                <v-list-item-action>
                    <v-icon>account_circle</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Permissions</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list-group>

        <v-list-item to="/admin/activities">
            <v-list-item-action>
                <v-icon>settings</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Activities</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/settings">
            <v-list-item-action>
                <v-icon>settings</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Settings</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</template>


<script>
export default {

}
</script>
