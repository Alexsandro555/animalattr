<template>
  <div>
    <v-card>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex xs2>
          </v-flex>
          <v-flex xs8 align-end flexbox v-if="attributes.lenght!==0">
            <br>
            <div>
              <v-form ref="form">
                <template v-for="(attribute, index) in attributes">
                  <v-container grid-list-md>
                    <v-layout col wrap>
                      <v-flex xs12>
                        <v-text-field v-if="attribute.type.title=='varchar'"
                                      :name="attribute.alias"
                                      :label="attribute.title"
                                      v-model="attribute.state.value">
                        </v-text-field>
                        <v-text-field v-else-if="attribute.type.title=='double'"
                                      :name="attribute.alias"
                                      :label="attribute.title"
                                      v-model="attribute.state.value"
                                      prefix="₽">
                        </v-text-field>
                        <v-text-field v-else-if="attribute.type.title=='integer'"
                                      :name="attribute.alias"
                                      :label="attribute.title"
                                      v-model="attribute.state.value">
                        </v-text-field>
                        <v-textarea v-else-if="attribute.type.title=='text'"
                                      :name="attribute.alias"
                                      :label="attribute.title"
                                      v-model="attribute.state.value"
                                      outline>
                        </v-textarea>
                        <v-checkbox v-else-if="attribute.type.title=='boolean'"
                                    :name="attribute.alias"
                                    :label="attribute.title"
                                    :value="attribute.state.value"
                                    v-model="attribute.state.value">
                        </v-checkbox>
                        <v-select v-else-if="attribute.type.title=='list'"
                                  :name="attribute.alias"
                                  :items="attribute.list_value"
                                  :label="attribute.title"
                                  :menu-props="{value: attribute.state.value}"
                                  :id="attribute.alias"
                                  v-model="attribute.state.value"
                                  item-text="title"
                                  item-value="id"
                                  single-line>
                        </v-select>
                        <v-menu
                          v-else-if="attribute.type.title=='date'"
                          ref="menu"
                          lazy
                          :close-on-content-click="false"
                          v-model="menu"
                          :return-value.sync="date"
                          transition="scale-transition"
                          :nudge-left="40"
                          full-width
                          min-width="290px">
                          <v-text-field
                            slot="activator"
                            :label="attribute.title"
                            :value="attribute.state.value"
                            prepend-icon="event"
                            readonly></v-text-field>
                          <v-date-picker
                            v-model="date"
                            no-title
                            scrollable
                            :allowed-dates="v => v>=dateFns.format(Date.now(),'YYYY-MM-DD')"
                            locale="ru-ru">
                            <v-spacer></v-spacer>
                            <v-btn flat color="primary" @click="menu = false">Отмена</v-btn>
                            <v-btn flat color="primary" @click="$refs.menu[index-1].save(attribute.state.value = date)">ОК</v-btn>
                          </v-date-picker>
                        </v-menu>
                      </v-flex>
                    </v-layout>
                  </v-container>
                </template>
                <v-flex xs12 text-xs-left>
                  <v-btn :disabled="!attributes.length>0" large color="primary" @click.prevent="onSave()">Сохранить</v-btn>
                </v-flex>
              </v-form>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card>
  </div>
</template>
<script>
  export default {
    props: {
      attributes: {
        type: Array,
        default: []
      },
      id: {
        type: String,
        required: true
      }
    },
    data: function() {
      return {
        valid: false,
        selectedRules: [
          v => this.selectRequired(v),
        ],
        requiredRules: [
          v => this.required(v)
        ],
        menu: false,
        date: ''
      }
    },
    methods: {
      selectRequired(v) {
        return !!v || 'Необходимо выбрать значение'
      },
      required(v) {
        return !!v || 'Обязательное для заполнения'
      },
      onSave() {
        if(this.$refs.form.validate()) {
          axios.post('/product/save-attributes', {attr: this.attributes, productId: this.id}).then(res => {
          }).catch(error => {
            console.log(error);
          });
        }
      }
    }
  }
</script>