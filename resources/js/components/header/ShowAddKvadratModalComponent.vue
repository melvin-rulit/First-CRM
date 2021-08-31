<template>

<div>

    <b-modal   id="add_kvadrat" title="Создание квадратов" size="xl"  ok-only  button-size="sm" ok-title="Добавить">



</b-modal>

</div>

</template>

<script>

export default {


    data () {

        return {

            kvadrat: []
        }
    },

    methods: {

        addNewKvadratModal(){

            this.$bvModal.show('add_kvadrat')

        },


    }
};
</script>
