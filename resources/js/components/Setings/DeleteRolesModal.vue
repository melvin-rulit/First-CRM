<template>

    <div>

        <!-- Модальное окно Delete-roles-in-settings -->
        <b-modal id="DeleteRoles"  title="Удалить выбранную должность?"  @ok="deleteRole($event)"  centered  ok-title="Удалить">
            <p>
                {{this.roles.title}}
            </p>
        </b-modal>
    </div>

</template>

<script>
export default {

    data(){
        return{
            roles: {},
        }
    },

    methods:{

        ShowModalDeleteRoles(items){

            this.roles = items
            this.$bvModal.show('DeleteRoles')
        },

        deleteRole(){

            axios.delete('api/v1/roles/' + this.roles.id);
            this.$emit('get-method')
        },

    }

}
</script>

<style>

</style>

