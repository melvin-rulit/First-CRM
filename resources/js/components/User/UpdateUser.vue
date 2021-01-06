<template>
    <div>

        <!-- Модальное окно с добавлением нового клиента -->
        <b-modal id="addNewUser" ref="my-modal" title="Добавление нового клиента"  centered ok-only ok-title="Добавить">
            <div class="card-body py-0">


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Отчество</label>
                    <div class="col-sm-9">
                        <input v-model.trim="new_child_middle_name" class="form-control">
                    </div>
                </div>



            </div>
        </b-modal>
    </div>

</template>

<script>

// import DynamicSelect from 'vue-dynamic-select'
// Vue.use(DynamicSelect)
//
// import Multiselect from 'vue-multiselect'
//
// Vue.use(Multiselect);
// import 'vue-multiselect/dist/vue-multiselect.min.css';
//
// import { required, minLength } from 'vuelidate/lib/validators';

export default {
    // components: { Multiselect },
    data() {
        return {
            new_child_surname: '',
            new_child_name: '',
            new_child_middle_name: '',
            branch: '',
            manager: '',
            instructor: '',
            sourceGroup: '',
            source: '',
            submitStatus: null,
            showErrors: false,
            branches: [],
            users: [],
            new_user: [],
            sourceGroupArray: [],
            sourceArray: [],
        }
    },

    updateUserModal(){
        this.$bvModal.show('addNewUser')

    },
}
</script>
