<template>
    <div>

        <!-- Модальное окно UserCard -->
        <b-modal id="UserCardEditPersonal" title="Опишите себя и ваши качества"  v-on:hide="closeUserCardModal" centered ok-only ok-title="Готово">


            <label>
                <textarea
                class="form-comment"
                v-model="user.comment"
                @blur="event => editField(event, 'comment')"
                rows="3"
                name="comment">
                </textarea>
            </label>

        </b-modal>
    </div>
</template>

<script>


export default {


    data() {
        return {

            user: {},
            comment: '',

        }

    },

    mounted() {
        this.getUserName()
    },

    methods: {

        getUserName() {
            axios.get('api/v1/user')
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

.form-comment{
   width: 460px;
}
/* .red{

    text-shadow: 1px 1px 2px black;
}
.button-style{
    text-decoration-color: green;
} */
</style>
