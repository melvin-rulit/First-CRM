<template>
    <div>

        <!-- Модальное окно с добавлением новой роли -->
        <b-modal id="editTotal" title="Отредактируйте поле  : Сумма"  @hidden="ClearModal" centered
                 ok-only ok-title="Готово">

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

        editField(e, name, type) {

            if (type) {
                axios.post('api/v1/sendEditKurerData', {
                    field_id: this.incominData.id,
                    field_name: name,
                    field_value: e
                })
            } else {
                const value = e.target.value;
                const key = e.currentTarget.getAttribute('name');
                axios.post('api/v1/sendEditZakazData', {
                    field_id: this.Total.id,
                    field_name: key,
                    field_value: value
                })
            }

            setTimeout(() => {
                Vue.$toast.open({
                    message: "Сумма обновлена",
                    type: 'success',
                    duration: 2000,
                    position: 'bottom-right'
                });

            }, 500)
        },

        ClearModal(){
            this.tupeZakaz = null
        },


    },
}
</script>

