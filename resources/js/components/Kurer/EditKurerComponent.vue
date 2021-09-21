<template>
    <div>

        <!-- Модальное окно с редактированием курьера -->
        <b-modal id="editKurer" title="Редактирование выбранного Курьера" @ok="editField" @hidden="closeModal" centered
                 ok-only ok-title="Готово">


            <div class="card-body py-0">

                <div class="form-group row">
                    <label class="col-sm-3">Имя</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.name"
                            name="name"
                            @edit-field="editField">

                        </input-component>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">Фамилия</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.surname"
                            name="surname"
                            @edit-field="editField">

                        </input-component>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">Номер телефона</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.phone"
                            name="phone"
                            @edit-field="editField">

                        </input-component>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">Автомобиль</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.car"
                            name="car"
                            @edit-field="editField">

                        </input-component>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">Логин</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.email"
                            name="email"
                            @edit-field="editField">

                        </input-component>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">Пароль</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.secret_id"
                            name="secret_id"
                            @edit-field="editField">

                        </input-component>
                    </div>
                </div>

                                <div class="form-group row">
                                            <textarea

                                                placeholder="Примечание"
                                                class="form-control"
                                                v-model="incominData.coment"
                                                @blur="event => editField(event, 'coment')"
                                                rows="3"
                                                name="coment">

                                            </textarea>
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

export default {

    data() {
        return {
            incominData: {},
            options_type: [

                {value: 'null', text: 'Выберите тип операции'},
                {value: '1', text: 'Приход'},
                {value: '0', text: 'Расход'},
            ],

        }
    },

    methods: {

        editKurerModal(item) {
            this.incominData = item
            this.$bvModal.show('editKurer')

        },

        //--------------------------------------------- Изменяем  Курьера --------------------------------------------------------//

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
                axios.post('api/v1/sendEditKurerData', {
                    field_id: this.incominData.id,
                    field_name: key,
                    field_value: value
                })
            }

            this.$emit('get-method')

        },

        //---------------------------------------------- Удаляем Курьера -------------------------------------------------------------//

        deleteField() {

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить Курьера ( ' + this.incominData.surname + ' ' + this.incominData.name  + ' ) ?', {
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

                        axios.delete('api/v1/users/' + this.incominData.id)

                        this.$bvModal.hide('editKurer')

                        this.$emit('get-method')

                        setTimeout(() => {

                            Vue.$toast.open({
                                message: "Курьер удален",
                                type: 'error',
                                duration: 2000,
                                position: 'bottom-right'
                            });

                        }, 500)
                    }
                })

        },


        closeModal() {
            this.name = ''
            this.surname = ''
            this.phone = ''
            this.login = ''
            this.password = ''
        },
    },
}
</script>

<style>
.form-control:focus {
    color: #12263f;
    outline: 0;
}
</style>
