<template>
    <div>

        <b-modal id="edtDateDelivery" title="" @hidden="clearFindZakaz" size="lg" centered hide-header="true"
                 hide-footer="true">
            <b-alert show variant="secondary">
                <h7 class="ml-5">№ заказа</h7>
                <b>[ {{ sendTel.orderid }} ]</b> Заказчик <b> [ {{ sendTel.nameus }} ]</b> тел <b>[ {{ sendTel.tel }}
                ]</b>
                <b-alert show variant="info" class="center mt-2">Доставка <b>[ {{ duration }} ] </b></b-alert>
            </b-alert>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-2">

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">

                                    <button
                                        v-if="type_7_9"
                                        v-for="item in sendTel.end_array"
                                        @click="selectData(item)"
                                        class="btn btn-sm "
                                        :class="selectDate == item ?  passed_day_2 :  passed_day">
                                        <b>{{ item }}</b>
                                    </button>

                                    <button
                                        v-if="type_7_9"
                                        v-for="item in sendTel.array"
                                        @click="selectData(item)"
                                        class="btn btn-sm "
                                        :class=" selectDate == item ? 'btn-primary' : '' ">
                                        <b>{{ item }}</b>
                                    </button>

                                    <button
                                        v-if="type_1"
                                        @click="selectData( sendTel.array)"
                                        class="btn btn-sm "
                                        :class=" selectDate ==  sendTel.array ? 'btn-primary' : '' ">
                                        <b>{{ sendTel.array }}</b>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-7">

                    <v-date-picker
                        v-model="date"
                        title-position="left"
                        :columns="layout.columns"
                        :rows="layout.rows"
                        :attributes='attributes'
                        @input="sendEdit_Date_delivery"
                        color="green"/>

                </div>

                <div class="col-lg-5">

                    <b-card v-if="show_info" class="text-center ot" border-variant="success">
                        <b-card-text>Для переноса заказа сначала: кликнув по списку дат доставки ( выберите ту дату,
                            которую нужно перенести) после этого в календаре кликните день для переноса выбранного выше
                            числа доставки заказа
                        </b-card-text>
                    </b-card>

                    <b-card v-if="show_first_send" class="text-center ot mt-4" border-variant="primary">
                        <b-card-text>Выбрана ( <b>{{ this.selectDate }} ) </b> дата для переноса доставки заказа. Теперь
                            выберите дату в календаре на которую нужно перенести заказ
                        </b-card-text>
                    </b-card>

                    <b-card v-if="show_error_send" class="text-center ot mt-4" border-variant="danger"
                            title=" Сначала, выберите из списка выше - ту дату заказа, которую нужно перенести">
                    </b-card>

                    <b-card v-if="show_error_if_have_end_array" class="text-center ot mt-2" border-variant="danger"
                            title="Возможность перенести эту дату уже прошла. Перенести дату можно ту, которая не перечеркнута!">
                    </b-card>

                    <b-card v-if="show_succes_send" title="Заказ перенесен на: " class="text-center ot mt-5"
                            border-variant="primary">
                        <b-card-text><b>{{ this.incominGoodDate }}</b></b-card-text>
                    </b-card>
                </div>

            </div>


        </b-modal>

    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/calendar.umd'

