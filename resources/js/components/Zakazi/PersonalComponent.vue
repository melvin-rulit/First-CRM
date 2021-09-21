<template>

        <div>

            <showModalEditZakazFieldPay-component @get-method="updateZakaz" ref="editZakazPay"></showModalEditZakazFieldPay-component>
            <showModalEditZakazFieldDeliv-component @get-method="updateZakaz" ref="editZakazDeliv"></showModalEditZakazFieldDeliv-component>
            <showModalEditZakazFieldKurer-component @get-method="updateZakaz" ref="editZakazKurer"></showModalEditZakazFieldKurer-component>
<!--            <showModalEditZakazFieldRacion-component @get-method="updateZakaz" ref="editZakaz"></showModalEditZakazFieldRacion-component>-->
            <showModalEditZakazFieldTotal-component @get-method="updateZakaz" ref="editZakazTotal"></showModalEditZakazFieldTotal-component>


            <b-sidebar id="Date_delivery" title="" right shadow    width="300px" text-variant="light" bg-variant="dark" sidebar-class="border-right border-danger">
                <template #default="{ hide }">
                    <div class="mt-5">
<!--                        v-model='range'-->
                        <v-date-picker
                            v-model="dateRange"
                            mode='range'

                            title-position="left"
                            :rows="2"
                            is-range
                            color="green"
                            class="ml-4"

                        />

                        <date-picker
                            class="ots"
                            :lang="lang"
                            v-model="value"
                            value-type="format"
                            :clearable = "false"
                            format="DD-MM-YYYY"
                            @input="sendEdit_Date_delivery">

                        </date-picker>



                        <b-alert
                            class="ml-4"
                            :show="dismissCountDown"
                            dismissible
                            variant="info"
                            @dismissed="dismissCountDown=0"
                            @dismiss-count-down="countDownChanged">

                            <p>Дата переноса заказа не может быть больше 3 дней</p>
                            <b-progress
                                variant="danger"
                                :max="dismissSecs"
                                :value="dismissCountDown"
                                height="4px"
                            ></b-progress>
                        </b-alert>
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
                :bordered="true"
                :fields="fields"
                :items="AllZakaz.data"
                :small="true"
                :no-border-collapse="false"
                @row-middle-clicked="deleteField"
                row-hovered="row"
                head-variant="dark"
                :tbody-tr-class="rowClass">


<!--------------------------------------------------------------------------------------------------------------------------------------------->

                <template v-slot:cell(orderid)="row">
                    <b  class="pointer" @click="row.toggleDetails">{{ row.item.orderid}}</b>
                </template>

                <template v-slot:cell(kurer)="row">
                    <p class="pointer ml-2" @click="rowSelectedForEditFieldKurer(row.item)">{{ row.item.kurer }}</p>
                </template>

                <template v-slot:cell(total)="row">
                    <span class="pointer" @click="rowSelectedForEditFieldTotal(row.item)">{{ row.item.total }}</span>
                </template>

                <template v-slot:cell(pay)="row">
                    <span class="pointer" @click="rowSelectedForEditFieldPay(row.item)">{{ getPay(row.item.pay) }}</span>
                </template>

                <template v-slot:cell(deliv)="row">
                    <span class="pointer" @click="rowSelectedForEditFieldDeliv(row.item)">{{ getDeliv(row.item.deliv) }}</span>
                </template>

                <template v-slot:cell(datetimes)="row">
                    <b-form-group>
                        <p  class="ml-2"> {{ row.item.datetimes}}</p>
                    </b-form-group>
                </template>

                <template v-slot:cell(date_delivery)="row">
                    <b-form-group>
                        <b v-b-toggle.Date_delivery @click="rowSelectedForDate_delivery(row.item)" class="ml-3 pointer"> {{ row.item.date_delivery}}</b>

                    </b-form-group>

                </template>

                <template v-slot:cell(end_Date)="row">
                    <b-form-group >

<!--                        <b  v-b-toggle.End_Date @click="rowSelectedForEnd_Date(row.item)"> {{ row.item.end_Date}}</b>-->
                        <b class="ml-3">{{ row.item.end_Date}}</b>
                    </b-form-group>
                </template>

