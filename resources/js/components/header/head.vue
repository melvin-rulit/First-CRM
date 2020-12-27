<template>
    <div>


        <a href="#" @click="loGout()">
            <b-button variant="outline-info" class="mb-2">
                <b-icon icon="power" aria-hidden="true"></b-icon> Logout
            </b-button>
        </a>


    </div>
</template>

<script>
    export default {


        methods: {

            loGout() {

                axios.get("/logout").then(response => {

                    window.location.replace("/");

                });
            }
        }
    }

</script>
