<template>

    <!-- Container -->
    <div id="container">
        <div class="top">

                 <!-- Modal -->
            <edit-profile @get-method="updateDataWhenExitModal" ref="showmodal"></edit-profile>
            <edit-personal @get-method="updateDataWhenExitModal" ref="showmodal"></edit-personal>


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

                    <li><label>Должность </label><span>{{ userdata.business }}</span></li>
                    <li><label>Д.рождения </label><span>March 13, 1988</span></li>
                    <li><label>Адресс </label><span>Melbourne Victoria 3000 Australia</span></li>
                    <li><label>Почта </label><span>{{ userdata.email }}</span></li>
                    <li><label>Телефон </label><span>{{ userdata.tel }}</span></li>
                    <li><label>Вэб сайт </label><span></span></li>

                </ul>

            </div>



            <!-- Menu -->
            <div class="menu">
                <ul class="tabs ">

                    <li><a href="#" class="tab-photo nav-link">Изменить фото</a></li>
                    <li><a href="#" class="tab-profile nav-link" @click="showModalUserCardEditProfile">Редактировать профиль</a></li>
                    <li><a href="#" class="tab-personal nav-link" @click="showModalUserCardEditPersonal">Личные качества</a></li>


                </ul>
            </div>

        </div>
    </div>

</template>

<script>


export default {

    data() {
        return {
            userdata: '',
        }

    },

    mounted() {
        this.getUserCardData()
    },

    methods: {
        getUserCardData(){
            axios.get('api/v1/getUserName')
                .then(response => this.userdata = response.data)
        },

        showModalUserCardEditProfile(){
            this.$bvModal.show('UserCardEditProfile')

        },

        showModalUserCardEditPersonal(){
            this.$bvModal.show('UserCardEditPersonal')
        },

        updateDataWhenExitModal(){
            axios.get('api/v1/getUserName')
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
.tabs {
    /*height:116px;*/
    position: absolute;
    margin-top:-45px;
    padding-left:150px;

}
.tabs li {
    float:left;
    /*height:116px;*/

}

.tabs li > a {
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
