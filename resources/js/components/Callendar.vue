<template>
<div>

  <date-pick 
  v-model="date"
  :selectableYearRange="{from: 1985, to: 2020}"
  :format="format"
        :parseDate="parseDate"
        :formatDate="formatDate"
        :inputAttributes="{size: 32}">
  </date-pick>

</div>
  
</template>

<script>
import DatePick from 'vue-date-pick';
// import fecha from 'fecha';
import 'vue-date-pick/dist/vueDatePick.css';

export default {
    components: {DatePick},
  
    data: () => ({
        format: 'MMMM Do, YYYY',
        date: fecha.format(new Date(), 'dddd MMMM Do, YYYY')
    }),
    methods: {
        parseDate(dateString, format) {
            return fecha.parse(dateString, format);
        },
        formatDate(dateObj, format) {
            return fecha.format(dateObj, format);
        }
    }
};
</script>
