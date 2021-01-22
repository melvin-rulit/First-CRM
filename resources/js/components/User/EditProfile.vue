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
                        <td>Должность</td>
                        <td>
                                 <span v-if="!showEditRole" v-for="item in user.role" class="badge badge-info mr-2">
                                        {{item.title}}
                                    </span>
                          <multiselect
                              v-if="showEditRole"
                              v-model="user.role"
                              label="title"
                              track-by="id"
                              :options="roles"
                              :multiple="true"
                              :taggable="true"
                              deselectLabel="Удалить"
                              selectedLabel="Выбран"
                             >

                          </multiselect>
                            <hr class="navbar-divider my-3">
                            <div class="mt-3">
                                <button
                                    @click="editRole"
                                    :disabled="showEditRole"
                                    class="btn btn-sm btn-primary">Редактировать</button>
                                <button
                                    @click="saveRole"
                                    :disabled="!showEditRole"
                                    class="btn btn-sm btn-success">Сохранить</button>
                            </div>
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
            roles: [],
            value: '',
            showEditRole: false,

        }

    },

    computed: {

        newRoleArray(){
            return this.user.role.slice().map(item => item.id.toString());
        }
    },

    mounted() {

        this.getUserCardData()
    },

    methods: {

        getRoles(){

            axios.get('api/v1/getRoles')

                .then(response => {this.roles = response.data.data;})
        },

        getUserCardData() {
            axios.get('api/v1/user')
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

        editRole(){
           this.showEditRole = !this.showEditRole
          this.getRoles()
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
