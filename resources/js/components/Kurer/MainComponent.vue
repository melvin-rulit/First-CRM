<template>
    <div>

        <editkurer-component @get-method="UpdateData" ref="edit_kurer_component"></editkurer-component>

        <div class="card">

                <b-table

                    hover
                    :bordered="true"
                    :items="AllKurers"
                    :fields="fields"
                    :fixed="true"
                    :no-border-collapse="true"
                    :tbody-tr-class="rowClass"
                    @row-clicked="getShowModal"
                    @row-hovered = 'rowClass'
                    head-variant="dark">

                    <template #cell(surname)="data">
                        <b class="pointer">{{ data.item.surname}} </b> <span class="pointer">{{ data.item.name}}</span>
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
            details: 'true',
            isNew: true,

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

        UpdateData() {

            this.GetAllKurer()
        },

        rowClass(item) {
            return item ? "isNew" : "";
            // if (item === 'row') {
            //     return 'text-pointer'
            // }
        },
        removeIsNew(item) {
            item.isNew = false;
            this.saveItems(this.items);
        },

        saveItems(items) {
            this.$nextTick(() => {
                localStorage.setItem("items", JSON.stringify(items));
            });
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


