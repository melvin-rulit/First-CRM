<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div>

                    <b-tabs >
                        <b-tab title="Должность сотрудников" active> <one /> </b-tab>
                        <b-tab title="Филиалы"> <two @get-method="getAllRoles"></two> </b-tab>
                        <b-tab title="Доступы"> <three /> </b-tab>
                        <b-tab title="Назначения"><p>I'm the second tab</p></b-tab>
                        <b-tab title="Общие настройки"> <five /> </b-tab>

                    </b-tabs>


                </div>
            </div>
        </div>
    </div>
</template>


<script>
import one from './one.vue'
import two from './two.vue'
import five from './five.vue'
import three from './three.vue'
export default {

    components: {
        one,
        two,
        three,
        five
    }
}
</script>

<style>
.tabs{
    padding-left: 120px;
}
.tabs li > a{
    margin-top: -5px;
}

</style>
