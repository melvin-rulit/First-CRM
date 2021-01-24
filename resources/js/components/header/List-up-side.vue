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


            <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">

            <li><router-link to="/user" class="nav-link text-lg "><img src="/images/icon-header/users.png" alt="Personal"></router-link></li>

            <li><a href="#" @click.prevent="loGout()" class="nav-link text-lg "><img src="/images/icon-header/logout.png" alt="Logout"></a></li>

        </ul>
    </div>


</template>

<script>
export default {

    methods: {
        loGout() {
            axios.post("/logout").then(response => {
                window.location.replace("/");

            });
        }
    }
}
</script>

<style scoped>

</style>
