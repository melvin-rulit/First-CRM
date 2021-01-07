<template>

        <span>
        <span>
            <a class="text-success" href="#" v-if="value === '' || value == null && !keyInputForm" @click.prevent="focus">Добавить</a>
        </span>
          <span v-if="!keyInputForm" class="card-title" @click="focus">{{ value }}</span>


        <input
            v-if="keyInputForm"
            ref="edit"
            class="form-control"
            size="1"
            type="text"
            :placeholder="placeholder"
            :id="id"
            :name="name"
            v-model="value"

            @input="$emit('input', value)"
            @keyup.enter="keyInputForm = false;$emit('edit-field', $event)"
            @blur="keyInputForm = false; $emit('edit-field', $event)">


    </span>




</template>

<script>
export default {

    data() {
        return {
            keyInputForm: null,
            thisValue: this.value,
        }
    },

    props: {
        value: [String, Number],
        name: {
            type: String,
            required: true
        },
        id: {
            type: Number,
        },
        placeholder: {
            type: String,
        },

    },

    methods: {
        focus(){
            this.keyInputForm = true
            setTimeout(() => {
                this.$refs.edit.focus();
            }, 100);
        },
    }
}
</script>

<style scoped>

</style>
