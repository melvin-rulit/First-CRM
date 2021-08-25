<template>


    <div class="collapse navbar-collapse">

<!--        <addnewuser-component @get-method="updateDataWhenExitModalAddKurer"-->
<!--                              ref="add_user"></addnewuser-component> -->

        <addnewuser-component
                              ref="add_user"></addnewuser-component>

<!--        <showCalendar-component-->
<!--                              ref="show_Calendar"></showCalendar-component>-->


        <ul class="navbar-nav mr-auto tracking-widest rol">

            <li>
                <router-link to="/home" class="nav-link exact "><img src="/images/icon-header/house.png">
                </router-link>
            </li>

            <li>
                <router-link to="/kurer" class="nav-link text-lg "><img src="/images/icon-header/users.png">
                </router-link>
            </li>

            <li>
                <router-link to="/vcallendar" class="nav-link text-lg "><img src="/images/icon-header/placeholder.png">
                </router-link>
            </li>

            <li>
                <router-link to="/setings" class="nav-link  "><img src="/images/icon-header/settings.png"></router-link>
            </li>

        </ul>

        <div>

        </div>

        <ul class="navbar-nav ml-auto">

            <b-button v-if="ifThisRoute" @click="addNewUser" variant="outline-primary">
                <h5>Добавить Курьера</h5>
            </b-button>

            <div class="mt-2" v-if="ifThisRouteZakaz"   variant="outline-primary" >

                <input-form
                    v-model="contractFrom"
                    name="birthday"
                    datePicker="true"
                    placeholder="Фильтр по дате"
                    @edit-field="editFieldforFilter"
                    @clear="clear"
                >
                </input-form>

            </div>





                <li v-if="ifThisRouteZakaz" ><a href="#" class="nav-link text-lg "><img
                src="/images/icon-header/printer.png" alt="print"></a></li>

<!--            <b-sidebar id="sidebar-right" title="" right shadow    sidebar-class="border-right border-danger">-->
<!--                <template #default="{ hide }">-->
<!--                <div class="px-3 py-2 card card-body">-->

<!--                                    <b-calendar-->

<!--                                        id="ex-disabled-readonly"-->
<!--                                        selected-variant="success"-->
<!--                                        today-variant="info"-->
<!--                                        nav-button-variant="danger"-->
<!--                                        @context="onContext">-->

<!--                                    </b-calendar>-->

<!--                </div>-->
<!--                    <b-button variant="dark" block @click="getFilter">Отфильтровать</b-button>-->
<!--                </template>-->

<!--            </b-sidebar>-->

            <li><a href="#" @click.prevent="loGout()" class="nav-link text-lg "><img
                src="/images/icon-header/logout.png" alt="Logout"></a></li>

        </ul>
    </div>


</template>

<script>

import {mapActions, mapGetters} from "vuex";

export default {

    data() {
        return {
             date: '',
            // contractFrom: '13-04-2021',
            // contractFrom: new Date(),
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
    },

    methods: {
        ...mapActions(['FilterZakaz']),

        addNewUser() {
            this.$refs.add_user.addNewUserModal()
        },

        onContext(ctx) {
            this.value = ctx.activeYMD
        },

        editFieldforFilter(e, name, type) {

            if (e){

                this.$store.dispatch('FilterZakaz', {date: e})
            }



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

