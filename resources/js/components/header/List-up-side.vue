<template>


    <div class="collapse navbar-collapse">

        <addnewkvadrat-component @get-method=""
                                 ref="add_kvadrat"></addnewkvadrat-component>

        <addnewuser-component
            ref="add_user"></addnewuser-component>

        <ul class="navbar-nav mr-auto tracking-widest rol">

            <li>
                <router-link to="/home" class="nav-link exact "><img src="/images/icon-header/book.png">
                </router-link>
            </li>

            <li>
                <router-link to="/kurer" class="nav-link text-lg "><img src="/images/icon-header/users.png">
                </router-link>
            </li>

            <li>
                <router-link to="/kvadrat" class="nav-link "><img src="/images/icon-header/placeholder.png">
                </router-link>
            </li>

            <li class="nav-link text-lg" v-b-toggle.sidebar-backdrop><img
                src="/images/icon-header/settings.png" alt="print"></li>


                                <!----------------------------------------------0------------------------------------------------>

            <b-sidebar
                width="300px"
                no-header-close="false"
                id="sidebar-backdrop"
                title=""
                :backdrop-variant="variant"
                backdrop
                @hidden="action_ven_close"
                shadow>



    <b-card
        v-if="!admin"
        title="Настройки для админа"
        img-src="/images/settings/tools.png"
        img-top
        tag="article"
        style="max-width: 25rem;"
        class="mb-2">


        <b-card-text  v-if="!set_error_admin_password">
            <span style="color: green;"><b-col></b-col>Доступ к скрытым настройкам</span>
        </b-card-text>

        <b-card-text v-if="set_error_admin_password">
            <span style="color: red;"><b-col></b-col>Неверный пароль !!!</span>
        </b-card-text>


        <b-card-text>
            <input  class="form-control find"  @keyup.enter="recognition_user"
                    v-model="set_admin_password" placeholder="Вход с паролем">
        </b-card-text>

    </b-card>

                                    <!------------------------------------------- 1 Operator ---------------------------------------------------->

    <b-card
        v-if="!admin"
        title="Доступные настройки"
        img-top
        tag="article"
        style="max-width: 25rem;"
        class="mb-2">

        <b-card-text  v-if="!set_error_admin_password">
            <span style="color: green;"><b-col></b-col>Настройки для оператора</span>
        </b-card-text>

    </b-card>



                                          <!------------------------------------------- 2 Admin ---------------------------------------------------->

  <div v-if="admin">

      <b-card
          title="Установка времени"
          img-top
          img-src="/images/settings/king.png"
          tag="article"
          style="max-width: 25rem;"
          class="mb-2">

          <b-card-text>
              <span style="color: green;"><b-col><i class="fas fa-dollar-sign"></i></b-col>Меняется время доставки заказов</span>
          </b-card-text>


          <b-time
              v-model="set_time"
              v-if="ifPasswordAdminTrue"
              class="time_center  mt-1 mb-4"
              hide-header="true"
              label-minutes="Установка минут"
              label-hours="Установка часа"
              id="ex-disabled-readonly">

          </b-time>

          <b-card-text v-if="!set_time && !can_after_loading && can_show">
              <b-alert show v-if="send_loading"> Установите часы и минуты</b-alert>
          </b-card-text>

          <b-card-text v-if="set_time_use">
              <b-alert show variant="warning" v-if="can_after_loading"><img class="avatar_1" src="/images/icon-promouter/success.png">   Время  записанно</b-alert>
          </b-card-text>

          <b-button
              variant="info"
              size="sm"
              v-if="set_time"
              class="mt-3 ml-2"
              @click="addNewTime">Сохранить в системе
          </b-button>

          <b-button variant="primary" disabled v-if="send_OK" class="ml-5">
              <b-spinner small></b-spinner>
              Сохранение...
          </b-button>


          <b-button
              size="sm"
              class="mt-3 ml-2 border rounded p-2"
              variant="danger"
              v-if="set_time"
              @click="Clear_time">Очистить
          </b-button>

      </b-card>

                                    <!---------------------------------------------- 3 Admin ------------------------------------------------->

      <b-card
          title="Логин и пароль"
          img-top
          tag="article"
          style="max-width: 25rem;"
          class="mb-2">

          <b-card-text>
              <span style="color: green;"><b-col></b-col>Изменить вход в CRM (Админ)</span>
          </b-card-text>

          <b-card-text>
              <input  class="form-control find"
                      v-model="set_login" placeholder="новый логин">
          </b-card-text>

          <b-card-text>
              <input  class="form-control find"
                      v-model="set_password" placeholder="новый пароль">
          </b-card-text>

          <b-button variant="primary" disabled v-if="send_OK_2" class="ml-5">
              <b-spinner small></b-spinner>
              Сохранение...
          </b-button>

          <b-card-text v-if="ifSend_login_or_password_ok">
              <b-alert show variant="warning" ><img class="avatar_1" src="/images/icon-promouter/success.png">   Данные  записанны</b-alert>
          </b-card-text>

          <b-card-text v-if="ifSend_login_or_password">
              <b-alert show v-if="!set_new_value"><b-col></b-col>Введите новое значение </b-alert>
          </b-card-text>

          <b-button
              v-if="set_new_value"
              variant="info"
              size="sm"
              class="mt-3 ml-2"
              @click="addNewUser_login_password">Обновить данные
          </b-button>

          <b-button
              v-if="set_new_value"
              size="sm"
              class="mt-3 ml-2 border rounded p-2"
              variant="danger"
              @click="Clear_input_login_password">Отмена
          </b-button>

      </b-card>
  </div>


