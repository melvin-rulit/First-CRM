<template>
    <div>
<!--        <addnewuser-component @get-method="fetch" ref="add_user_component"></addnewuser-component>-->
        <editkurer-component @get-method="UpdateData" ref="edit_kurer_component"></editkurer-component>
        <!--        <showuser-component :can="can" @get-method="fetch" ref="getmodal"></showuser-component>-->
        <!--        <userfilter-component  @get-method="returnFilterArray" ref="show_filter"></userfilter-component>-->


        <div class="card">

                <b-table

                    hover
                    :bordered="false"
                    :items="AllKurers"
                    :fields="fields"
                    :fixed="true"
                    :no-border-collapse="true"
                    @row-clicked="getShowModal"
                    head-variant="dark">

<!--                    <template #cell(name)="data">-->
<!--                        <b class="ml-3">{{ data.item.name}}</b>-->
<!--                    </template>-->

                    <template #cell(surname)="data">
                        <b>{{ data.item.surname}} </b> {{ data.item.name}}
                    </template>

<!--                    <template #cell(phone)="data">-->
<!--                        <b class="text-success ml-3">{{ data.item.phone.toUpperCase() }}</b>-->
<!--                    </template>-->

<!--                    <template #cell(car)="data">-->
<!--                        <b class="text-warning ml-3">{{ data.item.car}}</b>-->
<!--                    </template>-->

<!--                    <template v-slot:cell(email)="row">-->
<!--                        <b-form-group>-->
<!--                            <b-checkbox>-->
<!--                                <b class="email ml-3">{{ row.item.email }}</b>-->

<!--                            </b-checkbox>-->
<!--&lt;!&ndash;                            <b-form-checkbox v-model="row.visible" @change="details"> <b class="email ml-3" v-if="visibleFields">{{ row.item.email }}</b>&ndash;&gt;-->
<!--&lt;!&ndash;                            </b-form-checkbox>  &ndash;&gt;-->



<!--                        </b-form-group>-->
<!--                    </template>-->

<!--                    <template #cell(secret_id)="data">-->
<!--                        <b class="password ml-3">{{ data.item.secret_id}}</b>-->
<!--                    </template>-->

<!--                    <template #cell(coment)="data">-->
<!--                        <b class="text-muted ml-4">{{ data.item.coment}}</b>-->
<!--                    </template>-->


<!--                    <template #head(name)="data">-->
<!--                        <span class="text-center">{{ data.label }}</span>-->
<!--                    </template>-->


<!--                    <template v-slot:cell(role)="row">-->
<!--                        <span v-for="item in row.item.roles" class="badge badge-info mr-2">-->
<!--                            {{item.title}}-->
<!--                        </span>-->
<!--                    </template>-->
                </b-table>

        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
    data() {
        return {
            users: {},
            rowSelect: {},
            details: 'true',

            fields: [

                {
                    key: 'surname',
                    label: 'Фамилия имя',
                    variant: 'warning'
                },
                // {
                //     key: 'name',
                //     label: 'Имя',
                // },
                {
                    key: 'phone',
                    label: 'Номер тел',
                },
                {
                    key: 'car',
                    label: 'Авто',
                },
                {
                    key: 'email',
                    label: 'Логин',
                    visible: false
                },
                {
                    key: 'secret_id',
                    label: 'Пароль',
                },
                {
                    key: 'coment',
                    label: 'Примечание',
                },
            ],
        }
    },

    mounted() {

        this.GetAllKurer()

    },

    computed: {
        ...mapGetters(['AllKurers']),

    },

    methods: {

        ...mapActions(['GetAllKurer']),

        getShowModal(index){

            this.$refs.edit_kurer_component.editKurerModal(index)
        },

        UpdateData() {

            this.GetAllKurer()
        },

    },
}
</script>

<style scoped>
table {
    width:100%;
    table-layout: fixed;
}

</style>

