<template>
    <span>

          <span v-if="!keyInputForm " class="card-title form-control" @click="focus">{{ value }}</span>

        <input
            v-if="keyInputForm && !textarea && !datePicker"
            ref="edit"
            class="form-control"
            size="1"
            type="text"
            :placeholder='placeholder'
            :id="id"
            :name="name"
            v-model="value"
            @input="$emit('input', value)"
            @keyup.enter="keyInputForm = false;$emit('edit-field', $event)">

    </span>
</template>

<script>
export default {

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
        mask: {},
        // Свойство вывод textarea
        textarea: {
            type: String,
        },
        // Свойство выводы даты
        datePicker: {
            type: String,
        },
        gate: {
            // type: String,
            default: false,
        }
    },
    data() {
        return {
            keyInputForm: null,
            thisValue: this.value,
        }
    },
    methods: {
        focus(){
            this.keyInputForm = true
            setTimeout(() => {
                this.$refs.edit.focus();
            }, 100);
        },
    }
};
</script>
