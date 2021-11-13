<template>
    <div>

        <!-- Модальное окно с редактированием курьера -->
        <b-modal id="editKurer" title="Редактирование выбранного Курьера" @ok="editField" @hidden="closeModal" centered
                 ok-only ok-title="Готово">


            <div class="card-body py-0">

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
                    <label class="col-sm-3">Номер телефона</label>
                    <div class="col-sm-8">
                        <input-component
                            v-model="incominData.phone"
                            name="phone"
                            mask="+38 (###)-###-##-##"
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
import {TheMask} from 'vue-the-mask'
import {mapActions} from "vuex";

export default {

    components: { TheMask },

    data() {
        return {
            incominData: {},
        }
    },

    methods: {
        ...mapActions(['GetAllKurer']),

        editKurerModal(item) {
            this.incominData = item
            this.$bvModal.show('editKurer')

        },

        //--------------------------------------------- Изменяем  Курьера --------------------------------------------------------//

        editField(e) {

                const value = e.target.value;
                const key = e.currentTarget.getAttribute('name');

                axios.post('api/v1/sendEditKurerData', {
                    field_id: this.incominData.id,
                    field_name: key,
                    field_value: value,
                    full_name: this.incominData.name ,
                    full_surname: this.incominData.surname,
                }) .then((response) =>{

                    if (response.data === "Данные обновлены") {

                        Vue.$toast.open({
                            message: 'Данные обновлены',
                            type: 'success',
                            duration: 3000,
                            position: 'top'
                        });

                    }

                    this.GetAllKurer()

                });
        },

        //---------------------------------------------- Удаляем Курьера -------------------------------------------------------------//

        deleteField() {

            const modalTimeoutSeconds = 7;
            const modalId = 'confirm-modal'
            let modalSetTimeout = null;

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить Курьера ( ' + this.incominData.surname + ' ' + this.incominData.name  + ' ) ?', {
                id: modalId,
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

                        axios.delete('api/v1/kurer/' + this.incominData.id)  .then((response) =>{

                            if (response.data === "Курьер удален") {

                                Vue.$toast.open({
                                    message: 'Курьер удален',
                                    type: 'success',
                                    duration: 3000,
                                    position: 'top'
                                });

                                this.$bvModal.hide('editKurer')
                                this.GetAllKurer()
                            }
                        });

                    }
                })

            modalSetTimeout = setTimeout(() => {
                this.$bvModal.hide(modalId)
            }, modalTimeoutSeconds * 1000)
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
