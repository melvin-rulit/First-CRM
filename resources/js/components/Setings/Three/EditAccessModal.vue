<template>

   <div>

        <!-- Модальное окно Update-roles-in-settings -->
        <b-modal id="EditAccess"  title="Отредактируйте выбранный доступ"  v-on:hide="updateNewAccess" centered ok-only ok-title="Готово">
            <div>

                <b-input-group>
                    <template #prepend>
                        <b-input-group-text>{{access.access}}</b-input-group-text>
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
        access: {},
        value: ''
        }
    },

    methods:{

        ShowModalEditAccess(items){

            this.access = items
            this.$bvModal.show('EditAccess')
        },

        updateNewAccess(){
                if(this.value === ''){
                    console.log("empty value")

                }else{

                    axios.put('api/v1/access/' + this.access.id, {value: this.value})
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
