<template>

    <div>

        <b-table

            hover
            :bordered="true"
            :small="true"
            :fields="fields"
            :items="AllKvadrat"
            responsive="sm"
            :no-border-collapse="false"
            @row-middle-clicked="deleteField"
            row-hovered="row"
            head-variant="dark">

            <template #cell(id)="row">
                <b-form-group>

                    <h5 class="ml-2 ">
                        <b variant="info">{{ row.item.id }}</b>
                    </h5>

                </b-form-group>
            </template>


            <template v-slot:cell(info)="row">
                <b-form-group>
                    <input class="form-control "
                           v-on:keyup.enter="EditInfo(row.item)"
                           v-model="row.item.info">
                </b-form-group>
            </template>

            <template v-slot:cell(sum_zakaz)="row">
                <b-form-group>

                    <h4 class="sum_zakaz">
                        <b-badge variant="warning">{{ row.item.sum_zakaz }}</b-badge>
                    </h4>

                </b-form-group>
            </template>

            <template #cell(name)="row">
                <b-form-group>


                    <h5 class="ml-5 mt-2" v-if="row.item.name ==  'Добавить курьера'">
                        <b-badge class="pointer" variant="success
" @click="row.toggleDetails"> {{ row.item.name }}
                        </b-badge>
                    </h5>

                    <h5 class="mt-2 ml-5" v-else>
                        <span class="pointer" @click="row.toggleDetails"> {{ row.item.name }}</span>
                    </h5>

                </b-form-group>
            </template>

            <!--------------------------------------------------------------------------------------------------------------------------->

            <template #row-details="row">

                <b-row>

                    <b-col class="text-sm-right mt-2"><b>Курьер:</b></b-col>

                    <div class="col-sm-3 mt-2">

                        <dynamic-select
                            :options="AllKurers"
                            v-model="SelectKurer"
                            option-text="full_name"
                            placeholder="Выберите курьера из списка"
                            @input="sendEditKurer(row.item.id)"/>

                    </div>
                    <a href="#" @click="row.toggleDetails" class="nav-link text-sm "><img
                        src="/images/icon-header/cancel.png" alt="kvadrati"></a>
                </b-row>

            </template>


        </b-table>

    </div>

</template>

<script>

import {mapGetters, mapActions} from "vuex";

export default {

    data() {
        return {

            field_for_edit_info: '',
            SelectKurer: '',

            fields: [
                {
                    key: 'id',
                    label: 'Квадрат',
                    variant: 'warning'
                },
                {
                    key: 'info',
                    label: 'Служебное название',
                },
                // {
                //     key: 'sum_zakaz',
                //     label: 'Заказов на сегодня',
                // },
                {
                    key: 'name',
                    label: 'Курьер',
                },

            ],
        }

    },

    computed: {
        ...mapGetters(['AllKurers', 'AllKvadrat']),

    },

    mounted() {

        this.GetAllKurer()
        this.GetAllKvadrat()
    },


    methods: {

        ...mapActions(['GetAllKurer', 'GetAllKvadrat']),

        addNewKvadratModal() {

            this.$bvModal.show('add_kvadrat')

        },

        EditInfo(row) {

            axios.post('api/v1/sendSlugba_Info_2', {
                field_id: row.id,
                field_value: row.info
            }).then((response) => {

                if (response.data === "Служебная информация обновлена") {

                    Vue.$toast.open({
                        message: 'Служебная информация обновлена',
                        type: 'success',
                        duration: 3000,
                        position: 'top'
                    });

                    this.GetAllKvadrat()
                }
            });

        },

        sendEditKurer(items) {

            axios.post('api/v1/sendEditKurer', {
                id: items,
                name: this.SelectKurer.surname + ' ' + this.SelectKurer.name,
                id_kurer: this.SelectKurer.id
            }).then((response) => {

                if (response.data === "Курьер изменен") {

                    this.GetAllKvadrat()
                    this.SelectKurer = ''

                    setTimeout(() => {

                        Vue.$toast.open({
                            message: 'Курьер изменен',
                            type: 'success',
                            duration: 3000,
                            position: 'top'
                        });

                    }, 1000)

                }
            });

        },

        //---------------------------------------------- Удаляем Квадрат -------------------------------------------------------------//

        deleteField(index) {

            const modalTimeoutSeconds = 7;
            const modalId = 'confirm-modal';
            let modalSetTimeout = null;

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить Квадрат ( ' + index.id + ' ) ?', {
                id: modalId,
                size: 'lg',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: 'Да',
                cancelTitle: 'Нет',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
                .then(value => {

                    if( value === true) {

                        axios.delete('api/v1/kvadrat/' + index.id).then((response) => {

                            if (response.data === "Квадрат удален") {

                                Vue.$toast.open({
                                    message: 'Квадрат удален',
                                    type: 'success',
                                    duration: 3000,
                                    position: 'top'
                                });

                            }
                        });

                        this.GetAllKvadrat()

                    }
                })

            modalSetTimeout = setTimeout(() => {
                this.$bvModal.hide(modalId)
            }, modalTimeoutSeconds * 1000)

        },

    }

}


</script>

<style>

.sum_zakaz b {
    margin-left: 160px
}
</style>

