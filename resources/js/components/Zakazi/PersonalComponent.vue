<template>

        <div>

<!--            <showCalendar-component @get-method="fetch" ref="edit_Data"></showCalendar-component>-->
            <showModalEditZakazField-component @get-method="updateZakaz" ref="editZakaz"></showModalEditZakazField-component>

            <b-sidebar id="Date_delivery" title="" right shadow    sidebar-class="border-right border-danger">
                <template #default="{ hide }">
                    <div class="px-3 py-2 card card-body">

                        <b-calendar

                            id="ex-disabled-readonly"
                            selected-variant="success"
                            today-variant="info"
                            nav-button-variant="danger"
                            @context="onContext"
                            @input="sendEdit_Date_delivery">

                        </b-calendar>

                    </div>

                </template>

            </b-sidebar>

            <b-sidebar id="End_Date" title="" right shadow    sidebar-class="border-right border-danger">
                <template #default="{ hide }">
                    <div class="px-3 py-2 card card-body">

                        <b-calendar

                            id="ex-disabled-readonly"
                            selected-variant="success"
                            today-variant="info"
                            nav-button-variant="danger"
                            @context="onContext"
                            @input="sendEdit_End_Date">

                        </b-calendar>

                    </div>

                </template>

            </b-sidebar>

<!------------------------------------------------------------------------------------------------------------------------------------------>

            <b-table

                hover
                :bordered="false"
                :fields="fields"
                :items="AllZakaz.data"
                responsive="sm"
                :no-border-collapse="true"
                @row-clicked="rowSelectedForEditField"
                row-hovered="row"
                head-variant="dark">

                <template #cell(orderid)="data">
                    <b class="">{{ data.item.orderid}}</b>
                </template>

                <template v-slot:cell(pay)="row">
                    <span>{{ getProgram(row.item.pay) }}</span>
                </template>

<!--------------------------------------------------------------------------------------------------------------------------------------------->

                <template v-slot:cell(date_delivery)="row">
                    <b-form-group>
                        <b v-b-toggle.Date_delivery @click="rowSelectedForDate_delivery(row.item)"> {{ row.item.date_delivery}}</b>
                    </b-form-group>
                </template>

                <template v-slot:cell(end_Date)="row">
                    <b-form-group>
                        <b v-b-toggle.End_Date @click="rowSelectedForEnd_Date(row.item)"> {{ row.item.end_Date}}</b>
                    </b-form-group>
                </template>

            </b-table>

        </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {
        return {

            value: '',
            valueEditField: '',

            fields: [
                {
                key: 'orderid',
                label: 'Номер заказа',
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
                    // variant: 'success'
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

        this.GetAllZakaz()
    },

    computed: {
        ...mapGetters(['AllZakaz']),

    },

    methods: {
        ...mapActions(['GetAllZakaz']),

        getProgram($type){
            if ($type === 'оплата готівкою'){
                return 'Не Оплачено'
            }else if($type === 'оплата карткою'){
                return 'Оплачено'
            }
        },

        rowSelectedForDate_delivery(index){
          this.valueEditField = index.id
        },

        rowSelectedForEnd_Date(index){
          this.valueEditField = index.id
        },

        rowSelectedForEditField(index){
            this.$refs.editZakaz.editZakazModal(index)
        },

        //------------------------------------------- Изменяем данные с календаря для  Date_delivery------------------------------------//

        sendEdit_Date_delivery(){

            setTimeout(() => {
                    axios.post('api/v1/edit_Date_Delivery', {id: this.valueEditField, field_value: this.value})

                this.GetAllZakaz()

                Vue.$toast.open({
                    message: "Дата доставки изменена",
                    type: 'success',
                    duration: 2000,
                    position: 'bottom-right'
                });

            },500)

        },

        //------------------------------------------- Изменяем данные с календаря для  End_Date------------------------------------//

        sendEdit_End_Date(){

            setTimeout(() => {
                    axios.post('api/v1/edit_End_Date', {id: this.valueEditField, field_value: this.value})

                this.GetAllZakaz()

                Vue.$toast.open({
                    message: "Дата окончания изменено",
                    type: 'success',
                    duration: 2000,
                    position: 'bottom-right'
                });

            },500)

        },

        onContext(ctx) {
            this.value = ctx.selectedYMD
        },

        updateZakaz() {

            setTimeout(() => {

                Vue.$toast.open({
                    message: "Заказ удален",
                    type: 'error',
                    duration: 2000,
                    position: 'bottom-right'
                });

            }, 500)

            this.GetAllZakaz()
        },

    }
}

</script>

<style>

.sidebar .nav-item {
    cursor: pointer;
}
</style>
