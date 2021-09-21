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

            <!--            <li>-->
            <!--                <router-link to="/setings" class="nav-link  "><img src="/images/icon-header/settings.png"></router-link>-->
            <!--            </li>-->

            <div v-if="ifThisMainTableZakaz">
                <h4 v-if="ifThisRouteZakaz" class="mt-2 ml-5">Список заказов на:
                    <b-badge variant="danger">{{ AllZakaz.data['0'].date_delivery }}</b-badge>
                </h4>
            </div>

            <h4 v-if="ifFilterZakazByData" class="mt-2 ml-5">Список заказов на:
                <b-badge variant="danger">{{ date }}</b-badge>
            </h4>


        </ul>

        <ul class="navbar-nav ml-auto">

            <b-alert v-if="ifThiFieldPhoneNotFull" show variant="danger" class="mr-4">Вы ввели не полный номер
                телефона
            </b-alert>

            <!--------------------------------------------------------------------------------------------------------------------------------------->

            <b-button v-if="ifThisRoute" @click="addNewUser" variant="outline-primary">
                <h5>Добавить Курьера</h5>
            </b-button>

            <li v-if="ifThisFindZakaz"><a href="#" @click.prevent="clearFindTel" class="nav-link text-sm"><img
                src="/images/icon-header/cancel.png"></a></li>

            <div class="mt-2" v-if="ifThisRouteZakaz" variant="outline-primary">

                <input v-if="ifThisFindPhone" v-mask="'+38 (###)-###-##-##'" class="form-control find"
                       v-model="find_zakaz" placeholder="Найти заказ по номеру клиента"
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
        AtomSpinner,
        TheMask

    },

    data() {
        return {
            date: '',
            find_zakaz: '',
            ifThisFindPhone: false,
            ifFilterZakazByData: false,
            ifThiFieldPhoneNotFull: false,
            ifThisFindData: true,
            ifThisMainTableZakaz: true,

        }
    },

    computed: {
        ...mapGetters(['AllKurers', 'AllZakaz']),

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

            if (this.find_zakaz !== '') {
                return true;
            } else {
                return false;
            }

        },

        length: function () {
            return this.find_zakaz.length;
        },
    },

    methods: {
        ...mapActions(['PhoneFilterZakaz', 'DataFilterZakaz']),

        addNewUser() {
            this.$refs.add_user.addNewUserModal()
        },


        addKvadrat() {
            this.$refs.add_kvadrat.addNewKvadratModal()
        },

        onContext(ctx) {
            this.value = ctx.activeYMD
        },

        findPhoneForFilter() {

            if (this.length < 19) {

                this.ifThiFieldPhoneNotFull = true

            } else {

                this.ifThiFieldPhoneNotFull = false
                this.$store.dispatch('PhoneFilterZakaz', {phone: this.find_zakaz})
                this.ifThisMainTableZakaz = false
            }

        },

        findDataForFilter(item) {
            this.date = item

            if (this.date) {
                this.$store.dispatch('DataFilterZakaz', {data: this.date})
                this.ifFilterZakazByData = true
                this.ifThisMainTableZakaz = false
            }
        },

        showFindPhoneSearch() {
            this.ifThisFindPhone = true
            this.ifThisFindData = false
            this.ifFilterZakazByData = false
        },

        showFindDataSearch() {
            this.ifThisFindPhone = false
            this.ifThisFindData = true
            this.ifThisFindZakaz = false
            this.ifThiFieldPhoneNotFull = false
            this.find_zakaz = ''

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
            this.$store.dispatch('GetAllZakaz')
            this.ifThisMainTableZakaz = true
        },

        clearFindTel() {
            this.find_zakaz = ''
            this.date = ''
            this.ifThisFindPhone = false
            this.ifThiFieldPhoneNotFull = false
            this.ifThisFindData = true
            this.ifThisMainTableZakaz = true
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

</style>

