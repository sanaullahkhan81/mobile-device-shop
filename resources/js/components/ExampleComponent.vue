<template>
    <v-app>
        <!-- Must have the app property -->
        <v-app-bar app></v-app-bar>

        <v-main>
            <v-container>
                Hello World
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
