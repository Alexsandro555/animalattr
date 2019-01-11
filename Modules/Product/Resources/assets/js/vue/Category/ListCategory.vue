<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
        <v-card v-if="!loader">
          <v-card-title>
            <h1>Категории</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="items"
                          :search="search"
                          :rows-per-page-items="[10, 20, 50, { 'text': 'Все', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="justify-center layout px-0">
                  <v-btn @click="finds(props.item.id)" icon class="mx-0">
                    <v-icon>find_in_page</v-icon>
                  </v-btn>
                  <v-btn icon class="mx-0"  @click="editCategory(props.item.id)">
                    <v-icon color="teal">edit</v-icon>
                  </v-btn>
                  <!--<v-btn :disabled="props.item.url_key === 'po-umolchaniyu'" icon class="mx-0"
                         @click="deleteItem(props.item)">
                    <v-icon color="pink">delete</v-icon>
                  </v-btn>-->
                </td>
              </template>
              <template slot="no-data">
                <v-alert :value="true" color="error" icon="warning">
                  Извините, нет данных для отображения :(
                </v-alert>
              </template>
              <v-alert slot="no-results" :value="true" color="error" icon="warning">
                По ключевой фразе "{{ search }}" ничего не найдено.
              </v-alert>
            </v-data-table>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="addCategory" color="primary" dark class="text-left mb-2">
              <v-icon>add</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {GLOBAL} from "@/constants"
  import {ACTIONS} from "@product/constants"
  import {mapActions, mapState, mapMutations} from 'vuex'

  export default {
    props: {
      parentId: {
        type: String,
        required: false
      }
    },
    data: function () {
      return {
        headers: [
          {
            text: '#',
            align: 'left',
            sortable: true,
            value: 'id'
          },
          {
            text: 'Наименование',
            value: 'title',
            sortable: true
          },
          {
            text: 'Действия',
            value: 'title',
            sortable: false
          }
        ],
        search: '',
        loader: true
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.load(to.params.parentId).then(response => {
          vm.loader = false
        })
      })
    },
    beforeRouteUpdate(to, from, next) {
      this.load(to.params.parentId).then(response => {
        this.loader = false
      })
      next()
    },
    computed: {
      ...mapState('Category', ['items']),
    },
    methods: {
      addCategory() {
        this.add(this.parentId)
          .then(response => {
            this.$router.push({name: 'edit-category', params: {id: ''+response.id}})
          })
          .catch(error => {
          })
      },
      finds(id) {
        this.$router.push({name: 'list-categories', params: {parentId: ''+id}})
      },
      editCategory(id) {
        this.selectItem({source: 'items', receiver: 'item', id: Number(id)})
        this.$router.push({name: 'edit-category', params: {id: ''+id}})
      },
      deleteItem(item) {
        if (confirm('Вы уверены что хотите удалить запись?')) {
          this.delete(item.id)
        }
      },
      ...mapActions ('Category', {load: ACTIONS.LOAD, add: ACTIONS.ADD, delete: GLOBAL.DELETE}),
      ...mapMutations('Category', {selectItem: 'SELECT_VARIABLE_BY_ID'})
    }
  }
</script>