<template>
  
  <div>
      <button @click="three">ol</button>
  </div>
</template>

<script>
export default {

    data(){
        return {
data: {}
        }
    },

methods: {
    three(){
        axios.get('api/v1/getBethdey')
        .then(response => this.data = response.data)
    }
}
}
</script>

<style>

</style>