<template>
    <div>

        <editkurer-component ref="edit_kurer_component"></editkurer-component>

        <div class="card">

                <b-table

                    hover
                    :bordered="true"
                    :items="AllKurers"
                    :fields="fields"
                    :fixed="true"
                    :no-border-collapse="true"
                    @row-clicked="getShowModal"
                    head-variant="dark">

                    <template #cell(surname)="data">
                        <b class="pointer">{{ data.item.surname }} </b> <span class="pointer">{{ data.item.name}}</span>
                    </template>

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

            fields: [

                {
                    key: 'surname',
                    label: 'Фамилия Имя',
                    variant: 'warning'
                },
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
    },
}
</script>

<style scoped>

table {
    width:100%;
    table-layout: fixed;
}
.pointer {
    cursor: pointer;
}

</style>


