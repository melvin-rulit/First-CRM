<template>
    <div>

        <!-- Модальное окно с добавлением новой роли -->
        <b-modal id="editZakazPay" title="Отредактируйте поле  : Оплата" @ok="sendData"  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

            <div class="card-body py-0">


            <b-row class="card-body">

                <b-col cols="3">Оплата</b-col>
                <b-col>
                    <b-form-select
                        v-model="tupePay"
                        :options="Oplata"
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
            if (this.tupeZakaz !== null ) {

                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.Pay.id, field_name: 'pay', field_value: this.tupePay

                })

                this.GetAllZakaz()

                setTimeout(() => {
                    Vue.$toast.open({
                        message: "Тип оплаты обновлен",
                        type: 'success',
                        duration: 2000,
                        position: 'bottom-right'
                    });

                }, 500)
            }

        },

        ClearModal(){
            this.tupePay = null
        },


    },
}
</script>

