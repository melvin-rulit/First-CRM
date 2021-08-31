<template>
    <section>
        <b-button
            label="Launch component modal"
            type="is-primary"
            size="is-medium"
            @click="isComponentModalActive = true" />

        <b-modal
            v-model="isComponentModalActive"
            has-modal-card
            full-screen
            :can-cancel="false">
            <modal-form v-bind="formProps"></modal-form>
        </b-modal>
    </section>
</template>

<script>
// import { Table, Input } from 'buefy'
// import 'buefy/dist/buefy.css'
//
// // Vue.use(Table)
// // Vue.use(Input)

const ModalForm = {
    props: ['email', 'password'],
    template: `
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Login</p>
                </header>
                <section class="modal-card-body">
                    <b-field label="Email">
                        <b-input
                            type="email"
                            :value="email"
                            placeholder="Your email"
                            required>
                        </b-input>
                    </b-field>

                    <b-field label="Password">
                        <b-input
                            type="password"
                            :value="password"
                            password-reveal
                            placeholder="Your password"
                            required>
                        </b-input>
                    </b-field>

                    <b-checkbox>Remember me</b-checkbox>
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="$parent.close()" />
                    <b-button
                        label="Login"
                        type="is-primary" />
                </footer>
            </div>
        `
}

export default {
    components: {
        ModalForm
    },
    data() {
        return {
            isComponentModalActive: false,
            formProps: {
                email: 'evan@you.com',
                password: 'testing'
            }
        }
    }
}
</script>
















<!--<template>-->
<!--    <div>-->
<!--        -->
<!--        -->
<!--    </div>-->
<!--&lt;!&ndash;    <div class="container">&ndash;&gt;-->
<!--&lt;!&ndash;        <div class="row">&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="col-md-10">&ndash;&gt;-->
<!--&lt;!&ndash;                <div>&ndash;&gt;-->

<!--&lt;!&ndash;                    <b-tabs >&ndash;&gt;-->
<!--&lt;!&ndash;                        <b-tab title="Должность сотрудников" active> <one /> </b-tab>&ndash;&gt;-->
<!--&lt;!&ndash;                        <b-tab title="Филиалы"> <two @get-method="getAllRoles"></two> </b-tab>&ndash;&gt;-->
<!--&lt;!&ndash;                        <b-tab title="Доступы"> <three /> </b-tab>&ndash;&gt;-->
<!--&lt;!&ndash;                        <b-tab title="Назначения"><p>I'm the second tab</p></b-tab>&ndash;&gt;-->
<!--&lt;!&ndash;                        <b-tab title="Общие настройки"> <five /> </b-tab>&ndash;&gt;-->

<!--&lt;!&ndash;                    </b-tabs>&ndash;&gt;-->


<!--&lt;!&ndash;                </div>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;        </div>&ndash;&gt;-->
<!--&lt;!&ndash;    </div>&ndash;&gt;-->
<!--</template>-->


<!--<script>-->
<!--import one from './one.vue'-->
<!--import two from './two.vue'-->
<!--import five from './five.vue'-->
<!--import three from "./Three/three.vue"-->
<!--export default {-->

<!--    components: {-->
<!--        one,-->
<!--        two,-->
<!--        three,-->
<!--        five-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style>-->

<!--</style>-->
