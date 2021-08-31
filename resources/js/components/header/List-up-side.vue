<template>


    <div class="collapse navbar-collapse">

        <showModalCalendarForPeriod-component @get-method="" ref="showPrint"></showModalCalendarForPeriod-component>

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
                <router-link to="/Kvadrat" class="nav-link text-lg "><img src="/images/icon-header/placeholder.png">
                </router-link>
            </li>

<!--            <li>-->
<!--                <router-link to="/setings" class="nav-link  "><img src="/images/icon-header/settings.png"></router-link>-->
<!--            </li>-->

            <atom-spinner
                :animation-duration="3000"
                :size="60"
                :color="'#ff1d5e'"
            />


        </ul>

        <div>

        </div>

        <ul class="navbar-nav ml-auto">

            <!--------------------------------------------------------------------------------------------------------------------------------------->

            <b-sidebar id="print" title="Распечатка чека"    right  >
                <template #default="{ hide }">
                    <div class="px-3 py-2 card card-body">



                    </div>

                </template>

            </b-sidebar>

            <!--------------------------------------------------------------------------------------------------------------------------------------->

            <b-button v-if="ifThisRoute" @click="addNewUser" variant="outline-primary">
                <h5>Добавить Курьера</h5>
            </b-button>

            <div class="mt-2" v-if="ifThisRouteZakaz"   variant="outline-primary" >

                <input-form
                    name="birthday"
                    datePicker="true"
                    placeholder="Фильтр по дате"
                    @edit-field="editFieldforFilter"
                    @clear="clear"
                >
                </input-form>

            </div>



            <li v-if="ifThisRouteKvadrat" ><a href="#" @click.prevent="addKvadrat" class="nav-link text-lg "><img
                src="/images/icon-header/copy.png" alt="kvadrati"></a></li>


<!--            <li v-if="ifThisRouteZakaz" ><a href="#" v-b-toggle.print class="nav-link text-lg "><img-->
<!--                src="/images/icon-header/printer.png" alt="print"></a></li> -->

            <li v-if="ifThisRouteZakaz" ><a href="#" @click.prevent="showPrintModal" class="nav-link text-lg "><img
                src="/images/icon-header/printer.png" alt="print"></a></li>



            <li><a href="#" @click.prevent="loGout" class="nav-link text-lg "><img
                src="/images/icon-header/logout.png" alt="Logout"></a></li>

        </ul>
    </div>


</template>

<script>

import {mapActions, mapGetters} from "vuex";
import {AtomSpinner} from 'epic-spinners'

export default {

    components: {
        AtomSpinner

    },

    data() {
        return {
             date: '',

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

        ifThisRouteKvadrat() {
            if (this.$route.name === 'kvadrat')
                return true;
        },
    },

    methods: {
        ...mapActions(['FilterZakaz']),

        addNewUser() {
            this.$refs.add_user.addNewUserModal()
        },

        addKvadrat() {
            this.$refs.add_kvadrat.addNewKvadratModal()
        },

        onContext(ctx) {
            this.value = ctx.activeYMD
        },

        editFieldforFilter(e, name, type) {

            if (e){

                this.$store.dispatch('FilterZakaz', {date: e})
            }

        },

        showPrintModal(index){
            this.$refs.showPrint.showZakazCalendarModal(index)
        },

        clear() {
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
    /*border: 2px solid #FF0000;*/
}
</style>

