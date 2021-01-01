<template>
<div>

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
            axios.get('api/v2/getUserName')
                .then(response => this.user = response.data)
        }

    },
}
</script>

<style scoped>

</style>