<!---------------------------------------------------------------------------------------------------------------------------------------------->

                <template #row-details="row">

                    <b-row class="mb-2">

                        <b-col sm="3" class="text-sm-right"><b>Период заказа заканчивается :</b></b-col>

                        <div class="col-sm-7">


                        </div>

                    </b-row>

                </template>


                <template #row-detailss="row">

                    <b-row class="mb-2">

                        <b-col sm="3" class="text-sm-right"><b>П</b></b-col>

                        <div class="col-sm-7">


                        </div>

                    </b-row>

                </template>




            </b-table>

        </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {

        return {
            start_date: "2021-8-13",
            end_date: "2021/8/25",

            lang: {
                formatLocale: {
                    firstDayOfWeek: 1,
                    weekdaysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    monthsShort: ['Янв', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                },

            },

            dismissSecs: 6,
            dismissCountDown: 0,
            showDismissibleAlert: false,

            value: '',
            color: 'danger',
            date_copy: '',
            value_Edit: '',
            valueEditField: '',
            selectedYMD: '',

            fields: [
                {
                key: 'orderid',
                label: 'Номер заказа',
                    variant: ''
                },
                // {
                //     key: 'array',
                //     label: 'array',
                // },
                {
                    key: 'kvadrat_id',
                    label: '№',

                },
                {
                    key: 'kurer',
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
                    key: 'total',
                    label: 'Сумма',
                },
                {
                    key: 'pay',
                    label: 'Оплата',
                },
                {
                    key: 'datetimes',
                    label: 'Дата заказа',
                    variant: 'warning'
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

        dateRange: {

            get() {

                let start = this.start_date
                let end = this.end_date

                let range = {
                    start: new Date(start),
                    end: new Date(end),
                }

                return range
            }
        }

    },

    methods: {
        ...mapActions(['GetAllZakaz']),

        rowClass(item, type) {
            if (!item || type !== 'row') return
            if (item.status === 1) return 'table-danger'
        },

        getPay($type) {
            if ($type === 0) {
                return 'Не Оплачено'
            } else if ($type === 1) {
                return 'Оплачено'
            }
        },

        getDeliv($type) {
            if ($type === 0) {
                return 'Курьером'
            } else if ($type === 1) {
                return 'Самовывоз'
            }
        },

        countDownChanged(dismissCountDown) {
            this.dismissCountDown = dismissCountDown
            this.value = this.date_copy
        },
        showAlert() {
            this.dismissCountDown = this.dismissSecs
        },

        rowSelectedForDate_delivery(index){
            this.value = index.date_delivery
            this.date_copy = index.date_delivery
          this.valueEditField = index.id
        },

        rowSelectedForEnd_Date(index){
          this.valueEditField = index.id
        },

        rowSelectedForEditFieldTotal(index){
             this.$refs.editZakazTotal.editZakazModal(index)
        },
        rowSelectedForEditFieldPay(index){
             this.$refs.editZakazPay.editZakazModal(index)
        },

        rowSelectedForEditFieldKurer(index){
             this.$refs.editZakazKurer.editZakazModal(index)
        },

        rowSelectedForEditFieldDeliv(index){
             this.$refs.editZakazDeliv.editZakazModal(index)
        },


        //------------------------------------------- Изменяем данные с календаря для  Date_delivery------------------------------------//

        sendEdit_Date_delivery(){

            setTimeout(() => {
                    axios.post('api/v1/edit_Date_Delivery', {id: this.valueEditField, field_value:  this.value}).then((response) => {

                        response.data == "success" ?
                            Vue.$toast.open({
                            message: "Дата изменена",
                            type: 'success',
                            duration: 2000,
                            position: 'bottom-right'
                        }) :   this. showAlert()

                    })

                this.GetAllZakaz()

            },500)

        },

        //------------------------------------------- Изменяем данные с календаря для  End_Date------------------------------------//

        sendEdit_End_Date(){


            // setTimeout(() => {
                    axios.post('api/v1/edit_End_Date', {id: this.valueEditField, field_value: this.value})

                this.GetAllZakaz()

                Vue.$toast.open({
                    message: "Дата окончания изменена",
                    type: 'success',
                    duration: 2000,
                    position: 'bottom-right'
                });

            // },500)

        },

        //---------------------------------------------- Удаляем Заказ -------------------------------------------------------------//

        deleteField(index) {

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить Заказ ( ' + index.orderid + ' ) ?', {

                size: 'lg',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: 'Да',
                cancelTitle: 'Нет',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
                .then(value => {
                    this.boxTwo = value

                    if (this.boxTwo === true) {

                        axios.delete('api/v1/zakaz/' + index.id)

                        setTimeout(() => {

                            Vue.$toast.open({
                                message: "Заказ удален",
                                type: 'error',
                                duration: 2000,
                                position: 'bottom-right'
                            });

                        }, 500)

                        this.GetAllZakaz()

                    }
                })

        },

        // updateZakaz() {
        //
        //     setTimeout(() => {
        //
        //         Vue.$toast.open({
        //             message: "Заказ удален",
        //             type: 'error',
        //             duration: 2000,
        //             position: 'bottom-right'
        //         });
        //
        //     }, 500)
        //
        //     this.GetAllZakaz()
        // },

    }
}

</script>

<style>

.ots{
    margin-left: 50px;
    margin-top: 10px;
}
</style>
