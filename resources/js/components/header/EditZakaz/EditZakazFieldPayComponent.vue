<template>
    <div>

        <b-modal id="editZakazPay" title="Отредактируйте поле  : Оплата" @ok="sendData"  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ Pay.orderid }} ]</b>

            </template>


            <b-row class="card-body">

                <b-col cols="3">Оплата</b-col>
                <b-col>
                    <b-form-select
                        v-model="tupePay"
                        :options="Oplata"
                        @change="sendData"
                    ></b-form-select>
                </b-col>

            </b-row>


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
            Pay: [],
            SelectKurer: {},
            tupePay: null,

            Oplata: [
                {value: 'null', text: 'Выберите из списка '},
                {value: '1', text: 'Оплачено'},
                {value: '0', text: 'Не оплачено'},
            ],
        }
    },

    computed: {
        ...mapGetters(['AllKurers']),

    },

    methods: {

        ...mapActions(['GetAllKurer', 'GetAllZakaz']),

        editZakazModal(item) {
            this. Pay = item
            this. SelectKurer = ''
            this. $bvModal.show('editZakazPay')

        },

        sendData() {
            if (this.tupePay !== null ) {

                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.Pay.id, field_name: 'pay', field_value: this.tupePay

                }) .then((response) =>{

                    if (response.data === "Заказ обновлен") {

                        Vue.$toast.open({
                            message: 'Тип оплаты обновлен',
                            type: 'success',
                            duration: 3000,
                            position: 'top'
                        });
                        this.$bvModal.hide('editZakazPay')
                    }

                    this.GetAllZakaz()

                });


            }

        },

        ClearModal(){
            this.tupePay = null
        },


    },
}
</script>

