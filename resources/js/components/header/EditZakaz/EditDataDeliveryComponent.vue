<template>
    <div>

        <b-modal id="edtDateDelivery" title="" @hidden="clearFindZakaz" size="lg" centered hide-header="true"
                 hide-footer="true">
            <b-alert show variant="secondary">
                <h7 class="ml-5">№ заказа</h7>
                <b>[ {{ sendData.orderid }} ]</b> Заказчик <b> [ {{ sendData.nameus }} ]</b> тел <b>[ {{ sendData.tel }}
                ]</b>
                <b-alert show variant="info" class="center mt-2">Доставка <b>[ {{ duration }} ] </b></b-alert>
            </b-alert>

            <b-container class="bv-example-row">
                <b-row>
                    <b-col v-if="success_Send">
                        <div class="card mb-2" v-if="type_9">

                            <div class="card-header">
                                <div class="row align-items-center w-70">

                                    <button

                                        v-for="item in sendData.end_array"
                                        @click="selectData(item)"
                                        class="btn btn-sm ml-3"
                                        :class="selectDate == item ?  passed_day_2 :  passed_day">
                                        <b>{{ item }}</b>
                                    </button>

                                    <button

                                        v-for="item in sendData.array"
                                        @click="selectData(item)"
                                        class="btn btn-sm ml-3"
                                        :class=" selectDate == item ? 'btn-primary' : '' ">
                                        <b>{{ item }}</b>
                                    </button>

                                </div>
                            </div>

                        </div>

                        <div class="card mt-3 " v-if="type_7">
                            <button
                                v-for="item in sendData.end_array"
                                @click="selectData(item)"
                                class="btn btn-sm "
                                :class="selectDate == item ?  passed_day_2 :  passed_day">
                                <b>{{ item }}</b>
                            </button>

                            <button

                                v-for="item in sendData.array"
                                @click="selectData(item)"
                                class="btn btn-sm  "
                                :class=" selectDate == item ? 'btn-primary' : '' ">
                                <b>{{ item }}</b>
                            </button>
                        </div>

                        <div class="card mb-2 mt-5" v-if="type_1">
                            <button
                                @click="selectData_type_1(sendData.array)"
                                class="btn btn-sm "
                                :class=" selectDate ==  sendData.array ? 'btn-primary' : '' ">
                                <b>{{ sendData.array }}</b>
                            </button>
                        </div>

                    </b-col>

                    <b-col>


                        <div>
                            <b-card v-if="show_info" class="text-center" border-variant="success">
                                <b-card-text><h4>Чтобы перенести заказ - из списка справа ( выберите ту дату,
                                    которую нужно перенести )
                                </h4></b-card-text>

                                <b-card-text><h4> После этого появится кнопка, кликнув на которую - совершится перенос
                                </h4></b-card-text>
                            </b-card>
                        </div>


                        <div>
                            <b-card v-if="show_first_send" class="text-center" border-variant="primary">
                                <b-card-text><h4>Выбрана ( <b>{{ this.selectDate }} ) </b> которая будет перенесена
                                </h4></b-card-text>

                                <b-card-text><h5><b> После нажатия на кнопку</b>
                                </h5></b-card-text>

                                <b-button variant="success" @click="sendEdit_Date_delivery_type_7_9">Перенести заказ
                                </b-button>

                                <b-card-text class="mt-2"><h4> - он будет перенесен в
                                    конец списка заказов
                                </h4></b-card-text>
                            </b-card>

                        </div>

                        <!-------------------------------------- type 1 ------------------------------------------------->

                        <div>
                            <b-card v-if="show_first_send_type_1" class="text-center" border-variant="primary">
                                <b-card-text><h4>Выбрана ( <b>{{ this.selectDate }} ) </b> которая будет перенесена
                                </h4></b-card-text>

                                <b-card-text><h5><b> После выбора даты из календаря</b>
                                </h5></b-card-text>

                                <input-form
                                    v-if="show_first_send_type_1"
                                    v-model="date"
                                    datePicker="true"
                                    placeholder="Перенос даты"
                                    @edit-field="sendEdit_Date_delivery_type_1"
                                    class="ml-2">
                                </input-form>

                                <b-card-text class="mt-2"><h4> заказ будет перенесен на выбранное число
                                </h4></b-card-text>
                            </b-card>

                        </div>

                        <b-card v-if="show_error_if_have_end_array" class="text-center mt-4" border-variant="danger"
                                title="Возможность перенести эту дату уже прошла">
                            <b-card-text>
                                <h5>
                                    <b-alert show variant="dark">Перенести дату можно ту, которая не перечеркнута!
                                    </b-alert>
                                </h5>
                            </b-card-text>
                        </b-card>

                        <div v-if="show_succes_send" class="text-center">
                            <b-card-text><h4>Заказ перенесен на: <b>{{ this.incominGoodDate }}</b></h4></b-card-text>
                            <img class="nav-link text-sm ml-4"
                                 src="/images/icon_zakaz/idit_Date_delivery_success.png">
                        </div>


                    </b-col>
                </b-row>

            </b-container>


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
            sendData: '',
            date: '',
            end_array: [],
            selectDate: '',
            incominGoodDate: '',
            show_succes_send: false,
            show_first_send: false,
            show_first_send_type_1: false,
            show_error_if_have_end_array: false,
            show_info: true,
            success_Send: true,

        }
    },

    computed: {
        ...mapGetters(['DataFind', 'PhoneFind']),

        type_1() {

            if (this.sendData.type_zakaz === 1) {
                return true
            } else {
                return false
            }
        },

        type_7() {

            if (this.sendData.type_zakaz === 7) {
                return true
            } else {
                return false
            }
        },

        type_9() {

            if (this.sendData.type_zakaz === 9) {
                return true
            } else {
                return false
            }
        },

        duration() {

            if (this.sendData.type_zakaz === 1) {
                return "1 День"

            } else if (this.sendData.type_zakaz === 7) {
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

            this.sendData = item
            this.end_array = item.end_array
            this.$bvModal.show('edtDateDelivery')

        },


        selectData_type_1(item) {

            this.selectDate = item
            this.show_info = false
            this.show_first_send_type_1 = true

        },

        selectData(item) {

            this.selectDate = item
            this.show_info = false

            if (this.end_array !== null) {

                if (this.end_array.includes(this.selectDate)) {
                    this.show_first_send = false
                    this.show_error_if_have_end_array = true
                } else {
                    this.show_error_if_have_end_array = false
                    this.show_first_send = true
                }
            } else {
                this.show_error_if_have_end_array = false
                this.show_first_send = true
            }

        },

        //-------------------------------------------  Изменяем данные с календаря  ------------------------------------//


        sendEdit_Date_delivery_type_7_9() {

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите  перенести  дату  ( ' + this.selectDate + ' )  ?', {
                size: 'lg',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: 'Да',
                cancelTitle: 'Нет',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            }).then(value => {

                if (value === true) {

                    axios.post('api/v1/edit_Date_Delivery_if_Confirm', {

                        id: this.sendData.id,
                        field_value: this.selectDate

                    }).then((response) => {

                        this.incominGoodDate = response.data

                        if (this.incominGoodDate) {

                            this.show_first_send = false
                            this.success_Send = false
                            this.show_succes_send = true

                            setTimeout(() => {

                                this.$bvModal.hide('edtDateDelivery')

                            }, 2500)

                            if (this.DataFind.data) {
                                this.$store.dispatch('DataFilterZakaz', {data: this.DataFind.data})
                            } else if (this.PhoneFind.phone) {
                                this.$store.dispatch('PhoneFilterZakaz', {phone: this.PhoneFind.phone})
                            } else {
                                this.GetAllZakaz()
                                this.$emit('get-method')
                            }

                        }
                    });

                }

            });

        },

        sendEdit_Date_delivery_type_1(item) {
            this.date = item

            axios.post('api/v1/edit_Date_Delivery', {field_value: this.date, selectData: this.selectDate})

                .then((response) => {

                    if (response.data === "<=") {

                        this.$alert('Нельзя вбрыть эту дату, т.к она меньше либо равна  последней дате доставки заказа ')
                        this.response_status = response.data

                    } else {

                        this.$bvModal.msgBoxConfirm('Вы уверены что хотите  перенести  дату  с ( ' + this.selectDate + ' ) на  ( ' + this.date + ' ) ?', {
                            size: 'lg',
                            buttonSize: 'md',
                            okVariant: 'danger',
                            okTitle: 'Да',
                            cancelTitle: 'Нет',
                            footerClass: 'p-2',
                            hideHeaderClose: false,
                            centered: true
                        }).then(value => {

                            if (value === true) {
                                axios.post('api/v1/edit_Date_Delivery_if_Confirm', {

                                    id: this.sendData.id,
                                    field_value: this.date

                                }).then((response) => {

                                    this.incominGoodDate = this.date

                                    if (response.data === "Дата доставки изменена") {

                                        this.show_first_send_type_1 = false
                                        this.success_Send = false
                                        this.show_succes_send = true

                                        setTimeout(() => {

                                            this.$bvModal.hide('edtDateDelivery')

                                        }, 2500)

                                        if (this.DataFind.data) {
                                            this.$store.dispatch('DataFilterZakaz', {data: this.DataFind.data})
                                        } else if (this.PhoneFind.phone) {
                                            this.$store.dispatch('PhoneFilterZakaz', {phone: this.PhoneFind.phone})
                                        } else {
                                            this.GetAllZakaz()
                                            this.$emit('get-method')
                                        }
                                    }


                                });
                            }

                        });
                    }

                });

        },

        clearFindZakaz() {
            this.selectDate = ''
            this.sendData = ''
            this.date = ''
            this.incominGoodDate = ''
            this.show_succes_send = false
            this.show_info = true
            this.success_Send = true
            this.show_first_send = false
            this.show_first_send_type_1 = false
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
