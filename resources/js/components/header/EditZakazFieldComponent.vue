<template>
    <div>

        <!-- Модальное окно с добавлением новой роли -->
        <b-modal id="editZakaz" title="Редактирование выбранного Заказа" @ok="sendData"  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

            <b-row class="mb-1">

<!--                <b-col cols="3">Тип Доставки</b-col>-->
                <b-col>
                    <b-form-select
                        v-model="tupeZakaz"
                        :options="options_type"
                    ></b-form-select>
                </b-col>

            </b-row>

            <div class="card-body py-0">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Курьер</label>
                    <div class="col-sm-9">
                        <dynamic-select
                            :options="Kurer"
                            v-model="Kurer"/>
                    </div>

                </div>

            </div>

            <template #modal-footer="{ ok, cancel, hide }">

                <b-button style="margin-right: 250px" size="sm" variant="outline-secondary"
                          @click="deleteField">
                    <b-icon icon="trash"></b-icon>
                    Удалить
                </b-button>

                <b-button size="sm" variant="success" @click="ok()">
                    Готово
                </b-button>

            </template>

        </b-modal>
    </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {

        return {
            Zakaz: [],
            tupeZakaz: 'null',

            options_type: [
                {value: 'null', text: 'Тип доставки'},
                {value: 'Курьером', text: 'Курьер'},
                {value: 'Самовызов', text: 'Самовызов'},
            ],
        }
    },

    computed: {
        ...mapGetters(['AllKurers']),

    },

    methods: {

        ...mapActions(['GetAllKurer', 'GetAllZakaz']),

        editZakazModal(item) {
            this.Zakaz = item
            this.$bvModal.show('editZakaz')

        },

        sendData() {
            if (this.tupeZakaz !== null ){

                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.Zakaz.id,  field_name: 'deliv', field_value: this.tupeZakaz

                })

            this.GetAllZakaz()

                setTimeout(() => {
                    Vue.$toast.open({
                        message: "Поле Доставка обновленно",
                        type: 'success',
                        duration: 2000,
                        position: 'bottom-right'
                    });

                }, 500)
            }


        },



        //---------------------------------------------- Удаляем Курьера -------------------------------------------------------------//

        deleteField() {

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить Заказ ( ' + this.Zakaz.orderid  + ' ) ?', {
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

                        axios.delete('api/v1/zakaz/' + this.Zakaz.id)

                        this.$bvModal.hide('editZakaz')

                        this.$emit('get-method')

                    }
                })

        },

        ClearModal(){
            this.tupeZakaz = null
        }

    },
}
</script>

