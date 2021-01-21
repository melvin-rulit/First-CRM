<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                    <b-field label="" type="is-success" >
                        <b-input
                            placeholder="Добавьте новую должность"
                            size="is-large"
                            icon-right="close-circle"
                        ></b-input>
                    </b-field>

                <div>
                    <b-table :items="items" ></b-table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
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

            items: [
                { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                { age: 38, first_name: 'Jami', last_name: 'Carney' }
            ],

            columns: [
                {
                    field: 'id',
                    label: 'ID',
                    width: '40',
                    numeric: true
                },
                {
                    field: 'first_name',
                    label: 'First Name',
                },
                {
                    field: 'last_name',
                    label: 'Last Name',
                },
                {
                    field: 'date',
                    label: 'Date',
                    centered: true
                },
                {
                    field: 'gender',
                    label: 'Gender',
                }
            ]
        }
    }
}
</script>

<style>

</style>
