<template>

<div class="container">
    <nav class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item"><b-icon pack="fab" icon="github"></b-icon></a>
            <a class="navbar-item"><b-icon pack="fab" icon="twitter"></b-icon></a>
        </div>
    </nav>
</div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            add: true,
            sortBy: 'id',
            sortDesc: false,
            fields: [
                {
                    key: 'id',
                    label: 'ID',
                },
                {
                    key: 'network',
                    label: 'В сети',
                },
                {
                    key: 'name',
                    label: 'Имя',
                },
                {
                    key: 'surname',
                    label: 'Фамилия',
                },
                {
                    key: 'email',
                    label: 'Логин (почта)',
                }
            ],
        }
    },


}
</script>

<style scoped>

</style>
