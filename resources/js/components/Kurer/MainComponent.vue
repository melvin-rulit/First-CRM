<template>
    <div>

        <editkurer-component @get-method="UpdateData" ref="edit_kurer_component"></editkurer-component>

        <div class="card">

                <b-table

                    hover
                    :bordered="false"
                    :items="AllKurers"
                    :fields="fields"
                    :fixed="true"
                    :no-border-collapse="true"
                    :tbody-tr-class="rowClass"
                    @row-clicked="getShowModal"
                    @row-hovered = 'rowClass'
                    head-variant="dark">

<!--                    <template #cell(name)="data">-->
<!--                        <b class="ml-3">{{ data.item.name}}</b>-->
<!--                    </template>-->

                    <template #cell(surname)="data">
                        <b class="pointer">{{ data.item.surname}} </b> <span class="pointer">{{ data.item.name}}</span>
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
            isNew: true,

            fields: [

                {
                    key: 'surname',
                    label: 'Фамилия Имя',
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

.table-dark.table-hover tbody tr:hover {
    cursor: pointer;
}
</style>

<!--<template>-->
<!--    <div id="app">-->
<!--        <b-button-group>-->
<!--            <b-button @click="addFewRows">Add more rows</b-button>-->
<!--            <b-button @click="reset">Clear data</b-button>-->
<!--        </b-button-group>-->
<!--        <b-table hover dark :items="items" @row-unhovered="removeIsNew" :tbody-tr-class="rowClass"></b-table>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--import _ from "lodash";-->
<!--export default {-->
<!--    name: "App",-->
<!--    data: () => ({-->
<!--        items: []-->
<!--    }),-->
<!--    mounted() {-->
<!--        if (localStorage.getItem("items")) {-->
<!--            this.items = JSON.parse(localStorage.getItem("items"));-->
<!--        } else {-->
<!--            this.reset();-->
<!--        }-->
<!--    },-->
<!--    methods: {-->
<!--        rowClass(item) {-->
<!--            return item.isNew ? "isNew" : "";-->
<!--        },-->
<!--        removeIsNew(item) {-->
<!--            item.isNew = false;-->
<!--            this.saveItems(this.items);-->
<!--        },-->
<!--        addItem(item) {-->
<!--            this.items.push(item);-->
<!--            this.saveItems(this.items);-->
<!--        },-->
<!--        saveItems(items) {-->
<!--            this.$nextTick(() => {-->
<!--                localStorage.setItem("items", JSON.stringify(items));-->
<!--            });-->
<!--        },-->
<!--        addFewRows() {-->
<!--            _.times(this.rng(2, 6), () => this.addItem(this.generateItem()));-->
<!--        },-->
<!--        generateItem() {-->
<!--            return {-->
<!--                age: this.rng(21, 45),-->
<!--                first_name: ["John", "Paul", "Randy", "Joe", "Jack", "Bernard"][-->
<!--                    this.rng(0, 5)-->
<!--                    ],-->
<!--                last_name: [-->
<!--                    "Cusack",-->
<!--                    "Robertson",-->
<!--                    "Smith",-->
<!--                    "Stevens",-->
<!--                    "Ballard",-->
<!--                    "MacDonald",-->
<!--                    "Wilson",-->
<!--                    "Shaw"-->
<!--                ][this.rng(0, 7)],-->
<!--                isNew: true-->
<!--            };-->
<!--        },-->
<!--        rng(min, max) {-->
<!--            return Math.round(Math.random() * (max - min + 0.5)) + min;-->
<!--        },-->
<!--        reset() {-->
<!--            this.items = _.times(4, () => this.generateItem());-->
<!--            this.saveItems(this.items);-->
<!--        }-->
<!--    }-->
<!--};-->
<!--</script>-->

<!--<style>-->
<!--.table-dark.table-hover tbody tr.isNew {-->
<!--    color: #BADA55;-->
<!--    background-color: rgba(255, 255, 255, 0.123);-->
<!--}-->
<!--.table-dark.table-hover tbody tr:hover {-->
<!--    cursor:pointer;-->
<!--}-->
<!--body,-->
<!--html {-->
<!--    height: 100%;-->
<!--}-->
<!--body {-->
<!--    background-color: #191919;-->
<!--}-->
<!--</style>-->


