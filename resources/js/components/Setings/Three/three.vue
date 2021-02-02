<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">

                <!-- Modal -->
                <edit-access-in-settings @get-method="clearTableWhenExitModal" ref="getmodalupdate"></edit-access-in-settings>
                <delete-access-in-settings @get-method="clearTableWhenExitModal" ref="getmodaldelete"></delete-access-in-settings>

                <b-form-input

                    v-model="value"
                    placeholder="Новый доступ"
                    v-on:keydown.enter ="addNewAccess">

                </b-form-input>

            </div>

            <div class="row">
                <div class="col-md-8 mt">

                    <b-table
                        :items="access"
                        :fields="fields"

                        :no-border-collapse="noCollapse"
                        :striped="striped"
                        :bordered="bordered"
                        :borderless="borderless"
                        :outlined="outlined"
                        :small="small"
                        :hover="hover"
                        :dark="dark"
                        :fixed="true"
                    >

                        <template v-slot:cell(selected)="row">
                            <b-form-group>

                                <button class="pading_button"> <b-icon icon="pencil-square" @click="rowSelectedForUpdate(row.item)" ></b-icon> </button>
                                <button> <b-icon  icon="trash" @click="rowSelectedForDelete(row.item)"></b-icon>  </button>

                            </b-form-group>
                        </template>


                        <!-- Выводим упорядоченный Index для полей -->
                        <template v-slot:cell(index)="data">
                            {{ data.index + 1 }}
                        </template>




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
                        <b-form-checkbox v-model="noCollapse" :aria-describedby="ariaDescribedby" inline>Border</b-form-checkbox>
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

            access: {},
            value: '',

            fields:[

                // 'index',

                // {
                //     key: 'id',
                //     label: 'Индекс',
                // },

                {
                    key: 'access',
                    label: 'Доступ',
                },

                {
                    key: 'selected',
                    label: 'Редактировать',
                }
            ],

            striped: false,
            bordered: false,
            borderless: false,
            outlined: false,
            small: false,
            hover: false,
            dark: false,
            headVariant: null,
            tableVariant: '',
            noCollapse: false,



        }

    },

    mounted() {

        this.getAccess()

    },

    methods:{

        getAccess(){
            axios.get('api/v1/getAccess')
                .then(response => {this.access = response.data.data;})

        },


        addNewAccess(){

            axios.post('api/v1/access', {access: this.value})
            this.value = ''
            this.getAccess()
            Vue.$toast.open({ message: 'Доступ добвален',type: 'success',duration: '4000', pauseOnHover: "true" });

        },

        rowSelectedForUpdate(row) {
            this.$refs.getmodalupdate.ShowModalEditAccess(row)

        },
        rowSelectedForDelete(row) {
            this.$refs.getmodaldelete.ShowModalDeleteAccess(row)

        },

        clearTableWhenExitModal(){
            this.getAccess()

        },


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
.pading_button{
    padding-left:35%;
}
</style>
