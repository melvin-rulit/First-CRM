<template>

<div>

    <b-table

        hover
        :bordered="true"
        :small="true"
        :fields="fields"
        :items="kvadrat"
        responsive="sm"
        :no-border-collapse="true"
        @row-clicked=""
        row-hovered="row"
        head-variant="dark">

        <template #cell(name)="row">
           <b-form-group>

                      <b class="pointer" @click="row.toggleDetails"> {{ row.item.name}}</b>

                   </b-form-group>
                   </template>

        <template #row-details="row">

                <b-row class="mb-2">

                    <b-col sm="3" class="text-sm-right"><b>Курьер:</b></b-col>

                    <div class="col-sm-7">

                    <dynamic-select
                        :options="AllKurers"
                        v-model="SelectKurer"
                        option-text="full_name"
                        placeholder="Выберите курьера из списка"
                        @input = "sendEditKurer(row.item.id)"/>

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

                    SelectKurer: '',
                    kvadrat: [],

                    fields: [
                        {
                            key: 'id_kurer',
                            label: 'Квадрат',
                        },
                        {
                            key: 'sum_zakaz',
                            label: 'Заказов на завтра',
                        },
                        {
                            key: 'name',
                            label: 'Курьер',
                            variant: 'success'
                        },

                    ],
                }

                },

                computed: {
                    ...mapGetters(['AllKurers']),

                },

                mounted() {

            this. GetAllKurer()
            this.getKvadrat()
                },


                methods: {

                    ...mapActions(['GetAllKurer']),

                    addNewKvadratModal(){

                        this.$bvModal.show('add_kvadrat')

                    },

                    getKvadrat(){

                        axios.get('api/v1/kvadrat')
                            .then(response => this.kvadrat = response.data.data)

                    },

                    sendEditKurer(items){

            axios.post('api/v1/sendEditKurer', {
                id: items,
                name: this.SelectKurer.surname + ' ' + this.SelectKurer.name,
                id_kurer: this.SelectKurer.id
            }).then((response) => {

                            if (response.data === "Курьер изменен") {

                                this.getKvadrat()
                                this. SelectKurer = ''

                                setTimeout(() => {

                                    Vue.$toast.open({
                                        message: 'Курьер изменен',
                                        type: 'success',
                                        duration: 3000,
                                        position: 'top'
                                    });

                                },1000)

                            }
                        });

                    },

                }

              }


            </script>

