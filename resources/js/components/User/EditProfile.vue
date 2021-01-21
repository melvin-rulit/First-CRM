<template>
    <div>

        <!-- Модальное окно UserCard -->
        <b-modal id="UserCardEditProfile" ref="my-modal" title="Отредактируйте нужные поля"  v-on:hide="closeUserCardModal" centered ok-only ok-title="Готово">


            <div class="card-body py-2">

                <table class="pointer table table-bordered">
                    <tbody>
                    <tr>
                        <td>Имя</td>
                        <td><input-component
                            v-model="user.name"
                            name="name"
                            @edit-field="editField">

                        </input-component>
                        </td>
                    </tr>
                    <tr>
                        <td>Фамилия</td>
                        <td>
                            <input-component
                                v-model="user.surname"
                                name="surname"
                                @edit-field="editField">

                            </input-component>

                        </td>
                    </tr>
                    <tr>
                        <td>Отчество</td>
                        <td>
                            <input-component
                                v-model="user.lastname"
                                name="lastname"
                                @edit-field="editField">

                            </input-component>

                        </td>
                    </tr>
                    <tr>
                        <td>День рождения</td>
                        <td>
                            <input-component
                            v-model="user.birthday"
                            name="birthday"
                            datePicker="true"
                            @edit-field="editField">

                        </input-component>

                        </td>
                    </tr>
                    <tr>
                        <td>Должность</td>
                        <td>
                            <input-component
                                v-model="user.business"
                                name="business"
                                @edit-field="editField">

                            </input-component>

                        </td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>
                            <input-component
                                v-model="user.phone"
                                mask="+## (###) ###-##-##"
                                name="phone"
                                @edit-field="editField">

                            </input-component>

                        </td>
                    </tr>
                    <tr>
                        <td>Single select</td>
                        <td>
                          <multiselect
                              v-model="value"
                              :options="options"
                              :searchable="false"
                              :close-on-select="false"
                              :show-labels="false"
                             >

                          </multiselect>

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </b-modal>
    </div>

</template>

<script>

export default {

    data() {
        return {

            user: {},
            value: '',
            options: ['Дизайнер', 'Менеджер', 'Веб разработчик', 'Сео оптимизатор', 'It специалист', 'Бухгалтер', 'Оператор']
        }

    },

    mounted() {
        this.getUserCardData()
    },

    methods: {

        getUserCardData() {
            axios.get('api/v1/getUserName')
                .then(response => this.user = response.data)
        },

        editField(e, name, type) {

            if (type) {
                axios.post('api/v1/userCardSave', {user_id: this.user.id, field_name: name, field_value: e})
            }
            else{
                const value = e.target.value;
                const key = e.currentTarget.getAttribute('name');
                axios.post('api/v1/userCardSave', {user_id: this.user.id, field_name: key, field_value: value })
            }
        },

        closeUserCardModal(){
            this.$emit('get-method')
        }


    },
}
</script>

<style>

.pointer:hover {
    cursor: pointer;
}

</style>
