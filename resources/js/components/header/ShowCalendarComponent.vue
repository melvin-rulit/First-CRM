<template>

<div>

    <b-modal   id="Calendar" title=""  centered ok-only  size="sm"  button-size="sm" ok-title="Добавить">

        <b-calendar

            id="ex-disabled-readonly"
            selected-variant="success"
            today-variant="info"
            nav-button-variant="danger"
            @context="onContext">

        </b-calendar>



</b-modal>

</div>



<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-md-8">-->

<!--  <date-pick-->
<!--  v-model="date"-->
<!--  :selectableYearRange="{from: 1985, to: 2020}"-->
<!--  :format="format"-->
<!--        :parseDate ="parseDate"-->
<!--        :formatDate ="formatDate"-->
<!--        :inputAttributes ="{size: 32}"-->
<!--        :startWeekOnSunday ="false"-->
<!--        :weekdays= "['Пон', 'Вт', 'Ср', 'Чет', 'Пят', 'Суб', 'Вос']"-->
<!--        :months = "['Январь', 'Февраль', 'Март', 'Апрель',-->
<!--        'Май', 'Июнь', 'Июль', 'Август',-->
<!--        'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь']" >-->

<!--  </date-pick>-->
<!--<h1>{{ date }}</h1>-->

<!--                </div>-->
<!--            </div>-->
<!--        </div>-->



</template>

<script>
import DatePick from 'vue-date-pick';
import fecha from 'fecha';
import 'vue-date-pick/dist/vueDatePick.css';

export default {
    components: {DatePick},

    data: () => ({
        format: 'MMMM Do, YYYY',
        date: fecha.format(new Date(), 'dddd MMMM Do, YYYY'),

    }),






    methods: {

        ShowModalEditData(){

            this.$bvModal.show('Calendar')

        },

        parseDate(dateString, format) {
            return fecha.parse(dateString, format);
        },
        formatDate(dateObj, format) {
            return fecha.format(dateObj, format);
        }
    }
};
</script>

<style>

</style>
