<template>
    <div>

        <!-- Модальное окно UserCard -->
        <b-modal id="addNewUser" ref="my-modal" title="Отредактируйте нужные поля"  v-on:hide="closeUserCardModal" centered>


            <div class="card-body py-use Illuminate\Database\Eloquent\Model;2">

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
                                v-model="user.deleted_at"
                                name="deleted_at"
                                @edit-field="editField">

                            </input-component>

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

            fields: [
                {
                    key: 'id',
                    label: 'ID',
                },
                {
                    key: 'message',
                    label: 'Действие',
                },
                {
                    key: 'created_at',
                    label: 'Дата',
                },
            ],

            user: {},

        }

    },

    mounted() {
        this.getUserName()
    },

    methods: {
        updateUserModal() {
            this.$bvModal.show('addNewUser')

        },

        getUserName() {
            axios.get('api/v1/getUserName')
                .then(response => this.user = response.data)
        },

        editField(e, name, type) {

            if (type) {
                axios.post('api/v1/userCardSave', { field_name: name, field_value: e})
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
