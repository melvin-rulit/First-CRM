<template>

    <div class="collapse navbar-collapse">

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto tracking-widest">

                <li><router-link to="/home" class="nav-link text-lg "><img src="/images/icon-header/house.png"></router-link></li>

                <li><router-link to="/vcallendar" class="nav-link text-lg "><img src="/images/icon-header/book.png"></router-link></li>

                <li><router-link to="/callendar" class="nav-link text-lg "><img src="/images/icon-header/messages.png"></router-link></li>

                <li><router-link to="/personal" class="nav-link text-lg "><img src="/images/icon-header/database.png"></router-link></li>

                <li><router-link to="/test" class="nav-link text-lg "><img src="/images/icon-header/glasses.png"></router-link></li>

                <li><router-link to="/setings" class="nav-link  "><img src="/images/icon-header/settings.png"></router-link></li>

                <!-- <li><router-link to="/fuck" class="nav-link "><b-icon-chat-right-text scale="2"></b-icon-chat-right-text></router-link>Chat</li> -->


        </ul>
  <div>


           <!-- <b-alert class=""  variant="success" show>Success Alert</b-alert> -->

  </div>


            <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">

            <li><router-link to="/user" class="nav-link text-lg "><img src="/images/icon-header/users.png" alt="Personal"></router-link></li>

            <li><a href="#" @click.prevent="loGout()" class="nav-link text-lg "><img src="/images/icon-header/logout.png" alt="Logout"></a></li>

        </ul>
    </div>


</template>

<script>
import {mapGetters} from 'vuex'


export default {

    computed:{
        ...mapGetters([
            'SHOW_ADD'
        ])
    },

     methods: {

        loGout() {
            axios.post("/logout").then(response => {
                window.location.replace("/");

            });
        },

       
                

    }
}
</script>

<style scoped>

.style-b-sidebar{

    position: fixed; /* Фиксированное положение */
    left: 71%; /* Расстояние от правого края окна браузера */
    bottom:115px; /* Расстояние сверху */
    /*bottom: 715px; !* Расстояние сверху *!*/
    padding: 10%; /* Поля вокруг текста */
    z-index: 199;
}

</style>


       <!-- <b-button  v-b-toggle.sidebar-right>Добавить пользрвателя</b-button> -->
    <!-- <b-sidebar  id="sidebar-right" title="Sidebar" right shadow> -->
      <!-- <div class="px-3 py-2">
        <p>
          Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis
          in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
        </p>
        <b-img src="https://picsum.photos/500/500/?image=54" fluid thumbnail></b-img>
      </div>
    </b-sidebar> -->