<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10">


                <b-form-input
                    v-model="value"
                    placeholder="Добавить новую должность"

                    v-on:keydown.enter ="addNewRole">

                </b-form-input>

            </div>
            <div class="col-md-10 mt ">
               <div class="">
                   <b-table
                       :items="roles"
                       :fields="fields"

                   ></b-table>
               </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    data() {
        return {

            roles: {},
            value: '',
            user: {},
            fields:[
                {
                    key: 'id',
                    label: 'Индекс',
                },

                {
                    key: 'title',
                    label: 'Должность',
                },

                {
                    key: 'korn',
                    label: 'Доступ',
                }
            ]


        }

    },

    mounted() {
        this.getRoles()
        this.getUserData()
    },

    methods:{

        getRoles(){

            axios.get('api/v1/getRoles')

                .then(response => {this.roles = response.data.data;})

        },

        getUserData() {
            axios.get('api/v1/user')
                .then(response => this.user = response.data)
        },


        addNewRole(){

            axios.post('api/v1/roles', {title: this.value})

            this.value = ''
            this.getRoles()
        }
    }


}

</script>

<style>

.mt{
    margin-top: 20px;
    /*width: 600px;*/
}
</style>