<!--                                    <div class="">-->
<!--                                        <b-form-group label="Цвет" label-for="backdrop-variant">-->
<!--                                            <b-form-select id="backdrop-variant" v-model="variant" :options="variants"></b-form-select>-->
<!--                                        </b-form-group>-->
<!--                                    </div>-->

            </b-sidebar>


            <div v-if="ifThisMainTableZakaz">
                <h4 v-if="ifThisRouteZakaz" class="mt-2 ml-5">Список заказов на:
                    <b-badge variant="danger">{{ if_empty_zakaz }}</b-badge>
                </h4>
            </div>

            <div v-if="ifThisRouteZakaz">
                <h4 v-if="ifFilterZakazByData" class="mt-2 ml-5">Отфильтрованный список заказов у которых есть доставка
                    на:
                    <b-badge variant="danger">{{ date }}</b-badge>
                </h4>
            </div>

            <div v-if="ifThisRouteZakaz">
                <h4 v-if="ifFilterZakazByPhone" class="mt-2 ml-5">Все что нашлось по номеру
                    <b-badge variant="danger">{{ input_phone }}</b-badge>
                </h4>
            </div>


        </ul>

        <!------------------Spinner-->

        <atom-spinner
            v-if="ifUpdateSpinner"
            animation-duration="1000"
            :size="30"
            :color="currentColor"
        />

        <spav v-if="ifUpdateSpinner" class=" ml-1"><img src="/images/loading.svg" class="width pl-2 pr-2"> обновление ... </spav>

        <atom-spinner
            v-if="ifUpdateSpinner"
            animation-duration="1000"
            :size="30"
            :color="currentColor"
        />

        <!--Spinner--------------------------->

        <ul class="navbar-nav ml-auto">

            <div v-if="ifThisRouteZakaz">
                <b-button v-if="ifThiFieldPhoneNotFull" show variant="danger" class="mr-4 mt-2">Вы ввели не полный номер
                    телефона
                </b-button>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------->

            <b-button v-if="ifThisRoute" @click="addNewUser" variant="outline-primary">
                <h5>Добавить Курьера</h5>
            </b-button>

            <div v-if="ifThisRouteZakaz">
                <li v-if="ifThisFindZakaz"><a href="#" @click.prevent="clearFindTel" class="nav-link text-sm"><img
                    src="/images/icon-header/cancel.png"></a></li>
            </div>

            <div class="mt-2" v-if="ifThisRouteZakaz" variant="outline-primary">

                <input v-if="ifThisFindPhone" v-mask="'+38 (###)-###-##-##'" class="form-control find"
                       v-model="find_phone" placeholder="Найти заказ по номеру клиента"
                       @keyup.enter="findPhoneForFilter">

            </div>

            <div class="mt-2" v-if="ifThisRouteZakaz">

                <input-form
                    v-if="ifThisFindData"
                    v-model="date"
                    datePicker="true"
                    placeholder="Фильтр по дате"
                    @edit-field="findDataForFilter"
                    @clear="clear"
                    class="ml-2">
                </input-form>

            </div>


            <li v-if="ifThisRouteKvadrat"><a href="#" @click.prevent="addKvadrat" class="nav-link text-lg "><img
                src="/images/icon-header/copy.png" alt="kvadrati"></a></li>

            <li v-if="showFindPhone"><a href="#" v-if="ifThisFindData" @click.prevent="showFindPhoneSearch"
                                        class="nav-link text-lg ml-1"><img
                src="/images/icon-header/phone-call.png"></a></li>

            <li v-if="showFindPhone"><a href="#" v-if="ifThisFindPhone" @click.prevent="showFindDataSearch"
                                        class="nav-link text-sm ml-1"><img
                src="/images/icon-header/kalendar.png"></a></li>

            <li v-if="ifThisRouteZakaz"><a href="/chekPrint" class="nav-link text-lg "><img
                src="/images/icon-header/printer.png" alt="print"></a></li>

            <li><a href="#" @click.prevent="loGout" class="nav-link text-lg"><img
                src="/images/icon-header/logout.png" alt="Logout"></a></li>

        </ul>
    </div>


