<template>

        <div class="card">

            <b-table

                hover
                :bordered="false"
                :fields="fields"
                :items="kassa"
                responsive="sm"
                :no-border-collapse="true"
                head-variant="dark">

                <template #cell(orderid)="data">
                    <b class="">{{ data.item.orderid}}</b>
                </template>

                <template v-slot:cell(pay)="row">
                    <span>{{ getProgram(row.item.pay) }}</span>
                </template>

                <template v-slot:cell(date_delivery)="row">
                  <button>{{ row.item.date_delivery}}<b-icon  icon="trash" @click="rowSelectedForEditData(row.item)"></b-icon></button>
                </template>

            </b-table>

        </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {
        return {
kassa:{},
            edit_Data:{},

            fields: [
                {
                key: 'orderid',
                label: 'Номер заказа',
                    variant: 'success'

                },
                {
                    key: 'network',
                    label: '№',
                },
                {
                    key: 'name',
                    label: 'Курьер',
                },
                {
                    key: 'adress',
                    label: 'Адресс доставки',
                },
                {
                    key: 'nameus',
                    label: 'Клиент',
                },
                {
                    key: 'tel',
                    label: 'Телефон',
                },
                {
                    key: 'deliv',
                    label: 'Доставка',
                },
                {
                    key: 'racion',
                    label: 'Рацион',
                },
                {
                    key: 'pay',
                    label: 'Оплата',
                },
                {
                    key: 'datetimes',
                    label: 'Дата заказа',
                    variant: 'success'
                },
                {
                    key: 'date_delivery',
                    label: 'Дата доставки',
                    variant: 'success'
                },
                {
                    key: 'end_Date',
                    label: 'Окончание',
                    variant: 'success'
                },
            ],
        }
    },

    mounted() {
// this. getzakaz()
        // this.GetAllZakaz()
    },


    computed: {
        ...mapGetters(['AllZakaz']),

    },

    methods: {
        ...mapActions(['GetAllZakaz', 'FilterZakaz']),

        getProgram($type){
            if ($type === 'оплата готівкою'){
                return 'Оплачено'
            }else if($type === 'оплата карткою'){
                return 'не оплачено'
            }
        },

      // getFilter() {
      //       axios.get('api/v1/zakazFilter', {  PeriodDate: 'Tue, 03 Aug 21 20:36:57 +0400'})
      //           .then(response => this.kassa = response.data.data)
      //
      //   },

        // getzakaz() {
        //
        //     axios.get(`api/v1/zakaz`)
        //         .then(response => this.kassa = response.data.data)
        //
        // },

        rowSelectedForEditData(row) {
            this.edit_Data = row
        },

    }
}

</script>

<style>

</style>
