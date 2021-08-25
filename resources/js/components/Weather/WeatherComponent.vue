<template>

    <div>


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

            }


        }

    }

</script>


