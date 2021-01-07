<template>
    <div>

        <!-- Модальное окно -->
        <b-modal id="addNewUser" ref="my-modal" title="Отредактируйте нужные поля"  centered  hide-footer >


            <div class="card-body py-2">

                <table class="pointer table table-bordered">
                    <tbody>
                    <tr>
                        <td>Имя</td>
                        <td><input-component
                            v-model="user.name"
                            name="name"

                           >
                        </input-component>
                        </td>
                    </tr>
                    <tr>
                        <td>Фамилия</td>
                        <td>
                            <input-component
                                v-model="user.deleted_at"
                                name="deleted_at">

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
            update_surname: '',
            update_name: '',
            update_lastname: '',
            user:{},

        }

    },

    mounted() {
        this.getUserName()
    },

    methods: {
        updateUserModal(){
            this.$bvModal.show('addNewUser')

        },

        getUserName() {
            axios.get('api/v1/getUserName')
                .then(response => this.user = response.data)
        },
    }


}
</script>

<style>

.pointer:hover {
    cursor: pointer;
}

</style>
