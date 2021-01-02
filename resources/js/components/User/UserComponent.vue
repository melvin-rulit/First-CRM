<template>

    <!-- Container -->
    <div id="container">
        <div class="top">

            <!-- Logo -->
            <div id="logo">

                <h2>
                    <b-badge variant="success">/User</b-badge>
                </h2>

            </div>

            <!-- Social Icons -->
            <ul class="socialicons">

                <li><a href="#" class="social-text">SOCIAL PROFILES</a></li>
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
                    <div class="photo-inner"><img src="images/tut.jpg" height="186" width="153" /></div>

                    <h1>{{ user.name }}</h1>
                    <h3>GRAPHIC & WEB DESIGNER</h3>
                    <p>I like to make cool and creative designs. My design stash is always full of refreshing ideas. Feel free to take a look around my Vcard.</p>
                </div>


                <!-- Personal info section -->
                <ul class="personal-info">

                    <li><label>Name</label><span>{{ user.name }}</span></li>
                    <li><label>Date of birth</label><span>March 13, 1988</span></li>
                    <li><label>Address</label><span>Melbourne Victoria 3000 Australia</span></li>
                    <li><label>Email</label><span>{{ user.email }}</span></li>
                    <li><label>Phone</label><span>{{ user.tel }}</span></li>
                    <li><label>Website</label><span>www.asmith.com</span></li>

                </ul>

            </div>



            <!-- Menu -->
            <div class="menu">
                <ul class="tabs">

                    <li><a href="#profile" class="tab-profile">Profile</a></li>
                    <li><a href="#resume" class="tab-resume">Resume</a></li>
                    <li><a href="#portfolio" class="tab-portfolio">Portfolio</a></li>
                    <li><a href="#contact" class="tab-contact">Contact</a></li>

                </ul>
            </div>

        </div>
    </div>
</template>

<script>
export default {


    data() {
        return {
            user: ''
        }
    },

    mounted() {
        this.getUserName()
    },

    methods: {
        getUserName() {
            axios.get('api/v1/getUserName')
                .then(response => this.user = response.data)
        }

    },
}

</script>

<style>

</style>
