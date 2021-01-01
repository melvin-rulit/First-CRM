<template>

    <div class="collapse navbar-collapse">

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto tracking-widest">
            <div><li><router-link to="/home" class="nav-link text-lg "><img src="/images/avatar/house.png" alt="Home"> </router-link></li>

                <li><router-link to="/users" class="nav-link text-lg "><img src="/images/avatar/book.png" alt="Logout"></router-link></li>

                <li><router-link to="/callendar" class="nav-link text-lg "><img src="/images/avatar/messages.png" alt="Logout"></router-link></li>

                <li><router-link to="/vcallendar" class="nav-link text-lg "><img src="/images/avatar/database.png" alt="Base"></router-link></li>

            </div>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">

            <li><router-link to="/callendar" class="nav-link text-lg "><img src="/images/avatar/users.png" alt="Logout"></router-link></li>

            <li><a href="#" @click.prevent="loGout()" class="nav-link text-lg "><img src="/images/avatar/logout.png" alt="Logout"></a></li>

        </ul>
    </div>


















<!--<div>-->

<!--   <ul class="navbar-nav tracking-widest ml-5">-->

<!--       <li><router-link to="/home" class="nav-link text-lg no-underline" style="color:orange"> Home </router-link></li>-->
<!--       <li><router-link to="/users" class="nav-link text-lg no-underline"> Fuck </router-link></li>-->
<!--       <li><router-link to="/callendar" class="nav-link text-lg no-underline"> VCalendar </router-link></li>-->
<!--       <li><router-link to="/vcallendar" class="nav-link text-lg no-underline"> Calendar </router-link></li>-->



<!--           <li ><a href="#" @click.prevent="loGout()" class="nav-link text-lg no-underline absolute center right-2">-->
<!--               <b-icon icon="power" aria-hidden="true"></b-icon>Logout-->
<!--           </a></li>-->

<!--   </ul>-->








<!--</div>-->
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