export default {

    components: {
        Calendar,
        DatePicker
    },

    data() {

        return {
            sendTel: '',
            date: '',
            select_end_array: 0,
            end_array: [],
            selectDate: '',
            incominGoodDate: '',
            show_succes_send: false,
            show_error_send: false,
            show_first_send: false,
            show_error_if_have_end_array: false,
            show_info: true,

            attributes: [

                {
                    highlight: {
                        color: 'red',
                        fillMode: 'outline',

                    },

                    dates: [
                        new Date()
                    ]

                }
            ],
        }
    },

    computed: {
        ...mapGetters(['DataFind', 'PhoneFind']),

        layout() {
            return this.$screens(
                {
                    // Default layout for mobile
                    default: {
                        columns: 1,
                        rows: 1,
                        isExpanded: true,
                    },
                    // Override for large screens
                    lg: {
                        columns: 2,
                        rows: 1,
                        isExpanded: false,
                    },
                },
            );
        },

        type_1() {

            if (this.sendTel.type_zakaz === 1) {
                return true
            } else {
                return false
            }
        },

        type_7_9() {

            if (this.sendTel.type_zakaz === 7 || this.sendTel.type_zakaz === 9) {
                return true
            } else {
                return false
            }
        },

        duration() {

            if (this.sendTel.type_zakaz === 1) {
                return "1 День"

            } else if (this.sendTel.type_zakaz === 7) {
                return "7 Дней"

            } else {
                return "30 Дней"
            }
        },

        passed_day() {
            return 'sot'
        },

        passed_day_2() {
            return 'btn-danger sot'
        },


    },

    methods: {
        ...mapActions(['GetAllZakaz']),

        showEditDateDeliveryModal(item) {

            this.sendTel = item
            this.end_array = item.end_array
            this.$bvModal.show('edtDateDelivery')

        },


        selectData(item) {
            this.date = ''
            this.selectDate = item
            this.show_info = false
            if (this.show_error_send == false) {

                if (this.end_array !== null) {

                    if (this.end_array.includes(this.selectDate)) {
                        this.show_first_send = false
                        this.select_end_array = 1
                        this.show_error_if_have_end_array = true
                    } else {
                        this.show_error_if_have_end_array = false
                        this.show_first_send = true
                        this.select_end_array = 0
                    }
                } else {
                    this.show_error_if_have_end_array = false
                    this.show_first_send = true
                    this.select_end_array = 0
                }
            } else {
                this.selectDate = ''
            }

        },

        //-------------------------------------------  Изменяем данные с календаря  ------------------------------------//

        sendEdit_Date_delivery() {

            if (this.selectDate && this.select_end_array === 0) {

                if (this.date !== null) {

                    axios.post('api/v1/edit_Date_Delivery', {id: this.sendTel.id, field_value: this.date})

                        .then((response) => {

                            if (response.data === "<=") {

                                this.$alert('Нельзя вбрыть эту дату, т.к она меньше либо равна  последней дате доставки заказа ')
                                this.response_status = response.data

                            } else if (response.data === ">=") {

                                this.$alert('Нельзя вбрыть эту дату, т.к она больше  даты на которую можно перенести дату этого заказа ')
                                this.response_status = response.data

                            } else {

                                this.incominGoodDate = response.data

                                this.$bvModal.msgBoxConfirm('Вы уверены что хотите  перенести  дату  ( ' + this.selectDate + ' ) на выбранную дату  в календаре ?', {
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

                                            axios.post('api/v1/ edit_Date_Delivery_if_Confirm', {
                                                id: this.sendTel.id,
                                                field_value: this.date,
                                                data: this.selectDate
                                            }).then((response) => {

                                                if (response.data === "Дата доставки изменена") {

                                                    this.$emit('get-method')
                                                    this.show_succes_send = true
                                                    this.show_info = false
                                                    this.show_first_send = false

                                                    setTimeout(() => {

                                                        this.$bvModal.hide('edtDateDelivery')

                                                        Vue.$toast.open({
                                                            message: 'Дата доставки успешно перенесена',
                                                            type: 'success',
                                                            duration: 3000,
                                                            position: 'top'
                                                        });

                                                    }, 2500)

                                                    if (this.DataFind.data) {
                                                        this.$store.dispatch('DataFilterZakaz', {data: this.DataFind.data})
                                                    }

                                                    else if (this.PhoneFind.phone) {
                                                        this.$store.dispatch('PhoneFilterZakaz', {phone: this.PhoneFind.phone})
                                                    }

                                                    else {
                                                        this.GetAllZakaz()
                                                    }

                                                }
                                            });

                                        }

                                    });
                            }
                        })
                }


            } else if (this.select_end_array === 1) {

                this.show_error_send = false

            } else {

                this.show_error_send = true
                this.show_info = false

                setTimeout(() => {

                    this.show_error_send = false
                    this.show_info = true
                    this.show_first_send = false

                }, 4000)

            }


        },

        clearFindZakaz() {
            this.selectDate = ''
            this.sendTel = ''
            this.date = ''
            this.select_end_array = 0
            this.incominGoodDate = ''
            this.show_succes_send = false
            this.show_info = true
            this.show_first_send = false
            this.show_error_if_have_end_array = false
        },

    }

}
</script>

<style scoped>
.center {
    text-align: center;
}

.sot {
    text-decoration: line-through;
}

.ot {
    margin-left: 50px;
}
</style>
