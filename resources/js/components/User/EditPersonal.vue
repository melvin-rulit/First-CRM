<template>
    <div>

        <!-- Модальное окно UserCard -->
        <b-modal id="UserCardEditPersonal" title="Опишите ваши качества"  v-on:hide="closeUserCardModal" centered ok-only ok-title="Применить">


            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group label-for="name-input">
                    <b-form-textarea id="textarea" v-model="comment"></b-form-textarea>
                </b-form-group>
            </form>



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
            comment: '',

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
