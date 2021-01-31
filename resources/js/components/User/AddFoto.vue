<template>
    <div>
        <!-- Модальное окно AddFoto -->
        <b-modal id="UserCardAddFoto" title="Отредактируйте нужные поля" v-on:hide="closeUserCardModal" centered ok-only
            ok-title="Готово" v-on:click="submitFile()">

            <div class="container">
                <div class="large-12 medium-12 small-12 cell">
                    <label>File
                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
                    </label>
                    <button v-on:click="submitFile()">Submit</button>
                </div>
            </div>
        </b-modal>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                file: ''
            }
        },
        methods: {

            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },

            submitFile() {
                let formData = new FormData();
                for (var i = 0; i < this.files.length; i++) {
                    let file = this.files[i];
                    formData.append('files[' + i + ']', file);
                }
                axios.post('/multiple-files',
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(function () {
                        console.log('SUCCESS!!');
                    })
                    .catch(function () {
                        console.log('FAILURE!!');
                    });

            },
        }
    }

</script>

<style>

</style>
