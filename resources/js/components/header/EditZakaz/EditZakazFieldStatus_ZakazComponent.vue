<template>

<div>

    <b-modal   id="add_status_zakaz" title="Изминение статуса"  ok-only  button-size="sm" ok-title="Отмена" centered>

        <template #modal-title>

            <h7 class="">№ заказа</h7>
            <b>[ {{ Status.orderid }} ]</b>

        </template>


        <b-row class="card-body">

            <div class="row">
                <div class="col-lg-12">

                    <div class="row align-items-center">
                        <div class="col-auto">


                            <b-button variant="outline-secondary"
                                       class="ml-au"><a href="#" @click="Status_Active(null)" class="nav-link text-md"><img
                                src="/images/icon_zakaz/check-mark.png"></a>
                            </b-button>

                            <b-button variant="outline-secondary"
                                       class="ml-au"><a href="#" @click="Status_Deactive(1)" class="nav-link text-md"><img
                                src="/images/icon_zakaz/close.png"></a>
                            </b-button>

                        </div>
                    </div>
                </div>
            </div>

        </b-row>

</b-modal>

</div>

</template>

<script>
import {mapActions} from "vuex";

export default {


    data () {

        return {

            Status: [],

        }
    },

    methods: {
        ...mapActions(['GetAllZakaz']),

        editZakazModal(item){
            this. Status = item
            this.$bvModal.show('add_status_zakaz')

        },

        Status_Active(index) {

            axios.post('api/v1/send_Status_Zakaz', {
                field_id: this.Status.id,  field_value: index

            })
            this.$bvModal.hide('add_status_zakaz')
            this.GetAllZakaz()
        },

        Status_Deactive(index) {

            axios.post('api/v1/send_Status_Zakaz', {
                field_id: this.Status.id,  field_value: index

            })
            this.$bvModal.hide('add_status_zakaz')
            this.GetAllZakaz()
        },

    }
};
</script>

<style>

.ml-au {
    margin-left: 80px;
}
</style>
