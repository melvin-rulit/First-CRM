<template>



    <div class="container">

        <button
            @click="onDayClick">Calendar</button>
        <b-calendar
            id="ex-disabled-readonly"

        ></b-calendar>
</div>

</template>
<script>

export default {
  data() {
    return {
      days: [],
    };
  },
  computed: {
    dates() {
      return this.days.map(day => day.date);
    },
    attributes() {
      return this.dates.map(date => ({
        highlight: true,
        dates: date,
      }));
    },
  },
    methods: {
        onDayClick() {
            axios.get('api/v1/export')
                .then(response => this.results = response.data)
        },
    },
};


</script>



<style>

</style>
