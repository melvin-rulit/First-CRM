<template>

    <div class="container">

        <div class="row">

            <div class="col-md-10">

                <md-card>
                    <md-card-header>
                        <md-card-header-text>
                            <div class="md-title">{{ results.name }} </div>
                            <div class="md-subhead">
                                <p v-for="rol in results.weather">
                                    {{ rol.description }}
                                </p>

                                <div><span>Скорость ветра {{ results.wind.speed }}</span></div>
                            </div>

                        </md-card-header-text>

                        <md-card-media md-medium>

                            <div v-for="pic in results.weather">
                                <img :src="`http://openweathermap.org/img/w/${pic.icon}.png`" :alt="pic">
                            </div>

                        </md-card-media>
                    </md-card-header>
                </md-card>


            </div>
        </div>

    </div>

</template>

<script>
    export default {


        mounted() {

            this.getWeather()
        },

        data() {
            return {

                results: {},


            }
        },

        methods: {

            getWeather() {

                axios.get('api/v1/getweather')
                    .then(response => this.results = response.data)
                    .then((response) => {
                        commit('pets', response.data);
                    })

            }


        }

    }

</script>

<style>
    .md-card {
        width: 320px;
        margin: 4px;
        display: inline-block;
        vertical-align: top;
    }

</style>
