<template>
  <div>
<button @click="getWeather">jgrooj</button>




      <at-popover placement="top" v-model="show" @toggle="toggleShow">
          <at-button size="small">Delete</at-button>
          <template slot="content">
              <p>This is part of the content, sure to delete it?</p>
              <div style="text-align: right; margin-top: 8px;">
                  <at-button size="smaller" @click="show = false">Cancel</at-button>
                  <at-button type="primary" size="smaller" @click="show = false">Sure</at-button>
              </div>



          </template>
      </at-popover>


  </div>
</template>

<script>
export default {


}
</script>

<style>

</style>