</template>

<script>

import {mapActions, mapGetters} from "vuex";
import {AtomSpinner} from 'epic-spinners'
import {TheMask} from 'vue-the-mask'

export default {
    components: {
        TheMask, AtomSpinner
    },


    data() {
        return {
            set_time: "",
            currentColor: "",
            date: '',
            send_OK: false,
            send_OK_2: false,
            admin: false,
            set_password: '',
            set_login: '',
            set_admin_password: '',
            set_error_admin_password: false,
            can_after_loading: false,
            can_show: true,
            ifSend_login_or_password: true,
            find_phone: '',
            input_phone: '',
            ifThisFindPhone: false,
            ifFilterZakazByData: false,
            ifThiFieldPhoneNotFull: false,
            ifThisFindData: true,
            send_loading: true,
            ifUpdateSpinner: false,
            ifThisMainTableZakaz: true,
            ifThisMainTableHaveZakaz: true,
            ifFilterZakazByPhone: false,
            set_time_use: false,
            if_admin_password_ok: false,
            ifPasswordAdminTrue: true,
            ifSend_login_or_password_ok: false,

            variant: 'dark',
            variants: [
                'transparent',
                'white',
                'light',
                'dark',
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',
            ],

            colors: [
                "red",
                "blue",
                "green",
                "indigo",
                "purple",
                "teal",
                "orange",
                "brown",
                "deep-orange",
                "blue-grey",
                "cyan"
            ],

        }
    },

    mounted() {
        this.clearFindTel()
        this.randomColors()
        this.Reload()
    },

    beforeUpdate() {

        if (this.$route.path !== '/home') {

            this.clearFindTel()
            this.clear()
        }

    },

    computed: {
        ...mapGetters(['AllKurers', 'AllZakazFind', 'if_empty_zakaz']),

        ifThisRoute() {
            if (this.$route.name === 'kurer')
                return true;
        },

        ifThisRouteZakaz() {

            if (this.$route.name === 'zakaz')
                return true;
        },

        showFindPhone() {
            if (this.$route.name === 'zakaz')
                return true;
        },

        ifThisRouteKvadrat() {
            if (this.$route.name === 'kvadrat')
                return true;
        },

        ifThisFindZakaz() {

            if (this.find_phone !== '') {
                return true;
            } else {
                return false;
            }

        },

        length: function () {
            return this.find_phone.length;
        },

        set_new_value() {

            if (this.set_login || this.set_password){
                return true
            }else {
                return false
            }

        },

    },

    methods: {
        ...mapActions(['PhoneFilterZakaz', 'DataFilterZakaz']),

        randomColors() {
            this.currentColor =
                this.colors[Math.floor(Math.random() * this.colors.length)];
        },

        Reload() {

            setTimeout(() => {
                this.ifUpdateSpinner = true
                setTimeout(() => {
                    this.ifUpdateSpinner = false
                }, 2900)
            }, 4000)


        },

        addNewUser() {
            this.$refs.add_user.addNewUserModal()
        },

        addNewTime() {
            axios.post(`api/v1/saveTime`, {setTime: this.set_time})
           this.Clear_time()
            this.send_OK = true
            this.send_loading = false

            setTimeout(() => {
                this.send_OK = false
                 this.set_time = ''
                this.send_loading = true
                this.can_show = false
                this.set_time_use = true
                this.can_after_loading = true

                    setTimeout(() => {
                        this.can_show = true
                        this.set_time_use = false
                        this.can_after_loading = false
                    }, 2000)


            }, 2900)

        },

        addNewUser_login_password() {

            if (this.set_login){

                axios.post(`api/v1/edit_and_send_superadmin_login_or_password`, {field_id: '1', field_name: 'email', field_value: this.set_login})
            } else {
                axios.post(`api/v1/edit_and_send_superadmin_login_or_password`, {field_id: '1', field_name: 'password', field_value: this.set_password})
            }

            this.Clear_input_login_password()

            this.send_OK_2 = true
            this.ifSend_login_or_password = false

            setTimeout(() => {
                this.send_OK_2 = false
                this.ifSend_login_or_password_ok = true

                setTimeout(() => {
                    this.ifSend_login_or_password = true
                    this.ifSend_login_or_password_ok = false
                }, 2000)


            }, 2900)
        },

          recognition_user() {

                  if ( this.set_admin_password == '770077') {

                  this.admin = true
                  this.if_admin_password_ok = false

                  } else {
                      this.set_admin_password = ''
                      this.set_error_admin_password = true
                  }
        },

       addKvadrat() {
            this.$refs.add_kvadrat.addNewKvadratModal()
        },

        findPhoneForFilter() {

            if (this.length < 19) {

                this.ifThiFieldPhoneNotFull = true
                this.ifFilterZakazByData = false
                this.ifFilterZakazByPhone = false
                this.ifThisMainTableZakaz = false

            } else {

                this.ifThiFieldPhoneNotFull = false
                this.ifFilterZakazByData = false
                this.ifFilterZakazByPhone = true
                this.ifThisMainTableZakaz = false
                this.$store.dispatch('PhoneFilterZakaz', {phone: this.find_phone})
                this.$store.dispatch('FindPhone', {phone: this.find_phone})
                this.input_phone = this.find_phone

            }

        },

        findDataForFilter(item) {
            this.date = item

            if (this.date) {
                this.$store.dispatch('DataFilterZakaz', {data: this.date})
                this.$store.dispatch('FindData', {data: this.date})
                this.ifFilterZakazByData = true
                this.ifThisMainTableZakaz = false
            }
        },

        showFindPhoneSearch() {
            this.ifThisFindPhone = true
            this.ifThisFindData = false
        },

        showFindDataSearch() {
            this.ifThisFindPhone = false
            this.ifFilterZakazByPhone = false
            this.ifThisFindData = true
            this.ifThisFindZakaz = false
            this.ifThiFieldPhoneNotFull = false
            this.ifThisMainTableZakaz = true
            this.find_phone = ''

            if (this.date) {
                this.$store.dispatch('DataFilterZakaz', {data: this.date})
                this.ifFilterZakazByData = true
                this.ifThisMainTableZakaz = false

            } else {
                this.$store.dispatch('GetAllZakaz')
            }

        },

        clear() {
            this.ifFilterZakazByData = false
            this.ifThisMainTableHaveZakaz = false
            this.$store.dispatch('FindData', {data: ''})
            this.$store.dispatch('GetAllZakaz')
            this.ifThisMainTableZakaz = true
        },

        Clear_time() {
            this.set_time = ''
        },

        action_ven_close() {
            this.set_time = ''
            this.set_login = ''
            this.set_password = ''
            this.set_admin_password = ''
            this. admin = false
            this. set_error_admin_password = false

        },

        Clear_input_login_password() {
            this.set_login = ''
            this.set_password = ''

        },

        clearFindTel() {
            this.find_phone = ''
            this.date = ''
            this.ifThisFindPhone = false
            this.ifThiFieldPhoneNotFull = false
            this.ifThisMainTableHaveZakaz = false
            this.ifThisFindData = true
            this.ifThisMainTableZakaz = true
            this.ifFilterZakazByPhone = false
            this.$store.dispatch('FindPhone', {phone: ''})
            this.$store.dispatch('GetAllZakaz')
        },

        loGout() {
            axios.post("/logout").then(response => {
                window.location.replace("/");

            });
        },

    }
}
</script>

<style scoped>

.active {
    border-bottom: 2px solid #FF0000;
}

.find {
    width: 270px;
}

.time_center {
    margin-left: 40px;
}

.time_center_button {
    margin-left: 70px;
}

.border_span {
    border-bottom: 1px solid red;
}

.width {
    height: 30px;
}

.avatar_1 {
    width: 30px;
    height: 30px;
}

.avatar img {
    width: 100%;
    height: 100%;
}

</style>

