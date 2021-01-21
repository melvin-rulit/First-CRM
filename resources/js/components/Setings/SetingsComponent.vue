<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div>

                    <b-tabs content-class="mt-1">
                        <b-tab title="Должность сотрудников" active> <one /> </b-tab>
                        <b-tab title="Second"> <two /> </b-tab>
                        <b-tab title="First" ></b-tab>
                        <b-tab title="Second"><p>I'm the second tab</p></b-tab>

                        <b-tab title="Second"><p>I'm the second tab</p></b-tab>

                    </b-tabs>


                </div>
            </div>
        </div>
    </div>
</template>


<script>
import one from './one.vue'
import two from './two.vue'
export default {

    components: {
        one,
        two
    }
}
</script>

<style scoped>
.tabs{
    padding-left: 10px;
}
</style>
