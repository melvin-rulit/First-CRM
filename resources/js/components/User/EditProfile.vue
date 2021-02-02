<template>
    <div>

        <!-- Модальное окно UserCard -->
        <b-modal id="UserCardEditProfile"  title="Отредактируйте нужные поля"  v-on:hide="closeUserCardModal" centered ok-only ok-title="Готово">


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
                        <td>Адресс проживания</td>
                        <td>
                            <input-component
                            v-model="user.adress"
                            name="adress"
                            @edit-field="editField">

                        </input-component>

                        </td>
                    </tr>

                    <tr>
                        <td>Телефон</td>
                        <td>
                            <input-component
                                v-model="user.phone"
                                mask="+# (###) ###-##-##"
                                name="phone"
                                @edit-field="editField">

                            </input-component>

                        </td>
                    </tr>

                    <tr>
                        <td>Доступ</td>
                        <td>
                            <div>

                                <multiselect

                                    v-model="accessvalue"
                                    track-by="access"
                                    label="access"
                                    placeholder="Раскрыть список"
                                    :options="access"
                                    :searchable="false"
                                    :option-height="104"
                                    :show-labels="false"
                                    @close="addAccess">

                                </multiselect>

                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td>Должность</td>
                        <td>
                                 <button type="button" v-if="!showEditRole" v-for="item in user.role" class="btn btn-outline-success mr-2 mt-2">
                                        {{item.title}}
                                  </button>

                          <multiselect

                              v-if="showEditRole"
                              v-model="user.role"
                              label="title"
                              track-by="id"
                              :options="roles"
                              :multiple="true"
                              :taggable="false"
                              placeholder="Выберите должность"
                              :option-height="104"
                              deselectLabel="Удалить"
                              selectedLabel="Выбран"
                              select-label="Выберите">

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
            roles: {},
            value: '',
            access: [],
            accessvalue: '',
            showEditRole: false,


        }

    },

    computed: {
        newRoleArray(){
            return this.user.role.slice().map(item => item.id.toString());
        }
    },

    mounted() {
       this.getAccess()
    },


    methods: {

        getRoles(){
            axios.get('api/v1/getRoles')

                .then(response => {this.roles = response.data.data})
        },

        getAccess(){
            axios.get('api/v1/getAccess')
                .then(response => {this.access = response.data.data})

        },


        getUserCardData() {
            axios.get('api/v1/getDataForUserCardProfile')
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

        addAccess(){

            axios.get('api/v1/')
        },

        editRole(){
                   this.showEditRole = !this.showEditRole
                  this.getRoles()
                },

        saveRole(){
            axios.post('api/v1/saveRolesForUser', {user_id: this.user.id, roles: this.newRoleArray})

        },


        closeUserCardModal(){
            this.$emit('get-method')
        },

            addNewUserModal(id){
                axios.get('api/v1/user/' + id)
                .then(response => {this.user = response.data.data})
                this.$bvModal.show('UserCardEditProfile')
            },

    },
}
</script>

<style>

.pointer:hover {
    cursor: pointer;
}

</style>
