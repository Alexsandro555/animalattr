<template>
  <v-container>
    <v-layout wrap row>
      <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
      <v-flex v-if="!loader">
        <v-card>
          <v-card-title>
            <h1>Редактирование Attribute</h1>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-layout row wrap>
                <v-flex>
                  <v-form ref="form" lazy-validation v-model="valid">
                    <template v-for="(field, num) in fields">
                      <form-builder :field="field" v-if="num!=='description'" :num="num" :items="item(id)"
                                    @update="updateField"></form-builder>
                    </template>
                    <v-flex text-xs-left>
                      <v-btn large :class="{primary: valid, 'red lighten-3': !valid}" :disabled="isSending"
                             @click.prevent="onSubmit">Сохранить
                      </v-btn>
                    </v-flex>
                  </v-form>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {mapActions, mapState, mapMutations, mapGetters} from 'vuex'
  import {ACTIONS, GLOBAL} from '@/constants'
  import formBuilder from '@/vue/FormBuilder'
  export default {
    props: {
      id: {
        type: String,
        required: true
      },
    },
    data: function () {
      return {
        valid: false,
        loader: true,
        isSending: false
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.init(to.params.id)
      })
    },
    beforeRouteUpdate(to, from, next) {
      this.resetError()
      next()
    },
    computed: {
      ...mapState('Attribute', ['items', 'fields', 'model']),
      ...mapGetters('Attribute', {item: GLOBAL.GET_ITEM})
    },
    components: {
      formBuilder,
    },
    methods: {
      ...mapActions('Attribute', {
        initialization: GLOBAL.INITIALIZATION,
        save: GLOBAL.SAVE_DATA,
        updateField: ACTIONS.UPDATE_FIELD,
      }),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      init(id) {
        this.initialization().then(response => {
          this.loader = false
        })
      },
      onSubmit() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(this.item(this.id)).then(response => {
            this.isSending = false
            this.resetError()
          })
        }
      },
    }
  }
</script>