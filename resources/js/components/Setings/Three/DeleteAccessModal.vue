<template>

    <div>

        <!-- Модальное окно Delete-roles-in-settings -->
        <b-modal id="DeleteAccess"  title="Удалить выбранную должность?"  @ok="deleteAccess($event)"  centered  ok-title="Удалить">
            <p class="center">
<!--                <b-button variant="outline-danger">{{this.roles.title}}</b-button>-->
<!--                <b-badge href="#" variant="danger">{{this.roles.title}}</b-badge>-->
                <b-alert show variant="danger">{{this.access.access}}</b-alert>
            </p>
        </b-modal>
    </div>

</template>

<script>
export default {

    data(){
        return{
            access: {},
        }
    },

    methods:{

        ShowModalDeleteAccess(items){

            this.access = items
            this.$bvModal.show('DeleteAccess')
        },

        deleteAccess(){

            axios.delete('api/v1/access/' + this.access.id);
            this.$emit('get-method')
            Vue.$toast.open({ message: 'Доступ удален',type: 'error',duration: '4000', pauseOnHover: "true" });
        },

    }

}
</script>

<style>

.center{
    text-align: center;
}
</style>

