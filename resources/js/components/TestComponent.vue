<template>
    <div class="up">
        <div class="row">

        </div>
            <div class="card-body">
                <b-table
                    striped
                    hover
                    :items="user"
                    :fields="fields"
                ></b-table>
            </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            user: [],
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
    }
}
</script>

<style>
.up{
    margin-top: 10px;
    /*padding-left: 10px;*/
}
</style>
