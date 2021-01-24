<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">


                <b-form-input
                    v-model="value"
                    placeholder="Добавить новую должность"

                    v-on:keydown.enter ="addNewRole">

                </b-form-input>

            </div>

            <div class="row">
                <div class="col-md-7 mt">

                    <b-table
                        :items="roles"
                        :fields="fields"
                        :striped="striped"
                        :bordered="bordered"
                        :borderless="borderless"
                        :outlined="outlined"
                        :small="small"
                        :hover="hover"
                        :dark="dark"
                        :fixed="fixed"
                        :foot-clone="footClone"
                        :no-border-collapse="noCollapse">

                    </b-table>

                </div>

                <div class="col-md-2 mti">
                    <b-form-group label="Настройка таблицы" label-cols-lg="2" v-slot="{ ariaDescribedby }">
                        <b-form-checkbox v-model="striped" :aria-describedby="ariaDescribedby" inline>Striped</b-form-checkbox>
                        <b-form-checkbox v-model="bordered" :aria-describedby="ariaDescribedby" inline>Bordered</b-form-checkbox>
                        <b-form-checkbox v-model="borderless" :aria-describedby="ariaDescribedby" inline>Borderless</b-form-checkbox>
                        <b-form-checkbox v-model="outlined" :aria-describedby="ariaDescribedby" inline>Outlined</b-form-checkbox>
                        <b-form-checkbox v-model="small" :aria-describedby="ariaDescribedby" inline>Small</b-form-checkbox>
                        <b-form-checkbox v-model="hover" :aria-describedby="ariaDescribedby" inline>Hover</b-form-checkbox>
                        <b-form-checkbox v-model="dark" :aria-describedby="ariaDescribedby" inline>Dark</b-form-checkbox>
                        <b-form-checkbox v-model="fixed" :aria-describedby="ariaDescribedby" inline>Fixed</b-form-checkbox>
                        <b-form-checkbox v-model="footClone" :aria-describedby="ariaDescribedby" inline>Foot Clone</b-form-checkbox>
                        <b-form-checkbox v-model="noCollapse" :aria-describedby="ariaDescribedby" inline>No border</b-form-checkbox>
                    </b-form-group>
                </div>

                <div class="col-md-1 mti">
                    <b-form-group label-cols-lg="2" v-slot="{ ariaDescribedby }">
                        <b-form-radio-group
                            v-model="headVariant"
                            :aria-describedby="ariaDescribedby"
                            class="mt-lg-2"
                        >
                            <b-form-radio :value="null" inline>None</b-form-radio>
                            <b-form-radio value="light" inline>Light</b-form-radio>
                            <b-form-radio value="dark" inline>Dark</b-form-radio>
                        </b-form-radio-group>
                    </b-form-group>
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
            ],

            striped: false,
            bordered: false,
            borderless: false,
            outlined: false,
            small: false,
            hover: false,
            dark: false,
            fixed: false,
            footClone: false,
            headVariant: null,
            tableVariant: '',
            noCollapse: false,



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
.mti{
    margin-top: 5%;
    margin-left: 5%;
}
</style>
