<template>

    <div>

        <showModalEditZakazFieldPay-component @get-method="updateZakaz"
                                              ref="editZakazPay"></showModalEditZakazFieldPay-component>
        <showModalEditZakazFieldDeliv-component @get-method="updateZakaz"
                                                ref="editZakazDeliv"></showModalEditZakazFieldDeliv-component>
        <showModalEditZakazFieldKurer-component @get-method="updateZakaz"
                                                ref="editZakazKurer"></showModalEditZakazFieldKurer-component>
        <showModalEditZakazFieldRacion-component @get-method="updateZakaz"
                                                 ref="editZakazRacion"></showModalEditZakazFieldRacion-component>
        <showModalEditZakazFieldTotal-component @get-method="updateZakaz"
                                                ref="editZakazTotal"></showModalEditZakazFieldTotal-component>

        <showModalEditZakazDataDelivery-component ref="editDateDelivery"></showModalEditZakazDataDelivery-component>


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

            <!--            <template v-slot:cell(orderid)="row">-->
            <!--                <b  class="pointer" @click="row.toggleDetails">{{ row.item.orderid}}</b>-->
            <!--            </template>-->

            <template v-slot:cell(orderid)="row">
                <b-form-group>
                    <b class="pointer"> {{ row.item.orderid }}</b>
                </b-form-group>
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
                <span class="pointer" @click="rowSelectedForEditFieldDeliv(row.item)">{{
                        getDeliv(row.item.deliv)
                    }}</span>
            </template>

            <template v-slot:cell(datetimes)="row">
                <b-form-group>
                    <p class="ml-2"> {{ row.item.datetimes }}</p>
                </b-form-group>
            </template>

            <template v-slot:cell(date_delivery)="row">
                <b-form-group>
                    <b class="ml-3 pointer" @click="rowSelectedForEditDateDelivery(row.item)">
                        {{ row.item.date_delivery }}</b>
                </b-form-group>
            </template>

            <template v-slot:cell(end_Date)="row">
                <b-form-group>
                    <b class="ml-3">{{ row.item.end_Date }}</b>
                </b-form-group>
            </template>

            <!---------------------------------------------------------------------------------------------------------------------------------------------->

            <!--                <template #row-details="row">-->

            <!--                    <b-row class="mb-2">-->

            <!--                        <b-col sm="3" class="text-sm-right"><b>Период заказа заканчивается :</b></b-col>-->

            <!--                        <div class="col-sm-7">-->


            <!--                        </div>-->

            <!--                    </b-row>-->

            <!--                </template>-->

        </b-table>

    </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {

        return {

            value: '',
            color: 'danger',
            date_copy: '',
            value_Edit: '',
            valueEditField: '',
            selectedYMD: '',
            showSidebar: false,


            fields: [
                {
                    key: 'orderid',
                    label: 'Номер заказа',
                    variant: ''
                },
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

    computed: {
        ...mapGetters(['AllZakaz']),

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


        rowSelectedForEnd_Date(index) {
            this.valueEditField = index.id
        },

        rowSelectedForEditFieldTotal(index) {
            this.$refs.editZakazTotal.editZakazModal(index)
        },
        rowSelectedForEditFieldPay(index) {
            this.$refs.editZakazPay.editZakazModal(index)
        },

        rowSelectedForEditFieldKurer(index) {
            this.$refs.editZakazKurer.editZakazModal(index)
        },

        rowSelectedForEditFieldDeliv(index) {
            this.$refs.editZakazDeliv.editZakazModal(index)
        },

        rowSelectedForEditFieldRacion(index) {
            this.$refs.editZakazRacion.editZakazModal(index)
        },

        rowSelectedForEditDateDelivery(index) {
            this.$refs.editDateDelivery.showEditDateDeliveryModal(index)
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

                        axios.delete('api/v1/zakaz/' + index.id) .then((response) =>{

                            if (response.data === "Заказ удален") {

                                Vue.$toast.open({
                                    message: 'Заказ удален',
                                    type: 'success',
                                    duration: 3000,
                                    position: 'top'
                                });

                            }
                        });

                        this.GetAllZakaz()

                    }
                })

        },

        showUserFilter() {
            this.GetAllZakaz()

        },

        updateZakaz() {
            this.GetAllZakaz()

        },


    }
}

</script>

<style>

.pointer {
    cursor: pointer;
}
</style>
