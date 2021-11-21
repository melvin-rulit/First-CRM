<template>
    <div>

        <!-- Модальное окно с редактированием типа доставки -->

        <b-modal id="editDeliv" title="Отредактируйте поле  : Доставка" @ok="sendData" @hidden="ClearModal" centered
                 ok-only ok-title="Отмена">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ Zakaz.orderid }} ]</b>

            </template>

            <div class="card-body py-0">

                <b-row class="card-body">

                                <b-col cols="3">Доставка</b-col>
                                <b-col>
                                    <b-form-select
                                        v-model="tupeZakaz"
                                        :options="options_type"
                                        @change="sendData"
                                    ></b-form-select>
                                </b-col>

                            </b-row>

            </div>

        </b-modal>
    </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

import DynamicSelect from 'vue-dynamic-select'
Vue.use(DynamicSelect)


export default {
    data() {

        return {
            Zakaz: [],
            SelectKurer: {},
            tupeZakaz: null,

            options_type: [
                {value: 'null', text: 'Тип доставки'},
                {value: '0', text: 'Курьер'},
                {value: '1', text: 'Самовывоз'},
            ],
        }
    },

    computed: {
        ...mapGetters(['AllKurers']),

    },

    methods: {

        ...mapActions(['GetAllKurer', 'GetAllZakaz']),

        editZakazModal(item) {
            this. GetAllKurer()
            this. Zakaz = item
            this. SelectKurer = ''
            this. $bvModal.show('editDeliv')

        },

        sendData() {

            if (this.tupeZakaz !== null ) {

                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.Zakaz.id, field_name: 'deliv', field_value: this.tupeZakaz

                }) .then((response) =>{

                    if (response.data === "Заказ обновлен") {

                        Vue.$toast.open({
                            message: 'Доставка обновлена',
                            type: 'success',
                            duration: 3000,
                            position: 'top'
                        });

                        this.$bvModal.hide('editDeliv')
                        this.GetAllZakaz()
                        this.$emit('get-method')
                    }
                });


            }
            },

        ClearModal(){
            this.tupeZakaz = null
            this.Zakaz = ''
        },


    },
}
</script>

