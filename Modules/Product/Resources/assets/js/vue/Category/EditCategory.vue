<template>
  <v-container>
    <v-layout wrap row>
      <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
      <v-flex v-if="!loader">
        <v-card>
          <v-card-title>
            <h1>Редактирование Category</h1>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-layout row wrap>
                <v-flex>
                  <v-form ref="form" lazy-validation v-model="valid">
                    <v-text-field
                      name="title"
                      label="Наименование категории"
                      v-model="item.title"
                      :counter="255"
                      :rules="getRules({required: true, max: 255})"
                      :error-messages="messages.title"
                      required></v-text-field>
                    <v-text-field
                      name="sort"
                      label="Сорт."
                      v-model="item.sort"
                      :rules="getRules({required: true})"
                      :error-messages="messages.sort"
                      required></v-text-field>
                    <v-checkbox
                      label="Актив."
                      v-model="item.active"
                    ></v-checkbox>
                    <wysiwyg
                      :element-id="id"
                      name="description"
                      url="image-wysiwyg-upload"
                      url-file="upload-file"
                      type-file-upload="file"
                      type-file="image-wysiwyg"
                      model=""
                      v-model="item.description">
                    </wysiwyg>
                    <!--<file-box url="/files/upload" :fileable-id="Number(item.id)" :type-files="typeFiles"
                              :model="model"></file-box>-->
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
  import {mapActions, mapState, mapMutations} from 'vuex'
  import {ACTIONS, GLOBAL} from '@/constants'
  import Wysiwyg from '@/vue/Wysiwyg.vue'
  import {ValidationConvert} from '@/vue/Validations'
  //import fileBox from '@file/components/file-box/FileBox'
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
        isSending: false,
        validationConvert: new ValidationConvert(),
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.init(to.params.id)
        vm.loader = false
      })
    },
    beforeRouteUpdate(to, from, next) {
      this.init(to.params.id)
      this.loader = false
      next()
    },
    computed: {
      ...mapState('Category', ['item', 'items', 'model']),
      ...mapState('initializer', ['messages'])
    },
    components: {
      //fileBox
    },
    methods: {
      ...mapActions('Category', {
        save: GLOBAL.SAVE_DATA
      }),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      init(id) {
        this.resetError();
        if (this.items.length == 0) {
          this.$router.push({name: 'list-categories'})
        }
      },
      onSubmit() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(this.item).then(response => {
            this.isSending = false
          })
        }
      },
      getRules(validations) {
        return validations ? this.validationConvert.ruleValidations(validations) : []
      }
    }
  }
</script>