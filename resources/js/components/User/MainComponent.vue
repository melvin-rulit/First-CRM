<template>

    <!-- Container -->
    <div id="container">
        <div class="top">

                 <!-- Modal -->
            <add-foto @get-method="hj"></add-foto>
            <edit-profile @get-method="updateDataWhenExitModal" ref="getmodal"></edit-profile>
            <edit-personal @get-method="updateDataWhenExitModal" ></edit-personal>


            <!-- Logo -->
            <div id="logo">
                <h2>Ваша карточка</h2>
            </div>


            <!-- Social Icons -->
            <ul class="socialicons">

                <li><a href="#" class="social-facebook"></a></li>
                <li><a href="#" class="social-twitter"></a></li>
                <li><a href="#" class="social-googleplus"></a></li>

            </ul>

        </div>


        <!-- Content -->
        <div id="content" >
            <div id="profile">

                <!-- About section -->
                <div class="about">
                    <div class="photo-inner"><img src="http://62.109.26.106//images/photo_LI.jpg" height="186" width="153" /></div>

                    <h1>{{ userdata.surname }}</h1>
                    <h3>{{ userdata.name }} {{ userdata.lastname }}</h3>
                    <p>{{ userdata.comment }}</p>


                </div>


                <!-- Personal info section -->
                <ul class="personal-info">

                    <li><label>Должность </label><span>{{ userdata.roles }}</span></li>
                    <li><label>Д.рождения </label><span>{{ userdata.birthday}}</span></li>
                    <li><label>Адресс </label><span>{{ userdata.adress }}</span></li>
                    <li><label>Почта </label><span>{{ userdata.email }}</span></li>
                    <li><label>Телефон </label><span>{{ userdata.phone }}</span></li>
                    <li><label>Вэб сайт </label><span></span></li>

                </ul>

            </div>



            <!-- Menu -->
            <div class="menu">
                <div class="tab">
                <ul>

                    <li><a href="#" class="tab-photo nav-link" @click="showModalUserCardAddFoto">Добавить / Изменить фото</a></li>
                    <li><a href="#" class="tab-profile nav-link" @click="showModalUserCardEditProfile(userdata)">Редактировать профиль</a></li>
                    <li><a href="#" class="tab-personal nav-link" @click="showModalUserCardEditPersonal()">Личные качества</a></li>


                </ul>
                </div>

            </div>

        </div>
    </div>

</template>

<script>


export default {

    data() {
        return {
            userdata: [],
        }

    },

    mounted() {
        this.getUserCardData()
    },

    methods: {

        getUserCardData(){
            axios.get('api/v1/user')
                .then(response => {
                    this.userdata = response.data;
                })
        },

        showModalUserCardAddFoto(){
            this.$bvModal.show('UserCardAddFoto')
         },

        showModalUserCardEditProfile(userdata){
            this.$refs.getmodal.addNewUserModal(userdata.id)
         },

        showModalUserCardEditPersonal(){
            this.$bvModal.show('UserCardEditPersonal')
        },

        updateDataWhenExitModal(){
            axios.get('api/v1/user')
                .then(response => this.userdata = response.data)
        },



    }
}

</script>

<style>

/*-------------------------------------------------------*/
/* Menu Footer*/
/*-------------------------------------------------------*/
.menu {
    height:100px;
    background-color:#ededed;
    position:relative;
}
.tab {
    /*height:116px;*/
    position: absolute;
    margin-top:-45px;
    padding-left:130px;

}
.tab li {
    float:left;
    /*height:116px;*/

}

.tab ul li > a {
    margin-top:80px;

    display:block;
    background-repeat:no-repeat;
    font-size:16px;
    color:#b9b9b9;
    text-align:center;

}



#logo h2 {
    font-size:30px;
    font-weight:900;
    color:#b9b9b9;
    line-height:40px;
}

</style>
