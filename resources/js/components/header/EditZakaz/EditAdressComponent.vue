<template>
    <div>

        <!-- Модальное окно с редактированием адресса -->

        <b-modal id="editAdress" title="Отредактируйте поле  : Рацион" @ok=""  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ Adress.orderid }} ]</b>

            </template>

            <div class="card-body py-0">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Адресс</label>
                    <div class="col-sm-9">

                        <dynamic-select
                            :options="AllAdress"
                            v-model="SelectAdress"
                            placeholder="Выберите адресс из списка"
                            option-text="title"
                            @input="sendSelectAdress"/>

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
            Adress: {},
            SelectAdress: {},
        }
    },

    computed: {
        ...mapGetters(['AllAdress']),

    },

    methods: {

        ...mapActions(['GetAllAdress', 'GetAllZakaz']),

        showEditAdressModal(item) {
            this. GetAllAdress()
            this. Adress = item
            this. $bvModal.show('editAdress')
        },

        sendSelectAdress() {

            axios.post('api/v1/sendEditZakazAdress', {
                field_id: this.Adress.id,
                field_value_title: this.SelectAdress.title,
                field_value_kvadrat_id: this.SelectAdress.kvadrat_id

            }).then((response) => {

                if (response.data === "Заказ обновлен") {

                    Vue.$toast.open({
                        message: 'Адресс обновлен',
                        type: 'success',
                        duration: 3000,
                        position: 'top'
                    });

                }
            });

            this.GetAllZakaz()
            this.$emit('get-method')
            this.$bvModal.hide('editAdress')
        },

        ClearModal(){
            this.SelectAdress = ''
        },


    },
}
</script>


