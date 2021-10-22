<template>
    <div>

        <!-- Модальное окно с добавлением суммы -->
        <b-modal id="editTotal" title="Отредактируйте поле  : Сумма"  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

            <template #modal-title>

                    <h7 class="">№ заказа</h7>
                    <b>[ {{ Total.orderid }} ]</b>

            </template>

            <div class="card-body py-0">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Сумма</label>
                    <div class="col-sm-9">

                        <input-component
                            v-model="Total.total"
                            name="total"
                            @edit-field="editField">

                        </input-component>

                    </div>

                </div>

            </div>

        </b-modal>
    </div>

</template>

<script>

export default {
    data() {

        return {
            Total: {},
          send_sum: ''
        }
    },

    methods: {

        editZakazModal(item) {
            this. Total = item
            this. SelectKurer = ''
            this. $bvModal.show('editTotal')

        },

        editField(e) {

                const value = e.target.value;
                const key = e.currentTarget.getAttribute('name');

                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.Total.id,
                    field_name: key,
                    field_value: value
                }) .then((response) =>{

                    if (response.data === "Заказ обновлен") {

                        Vue.$toast.open({
                            message: 'Сумма обновлена',
                            type: 'success',
                            duration: 3000,
                            position: 'top'
                        });

                        this.$bvModal.hide('editTotal')
                    }
                });

        },

        ClearModal(){
            this.tupeZakaz = null
        },


    },
}
</script>

