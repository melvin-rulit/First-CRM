<template>

        <span>
        <span>
            <a class="text-success" href="#" v-if="value === '' || value == null && !keyInputForm" v-on:click.prevent="focus">Добавить</a>
        </span>
          <span v-if="!keyInputForm" class="card-title" v-on:click="focus">{{ value }}</span>



<label>
    <input
        v-if="keyInputForm && !textarea"
        ref="edit"
        class="form-control"
        size="4"
        type="text"
        :placeholder="placeholder"
        :id="id"
        :name="name"
        v-model="value"

        @input="$emit('input', value)"
        @keyup.enter="keyInputForm = false;$emit('edit-field', $event)"
        @blur="keyInputForm = false; $emit('edit-field', $event)">
</label>

<label>
    <textarea
        v-if="textarea && keyInputForm"
        ref="edit"
        class="form-control"
        :id="id"
        :name="name"
        v-model="value"
        @input="$emit('input', value)"
        @blur="keyInputForm = false; $emit('edit-field', $event)">
    </textarea>
</label>

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
