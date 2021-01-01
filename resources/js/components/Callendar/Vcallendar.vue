<template>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                

                    <div class="card-body">
                      
                                <vc-calendar  :value="null"
                                color="green"
                                is-dark
                                is-range
                                :attributes='attributes' 
                                @dayclick="onDayClick" />
                    </div>
                    <h3>{{days}}</h3>
                </div>
            </div>
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
    onDayClick(day) {
      const idx = this.days.findIndex(d => d.id === day.id);
      if (idx >= 0) {
        this.days.splice(idx, 1);
      } else {
        this.days.push({
          id: day.id,
          date: day.date,
        });
      }
    },
  },
};


</script>



<style>

</style>