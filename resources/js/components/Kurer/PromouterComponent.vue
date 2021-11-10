<template>
    <div>
        <vue-confirm-dialog></vue-confirm-dialog>

        <div class="row">
            <div class="col-10 mb-1 mt-1">

                <h4 class="ml-2">Всего заказов: <b-badge>{{ sumZakaz_for_kurer }} </b-badge></h4>

            </div>

            <div class=" col-0 ">

                <a href="#" @click="loGout">
                    <div class="avatar mb-1 mt-1"><img src="/images/icon-promouter/pop.png"></div>
                </a>
            </div>


        </div>

        <!------------------------------------------------------------------------------------------------------------------------------------>

        <button

            v-for="item in AllZakaz_for_kurer"
            @click="sendSuccess(item)"
            class="pointer bop">

            <div class="row">
                <div class="col-1">

                    <div class="avatar mt-2" v-if=" item.status_kurer == 1"><img src="/images/icon-promouter/success.png"></div>

                    <div class="avatar mt-2" v-else><img src="/images/icon-promouter/take-away.png"></div>

                    <div class="avatar mt-3">№ {{ item.kvadrat_id }}</div>

                </div>

                <div class="col-10">

                    <b-col><i class="fas fa-user-alt mr-1"></i> {{ item.nameus }} <i class="fas fa-mobile-alt ml-2 mr-1"></i>{{ item.tel }}</b-col>
                    <b-col><i class="fas fa-map-marker-alt mr-1"></i> {{ item.adress }}</b-col>
                    <b-col><i class="fas fa-utensils mr-1"></i> {{ item.racion }}</b-col>
                    <b-col><i class="fas fa-dollar-sign mr-1"></i> {{ item.total }}</b-col>

                </div>

            </div>

        </button>


    </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {

        return {

            SelectKvadrat: '',
            isLoading: true,
            fullPage: false

        }
    },

    computed: {
        ...mapGetters(['sumZakaz_for_kurer', 'AllZakaz_for_kurer']),

    },

    mounted() {

        this.getZakazForKurer()
        this.GetAllKurer()
    },

    methods: {
        ...mapActions(['GetAllKurer', 'getZakazForKurer']),

        sendSuccess(item) {

            axios.post('api/v1/sendSuccess', {id: item.id , status: item.status_kurer})

            this.getZakazForKurer()

                .then((response) =>{

                if (response.data === "success") {

                    setTimeout(() => {

                        this.getZakazForKurer()

                    },1000)
                }
            });

        },

        loGout() {
            this.$confirm(
                {
                    title: 'Выйти из системы?',

                    button: {
                        yes: 'Да',
                        no: 'Отмена'
                    },

                    callback: confirm => {
                        if (confirm) {
                            axios.post("/logout").then(response => {
                                window.location.replace("/");
                            });
                        }
                    }
                }
            )
        }

    },

}
</script>

<style scoped>

.bop {
    width: 100%;
    /*border: 1px solid;*/
    /*border-bottom: 1px solid;*/
    /*border-top: 1px solid;*/
    border-right: 0px solid;
}

.avatar {
    width: 40px;
    height: 40px;
}

.avatar img {
    width: 100%;
    height: 100%;
}

</style>
