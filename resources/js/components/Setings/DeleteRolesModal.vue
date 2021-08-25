<template>

    <div>

        <!-- Модальное окно Delete-roles-in-settings -->
        <b-modal id="DeleteRoles"  title="Удалить выбранную должность?"  @ok="deleteRole($event)"  centered  ok-title="Удалить">
            <p class="center">
<!--                <b-button variant="outline-danger">{{this.roles.title}}</b-button>-->
<!--                <b-badge href="#" variant="danger">{{this.roles.title}}</b-badge>-->
                <b-alert show variant="danger">{{this.roles.title}}</b-alert>
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
            Vue.$toast.open({ message: 'Должность удалена',type: 'error',duration: '4000', pauseOnHover: "true" });
        },

    }

}
</script>

<style>

.center{
    text-align: center;
}
</style>

