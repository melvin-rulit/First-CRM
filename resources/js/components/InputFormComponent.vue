<template>
    <span>

          <span v-if="ifThisRouteZakaz" class="card-title form-control" @click="focus">{{ value }}</span>

        <date-picker

            :lang="lang"
            ref="edit"
            :id="id"
            v-model="value"
            :editable="false"
            :clearable="true"
            :placeholder="placeholder"
            value-type="YYYY-MM-DD"
            format="DD.MM.YYYY"
            @change="keyInputForm = false; $emit('edit-field', value, datePicker, id)"
            @clear="keyInputForm = false; $emit('clear')">
        </date-picker>
    </span>
</template>

<script>

    export default {

        props: {
            value: [String, Number],
            id: {
                type: Number,
            },
            placeholder: {
                type: String,
            },
            // Свойство выводы даты
            datePicker: {
                type: String,
            },
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
