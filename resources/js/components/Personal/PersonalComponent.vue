<template>
    <div class="container container-otstup">
        <div class="row">

            <div class="col-md-12">
                <div class="card-body">
                    <b-table
                        striped
                        hover
                        :items="user"
                        :fields="fields"
                        :bordered="true"></b-table>
                </div>



               
                        <b-button @click="open5('success')">Toggle Sidebar</b-button>
                        <!-- <b-button @click="addNewUser">Toggle Sidebar</b-button> -->
                      
<!-- <at-button     @click="open5('success')">Success</at-button> -->


                </div>
            </div>
        </div>

</template>

<script>


export default {



    data() {
        return {
            user: [],

            fields: [
                {
                key: 'id',
                label: 'ID',
                },
                {
                    key: 'network',
                    label: 'В сети',
                },
                {
                    key: 'name',
                    label: 'Имя',
                },
                {
                    key: 'surname',
                    label: 'Фамилия',
                },
                {
                    key: 'email',
                    label: 'Логин (почта)',
                }
            ],
        }
    },

    methods: {

        addNewUser(){
            this.$store.commit('CHANGE_ADD');
  
         setTimeout(() => {
            this.$store.commit('CHANGE_ADD');
                },1000)
        },

         open5 (type) {
                this.$Notify.success({
                title: 'Увидомление',
                message: 'Сотрудник удален',
                type: type
                })
        }
    }
}

</script>

<style>

.container-otstup{
    margin-top: 0px;
    /* margin-left: 5px; */
}
.cold{
    position: fixed; /* Фиксированное положение */
    left: 81%; /* Расстояние от правого края окна браузера */
    top: -5px; /* Расстояние сверху */
    /*bottom: 715px; !* Расстояние сверху *!*/
    padding: 10%; /* Поля вокруг текста */
    z-index: 199;
}

</style>
