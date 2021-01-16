<template>

    <!-- Container -->
    <div id="container">
        <div class="top">

                 <!-- Modal -->
            <update-user @get-method="UpdateDataMethod" ref="showmodal"></update-user>


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

                    <h1>{{ user.name }}</h1>
                    <h3>GRAPHIC & WEB DESIGNER</h3>
                    <p>I like to make cool and creative designs. My design stash is always full of refreshing ideas. Feel free to take a look around my Vcard.</p>
                    <p>I like to make cool and creative designs. My design stash is always full of refreshing ideas. Feel free to take a look around my Vcard.</p>

                </div>


                <!-- Personal info section -->
                <ul class="personal-info">

                    <li><label>Фамилия </label><span>{{ user.name }}</span></li>
                    <li><label>Д.рождения </label><span>March 13, 1988</span></li>
                    <li><label>Адресс </label><span>Melbourne Victoria 3000 Australia</span></li>
                    <li><label>Почта </label><span>{{ user.email }}</span></li>
                    <li><label>Телефон </label><span>{{ user.tel }}</span></li>
                    <li><label>Вэб сайт </label><span>www.asmith.com</span></li>

                </ul>

            </div>



            <!-- Menu -->
            <div class="menu">
                <ul class="tabs ">

                    <li><a href="#" class="tab-profile nav-link">Изменить фото</a></li>
                    <li><a href="#" class="tab-resume nav-link" @click="ShowUserCard">Редактировать профиль</a></li>
<!--                    <li><a href="#" class="tab-portfolio nav-link"><b-icon-card-checklist scale="2"></b-icon-card-checklist></a></li>-->
                    <li><a href="#" class="tab-contact nav-link">Личные качества</a></li>
                    <li><a href="#" class="tab-contact nav-link">О себе </a></li>





                </ul>
            </div>

        </div>
    </div>
</template>

<script>
export default {

    // beforeRouteEnter (to, from, next) {
    //     axios.get('api/v1/getUserName')
    //         .then(response => {
    //             next(vm => (vm.user = response.data) )
    //         })
    // },

    data() {
        return {
            user: '',
            articles: '',
        }
    },

    mounted() {
        // Запускаем метод при монтировании
        this.getUserName()
    },

    methods: {
        getUserName(){
            // Получаем данные о пользователе
            axios.get('api/v1/getUserName')
                .then(response => this.user = response.data)
        },

        ShowUserCard(){
            // Запускаем модальное окно карточки клиента
            this.$bvModal.show('addNewUser')

        },

        UpdateDataMethod(){
            // Этот метод запускается при закрытии модального окна для обновления данных
            axios.get('api/v1/getUserName')
                .then(response => this.user = response.data)
        }


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
    padding-left:130px;

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
