<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10">



                <div>
                    <b-table :items="roles" ></b-table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {

            roles: [],


        }

    },

    mounted() {
        this.getRoles()
    },

    methods:{

        getRoles(){
            axios.get('api/v1/getRoles')
                // .then(response => this.roles = response.data)
                 .then(response => {this.roles = response.data.data;})

        }
    }


}

</script>

<style>

</style>
