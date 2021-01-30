<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">

                <label class="typo__label">Настройка погоды</label>

                  <multiselect 
                  v-model="value" 
                  deselect-label="Этот город уже выбран" 
                  track-by="title" 
                  label="title" 
                  placeholder="Выберите город" 
                  :options="counry" 
                  :searchable="false"
                  :close-on-select="true" 
                  @close="addCountry"
                  :allow-empty="false">

                  </multiselect>


            </div>
          
        </div>
    </div>
</template>

<script>
    export default {

        mounted() {

            this.getCountry()
        },

        data() {

            return {
                value: [],
                counry: {},
                
            }
        },

        methods: {

            getCountry() {

                axios.get('api/v1/getcountry')
                .then(response => this.counry = response.data.response.items)

            },

            addCountry(value){

                axios.post('api/v1/addcity', {city: this.value.title})
        
            }

        }

    }

</script>

<style>

</style>
