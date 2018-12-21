<template>
  <div>
    <v-navigation-drawer clipped app v-model="drawer">
      <v-list>
        <v-list-tile>
          <v-list-tile-title class="title">
            Основной
          </v-list-tile-title>
        </v-list-tile>
      </v-list>
      <v-divider></v-divider>
      <v-list dense class="pt-0">
        <v-list-tile>
          <v-list-tile-content>Продукция</v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar absolute app clipped-left>
      <v-toolbar-side-icon @click.native="drawer = !drawer"></v-toolbar-side-icon>
      <span class="title ml-3 mr-5" @click="goMainPage()">Лидер</span>
      <v-text-field solo-inverted flat label="Поиск" prepend-icon="search"></v-text-field>
      <v-btn light @click.stop="exit">Выход</v-btn>
      <v-btn light @click.stop="goToSite">На главную</v-btn>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
          <router-view></router-view>
        </v-layout>
      </v-container>
    </v-content>
    <notifications/>
  </div>
</template>
<script>
  export default {
    props: { },
    data() {
      return {
        drawer: null
      }
    },
    methods: {

    }
  }
</script>