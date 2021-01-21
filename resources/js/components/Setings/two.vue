<template>
    <section>
        <b-field grouped group-multiline>
            <div class="control">
                <b-switch v-model="isBordered">Bordered</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="isStriped">Striped</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="isNarrowed">Narrowed</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="isHoverable">Hoverable</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="isFocusable">Focusable</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="isLoading">Loading state</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="isEmpty">Empty</b-switch>
            </div>
            <div class="control">
                <b-switch v-model="hasMobileCards">Mobile cards <small>(collapsed rows)</small></b-switch>
            </div>
        </b-field>

        <b-table
            :data="isEmpty ? [] : data"
            :bordered="isBordered"
            :striped="isStriped"
            :narrowed="isNarrowed"
            :hoverable="isHoverable"
            :loading="isLoading"
            :focusable="isFocusable"
            :mobile-cards="hasMobileCards">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="first_name" label="First Name" v-slot="props">
                {{ props.row.first_name }}
            </b-table-column>

            <b-table-column field="last_name" label="Last Name" v-slot="props">
                {{ props.row.last_name }}
            </b-table-column>

            <b-table-column field="date" label="Date" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.date).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column label="Gender" v-slot="props">
                <span>
                    <b-icon pack="fas"
                            :icon="props.row.gender === 'Male' ? 'mars' : 'venus'">
                    </b-icon>
                    {{ props.row.gender }}
                </span>
            </b-table-column>

        </b-table>
    </section>
</template>

<script>

export default {
    data() {
        const data = [
            { id: 1, first_name: 'Jesse', last_name: 'Simmons', date: '2016/10/15 13:43:27', gender: 'Male' },

        ]

        return {
            data,
            isEmpty: false,
            isBordered: false,
            isStriped: false,
            isNarrowed: false,
            isHoverable: false,
            isFocusable: false,
            isLoading: false,
            hasMobileCards: true
        }
    }
}
</script>
