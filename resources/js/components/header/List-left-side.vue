<template>

    <div class="collapse navbar-collapse">

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto tracking-widest pt-16">


<!--            <li>-->
<!--                <a class="menu_link.active" href="#">Ссылка 1</a>-->
<!--            </li>-->


            <div><li ><router-link to="/home" class="nav-link text-lg menu_link active"><img src="/images/avatar/house.png" alt="Home"> </router-link></li>

                <li class="menu_link"><router-link to="/users" class="nav-link text-lg "><img src="/images/avatar/book.png" alt="Logout"></router-link></li>

                <li class="menu_link"><router-link to="/callendar" class="nav-link text-lg "><img src="/images/avatar/messages.png" alt="Logout"></router-link></li>

                <li class="menu_link"><router-link to="/vcallendar" class="nav-link text-lg "><img src="/images/avatar/database.png" alt="Base"></router-link></li>

                <li class="menu_link"><router-link to="/callendar" class="nav-link text-lg "><img src="/images/avatar/users.png" alt="Logout"></router-link></li>

                <li class="menu_link"><a href="#" @click.prevent="loGout()" class="nav-link text-lg "><img src="/images/avatar/logout.png" alt="Logout"></a></li>

            </div>




        </ul>

<!--        &lt;!&ndash; Right Side Of Navbar &ndash;&gt;-->
<!--        <ul class="navbar-nav ml-auto">-->

<!--           -->
<!--        </ul>-->
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
