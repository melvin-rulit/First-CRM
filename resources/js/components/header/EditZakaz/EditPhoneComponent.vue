<template>
    <div>


        <b-modal id="editTel" title="" @ok="" @hidden="ClearModal" centered
                 ok-only ok-title="Отмена">

            <template #modal-title>

                <h7 class="">№ заказа</h7>
                <b>[ {{ incomingTel.orderid }} ]</b>

            </template>

            <div class="card-body py-0">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Телефон</label>
                    <div class="col-sm-9">

                        <input-component
                            v-model="Tel"
                            name="tel"
                            mask="+38 (###)-###-##-##"
                            @edit-field="editField">

                        </input-component>

                    </div>
                </div>
            </div>

            <template #modal-footer>
                <div class="w-100">

                    <b-button v-if="errorPhoneEnter" show variant="danger" class="float-left">Вы ввели не полный номер
                        телефона
                    </b-button>

                    <b-button
                        variant="primary"
                        size="md"
                        class="float-right"
                        @click="ClearModal">
                        Отмена
                    </b-button>
                </div>
            </template>

        </b-modal>

    </div>

</template>

<script>

import {mapActions} from "vuex";

export default {

    data() {

        return {
            incomingTel: {},
            Tel: '',
            send_tel: '',
            errorPhoneEnter: false,
        }
    },

    computed: {

        length: function () {
            return this.send_tel.length;
        },
    },

    methods: {
        ...mapActions(['GetAllZakaz']),

        showEditPhoneModal(item) {
            this.incomingTel = item
            this.Tel = item.tel
            this.$bvModal.show('editTel')
        },

        editField(e) {

            const value = e.target.value;
            const key = e.currentTarget.getAttribute('name');
            this.send_tel = value

            if (this.length < 19) {

                this.errorPhoneEnter = true

            } else {

                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.incomingTel.id,
                    field_name: key,
                    field_value: value
                }).then((response) => {

                    if (response.data === "Заказ обновлен") {

                        this.errorPhoneEnter = false

                        Vue.$toast.open({
                            message: 'Телефон обновлен',
                            type: 'success',
                            duration: 3000,
                            position: 'top'
                        });

                        this.GetAllZakaz()
                        this.$emit('get-method')
                        this.ClearModal()
                    }
                });

            }
        },

        ClearModal() {
            this.$bvModal.hide('editTel')
            this.send_tel = ''
            this.errorPhoneEnter = false
        },


    },
}
</script>

