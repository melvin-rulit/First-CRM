<template>

    <div class="card">
        <div class="card-body pb-0">
            <b-table
                hover
                sticky-header="750px"
                :items="users"
                :fields="fields"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"

                head-variant="light">
                <template v-slot:cell(network)="row">

                </template>
            </b-table>
        </div>
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
