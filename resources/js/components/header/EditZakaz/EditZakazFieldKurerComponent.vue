<template>
    <div>

        <!-- Модальное окно с редактированием курьера -->

        <b-modal id="editKurer" title="Отредактируйте поле  : Курьер" @ok="" @hidden="ClearModal" centered
                 ok-only ok-title="Отмена">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ Zakaz.orderid }} ]</b>

            </template>

            <div class="card-body py-0">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Курьер</label>
                    <div class="col-sm-9">

                        <dynamic-select
                            :options="AllKurers"
                            v-model="SelectKurer"
                            option-text="full_name"
                            placeholder="Выберите курьера из списка"
                            @input = "sendSelectKurer" />

                    </div>

                </div>

            </div>

        </b-modal>


        <b-modal id="editTel_error" title="Внимание!!!" @hidden="" centered
                 ok-only ok-title="Понятно">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ Zakaz.orderid }} ]</b>

            </template>

            <b-alert show variant="danger">Прежде чем установить "Курьера" - присвойте этому заказу " № Квадрата"</b-alert>
            <b-alert show variant="primary">Будет автоматически присвоен "Курьер" с соответствием квадрату и после этого можете поменять "Курьера"</b-alert>
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
            adress: '',
            name_client: '',
            tel_client: '',
            SelectKurer: {},
            tupeZakaz: null,

        }
    },

    computed: {
        ...mapGetters(['AllKurers']),

    },

    methods: {

        ...mapActions(['GetAllKurer', 'GetAllZakaz']),

        editZakazModal(item) {
            this.GetAllKurer()
            this.Zakaz = item
            this.SelectKurer = ''

            // if (this.Zakaz.kvadrat_id == "😎"){
            if (this.Zakaz.kvadrat_id == "+") {
                this.$bvModal.show('editTel_error')
            } else {
                this.$bvModal.show('editKurer')
            }
        },

        sendSelectKurer(){

            axios.post('api/v1/sendEditZakazData', {
                field_id: this.Zakaz.id,  field_name: 'kurer_id', field_value: this.SelectKurer.id

            }) .then((response) =>{

                if (response.data === "Заказ обновлен") {

                    Vue.$toast.open({
                        message: 'Курьер добавлен',
                        type: 'success',
                        duration: 3000,
                        position: 'top'
                    });

                }
            });

            this.GetAllZakaz()
            this.$bvModal.hide('editKurer')
        },

        ClearModal(){
            this.tupeZakaz = null
        },


    },
}
</script>

