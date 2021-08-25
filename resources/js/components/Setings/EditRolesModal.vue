<template>

   <div>

        <!-- Модальное окно Update-roles-in-settings -->
        <b-modal id="EditRoles"  title="Отредактируйте выбранную должность"  v-on:hide="updateNewRole" centered ok-only ok-title="Готово">
            <div>

                <b-input-group>
                    <template #prepend>
                        <b-input-group-text>{{roles.title}}</b-input-group-text>
                    </template>
                        <b-form-input v-model="value"></b-form-input>
                </b-input-group>

            </div>
        </b-modal>
    </div>

</template>

<script>
export default {

    data(){
     return{
        roles: {},
        value: ''
        }
    },

    methods:{

        ShowModalEditRoles(items){

            this.roles = items
            this.$bvModal.show('EditRoles')
        },

        updateNewRole(){

            if(this.value === ''){
                console.log("empty value")

            }else{

                axios.put('api/v1/roles/' + this.roles.id, {value: this.value})
                this.$emit('get-method')
                Vue.$toast.open({ message: 'Обновленно',type: 'success',duration: '4000', pauseOnHover: "true" });
                this.value = ''
            }

        },

}

}
</script>

<style>

</style>
