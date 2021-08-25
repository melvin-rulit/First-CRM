<template>
    <span>
        <span>
            <a class="text-success" href="#" v-if="value == '' || value == null && !keyInputForm && ifThisRouteZakaz" @click.prevent="focus">Добавить</a>
        </span>

          <span v-if="ifThisRouteZakaz" class="card-title form-control" @click="focus">{{ value }}</span>

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

        <input
            v-if="keyInputForm && !textarea && !datePicker"
            ref="edit"
            class="form-control"
            size="1"
            type="text"
            :placeholder="placeholder"
            :id="id"
            :name="name"
            v-model="value"
            v-mask="mask"
            @input="$emit('input', value)"
            @keyup.enter="keyInputForm = false;$emit('edit-field', $event)"
            @blur="keyInputForm = false; $emit('edit-field', $event)">

        <date-picker
            v-if="datePicker"
            :lang="lang"
            ref="edit"
            :id="id"
            v-model="value"
            :editable="false"
            :clearable="true"
            :placeholder="placeholder"
            value-type="YYYY-MM-DD"
            format="DD.MM.YYYY"
            @close="keyInputForm = false; $emit('edit-field', value, name ,datePicker, id)"
            @clear="keyInputForm = false; $emit('clear')">
        </date-picker>
    </span>
</template>

<script>
    import {TheMask} from 'vue-the-mask'
    export default {
        components: {TheMask},
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
                lang: {
                    formatLocale: {
                        firstDayOfWeek: 1,
                        weekdaysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                        monthsShort: ['Янв', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                    },
                },
                keyInputForm: null,
                thisValue: this.value,
            }
        },

        computed: {

            ifThisRouteZakaz() {
                if (this.$route.name === 'zakaz'){
                    return false;
                }else{
                    return true;
                }

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
    };
</script>
