<template>
    <div>

        <!-- Модальное окно с редактированием рациона -->

        <b-modal id="editRacion" title="Отредактируйте поле  : Рацион" @ok=""  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ Racion.orderid }} ]</b>

            </template>

            <div class="card-body py-0">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Рацион</label>
                    <div class="col-sm-9">

                        <dynamic-select
                            :options="AllRacion"
                            v-model="SelectRacion"
                            option-text="name"
                            placeholder="Выберите рацион из списка"
                            @input = "sendSelectRacion" />

                    </div>

                </div>

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
            Racion: {},
            SelectRacion: {},
        }
    },

    computed: {
        ...mapGetters(['AllRacion']),

    },

    methods: {

        ...mapActions(['GetAllRacion', 'GetAllZakaz']),

        editZakazModal(item) {
            this. GetAllRacion()
            this. Racion = item
            this. SelectRacion = ''
            this. $bvModal.show('editRacion')
        },

        sendSelectRacion(){

            axios.post('api/v1/sendEditZakazRacion', {
                field_id: this.Racion.id,  field_value: this.SelectRacion.name

            }) .then((response) =>{

                if (response.data === "Заказ обновлен") {

                    Vue.$toast.open({
                        message: 'Рацион обновлен',
                        type: 'success',
                        duration: 3000,
                        position: 'top'
                    });

                }
            });

            this.GetAllZakaz()
            this.$bvModal.hide('editRacion')
        },

        ClearModal(){
            this.SelectRacion = ''
        },


    },
}
</script>

