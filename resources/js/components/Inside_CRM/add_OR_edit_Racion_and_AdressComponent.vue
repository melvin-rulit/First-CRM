<template>

    <div class="d-flex justify-content-center align-items-center container ">

        <div class="container">
            <div class="row">


<!--         <div class="test" v-if="note_adress">-->
<!--                    <b-alert show variant="danger" v-if="ifThisRoute_addAdress">-->
<!--                        <h4 class="alert-heading">Внимание !!!</h4>-->
<!--                        <p>-->
<!--                            Не все поля заполнены.-->
<!--                        </p>-->
<!--                        <p>-->
<!--                            Введите в поле адресс и присвойте ему квадрат. Нажмите кнопку "Сохранить"-->
<!--                        </p>-->
<!--                        <hr>-->
<!--                        <p class="mb-0">-->
<!--                            Данные сохраняться в Базу. Появится уведомление. Можно снова вводить данные-->
<!--                        </p>-->
<!--                    </b-alert>-->
<!--                </div>-->
<!--                <div class="holder" v-wow="{ 'animation-name': 'fadeInUp','animation-duration': '1s'}">LLLL</div>-->
<!--                <div class="fadeInUp" v-wow data-wow-delay="0.2s" data-wow-duration="2s">OOO</div>-->

                <u-animate-container>
                    <u-animate
                        name="fadeIn"
                        delay="0s"
                        duration="1s"
                        :iteration="1"
                        :offset="0"
                        animateClass="animated"
                        :begin="false"
                    >
                        <div class="test" v-if="note_adress">
                            <b-alert show variant="danger" v-if="ifThisRoute_addAdress">
                                <h4 class="alert-heading">Внимание !!!</h4>
                                <p>
                                    Не все поля заполнены.
                                </p>
                                <p>
                                    Введите в поле адресс и присвойте ему квадрат. Нажмите кнопку "Сохранить"
                                </p>
                                <hr>
                                <p class="mb-0">
                                    Данные сохраняться в Базу. Появится уведомление. Можно снова вводить данные
                                </p>
                            </b-alert>
                        </div>

                    </u-animate>
                </u-animate-container>

                <div v-if="ifThisRoute_addRacion">
                    <div class="test" v-if="note_racion">
                        <b-alert show variant="danger">
                            <h4 class="alert-heading">Внимание !!!</h4>
                            <p>
                                Поле не может быт пустым
                            </p>
                            <p>
                                Введите в поле новый рацион. Нажмите кнопку "Сохранить"
                            </p>
                            <hr>
                            <p class="mb-0">
                                Данные сохраняться в Базу. Появится уведомление. Можно снова вводить данные
                            </p>
                        </b-alert>
                    </div>
                </div>

                <div class="otstup_forma" v-if="adress_table">
                    <form action="" @submit.stop.prevent="SendData">

                        <!------------------------------------------------------- Adress ---------------------------------------------------------------->

                        <div class="form-group col ml-4" v-if="ifThisRoute_addAdress">
                            <label for="adress" class="control-label personal">Введите адресс</label>
                            <input type="adress" class="form-control" id="adress" v-model="title"
                                   placeholder="поле не может быть пустым">
                        </div>

                        <div class="form-group col ml-4" v-if="ifThisRoute_addAdress">
                            <label for="kvadrat" class="control-label personal">Укажите квадрат</label>
                            <input type="kvadrat" class="form-control" id="kvadrat" v-model="kvadrat_id"
                                   placeholder="поле не может быть пустым">
                        </div>

                        <!------------------------------------------------------- Racion ---------------------------------------------------------------->

                        <div class="form-group col ml-4" v-if="ifThisRoute_addRacion">
                            <label for="adress" class="control-label personal">Введите имя Рациона</label>
                            <input type="adress" class="form-control" id="racion" v-model="racion"
                                   placeholder="поле не может быть пустым">
                        </div>


                        <div class="form-group col ml-4" v-if="success">
                            <button type="submit" class="btn btn-lg btn-block btn-success mt-3">
                                Сохранить
                            </button>
                        </div>

                        <div class="form-group col ml-4" v-if="error">
                            <button v-if="ifThisRoute_addAdress" type="submit"
                                    class="btn btn-lg btn-block btn-warning mt-3">
                                Заполните оба поля !!!
                            </button>
                        </div>

                        <div class="form-group col ml-4" v-if="error">
                            <button v-if="ifThisRoute_addRacion" ype="submit"
                                    class="btn btn-lg btn-block btn-warning mt-3">
                                Заполните поле !!!
                            </button>
                        </div>

                        <div class="form-group col ml-4">
                            <b-card-text v-if="before_success">
                                <b-alert show variant="warning"><img class="avatar_1"
                                                                     src="/images/icon-promouter/success.png"> Данные
                                    записанны
                                </b-alert>
                            </b-card-text>
                        </div>

                    </form>
                </div>


                <!------------------------------------------------------- Adress ---------------------------------------------------------------->

                <div class="info jumbotrons" v-if="ifThisRoute_addAdress">
                    <b-jumbotron  bg-variant="light" header="" lead="Список адрессов" border-variant="danger"
                                 class="jumbotron">


                        <ul class="navbar-nav mr-auto tracking-widest rol">

                            <li>
                                <a href="#" @click.prevent="loGout"> <img
                                    class="avatar_exit float-right" src="/images/not_user/f.png"></a>
                            </li>

                            <li> Количество записей в таблице: {{ this.totalRows_for_adress }}</li>

                        </ul>

                        <b-table
                            id="my-table"
                            stacked="md"
                            hover
                            :fields="fields_for_adress"
                            sticky-header="false"
                            :items="AllAdress"
                            :per-page="perPage"
                            :current-page="currentPage">

                            <template #cell(№)="data">
                                {{ data.index + 1 }}
                            </template>

                            <template v-slot:cell(title)="row">
                                <b class="pointer" @click="row.toggleDetails">{{ row.item.title }}</b>
                            </template>

                            <template v-slot:cell(kvadrat_id)="row">
                                <b class="pointer" @click="row.toggleDetails">{{ row.item.kvadrat_id }}</b>
                            </template>

                            <template #row-details="row">

                                <b-row v-if="edit_message">

                                    <a href="#" @click="row.toggleDetails" class="nav-link text-sm "><img
                                        src="/images/icon-header/cancel.png" alt="закрыть"></a>

                                    <div class="col-sm-6 mt-2">
                                        <input v-on:keyup.enter="EditAdress(row.item)" class="form-control"
                                               v-model="field_for_edit_adress"
                                               placeholder="Переименуйте выбранный адресс">
                                    </div>

                                    <div class="col-sm-3 mt-1">
                                        <input v-on:keyup.enter="EditKvadrat(row.item)" class="form-control"
                                               v-model="field_for_edit_kvadrat"
                                               placeholder="Новый квадрат">
                                    </div>

                                    <a href="#" @click="deleteField_Adress(row.item)" class="nav-link text-sm "><img
                                        src="/images/not_user/delete.png" alt="удалить"></a>

                                </b-row>

                                <div v-if="before_delete_message">
                                    <b-alert variant="danger" show>
                                        <b-spinner small label="Spinning"></b-spinner>
                                        Аддресс удалется !!!
                                    </b-alert>
                                </div>

                            </template>

                        </b-table>

                        <!--<b-form-select class="numPerPage" v-model="perPage" :options="pageOptions"></b-form-select>-->


                        <b-pagination
                            :total-rows="totalRows_for_adress"
                            v-model="currentPage"
                            :per-page="perPage"
                            align="fill"
                            class="my-0 mt-4"
                            aria-controls="my-table"
                        ></b-pagination>


                    </b-jumbotron>

                </div>


                <!------------------------------------------------------- Racion ---------------------------------------------------------------->

                <div class="info jumbotrons" v-if="ifThisRoute_addRacion">
                    <b-jumbotron bg-variant="light" header="" lead="Список рационов" border-variant="danger"
                                 class="jumbotron">

                        <ul class="navbar-nav mr-auto tracking-widest rol">

                            <li>
                                <a href="#" @click.prevent="loGout"> <img
                                    class="avatar_exit float-right" src="/images/not_user/f.png"></a>
                            </li>

                            <li> Количество записей в таблице: {{ this.totalRows_for_racion }}</li>
                        </ul>

                        <b-table
                            id="my-table"
                            stacked="md"
                            hover
                            :fields="fields_for_racion"
                            sticky-header="false"
                            :items="AllRacion"
                            :per-page="perPage"
                            :current-page="currentPage"
                            :sort-by.sync="sortBy"
                            :sort-desc.sync="sortDesc">

                            <template #cell(№)="data">
                                {{ data.index + 1 }}
                            </template>

                            <template v-slot:cell(name)="row">
                                <b class="pointer" @click="row.toggleDetails">{{ row.item.name }}</b>
                            </template>

                            <template #row-details="row">

                                <b-row v-if="edit_message">

                                    <a href="#" @click="row.toggleDetails" class="nav-link text-sm "><img
                                        src="/images/icon-header/cancel.png" alt="закрыть"></a>

                                    <div class="col-sm-7 ml-5 mt-2">
                                        <input v-on:keyup.enter="EditRacion(row.item)" class="form-control"
                                               v-model="field_for_edit_racion"
                                               placeholder="Переименуйте выбранный рацион">
                                    </div>

                                    <a href="#" @click="deleteField_Racion(row.item)" class="nav-link text-sm "><img
                                        src="/images/not_user/delete.png" alt="удалить"></a>

                                </b-row>

                                <div v-if="before_delete_message">
                                    <b-alert variant="danger" show>
                                        <b-spinner small label="Spinning"></b-spinner>
                                        Рацион удалется !!!
                                    </b-alert>
                                </div>

                            </template>

                        </b-table>


                        <b-pagination
                            :total-rows="totalRows_for_racion"
                            v-model="currentPage"
                            :per-page="perPage"
                            align="fill"
                            class="my-0 mt-4"
                            aria-controls="my-table">

                        </b-pagination>

                    </b-jumbotron>
                </div>

                <!------------------------------------------------------- Racion End---------------------------------------------------------------->

            </div>
        </div>

    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {

    data() {

        return {
            title: '',
            racion: '',
            kvadrat_id: '',
            rout: '',
            field_for_edit_racion: '',
            field_for_edit_adress: '',
            field_for_edit_kvadrat: '',
            note_adress: false,
            note_racion: false,
            success: true,
            before_success: false,
            adress_table: true,
            edit_message: true,
            error: false,
            before_delete_message: false,

            perPage: 10,
            currentPage: 1,
            sortBy: "name",
            sortDesc: false,

            pageOptions: [5, 10, 20, 50, {
                value: Number.MAX_SAFE_INTEGER,
                text: "show all"
            }],

            fields_for_adress: [
                '№',
                {
                    key: 'title',
                    label: 'Адресс',
                },
                {
                    key: 'kvadrat_id',
                    label: '№ Квадрата',
                },
                {
                    key: 'created_at',
                    label: 'Дата создания',
                },
                // {
                //     key: 'updated_at',
                //     label: 'Время создания',
                // },
            ],

            fields_for_racion: [
                '№',
                {
                    key: 'name',
                    label: 'Название рациона',
                },
            ],
        }
    },

    created() {

        for (let i = 0; i < 1000; i++) {
            this.AllAdress.push({
                id: i + 1
            });
        }
    },

    mounted() {

        this.GetAllAdress()
        this.GetAllRacion()
    },

    computed: {
        ...mapGetters(['AllAdress', 'AllRacion']),

        ifThisRoute_addAdress() {
            if (this.$route.name === 'addAdress') {
                this.rout = 'addAdress'
                return true;
            }
        },

        ifThisRoute_addRacion() {
            if (this.$route.name === 'addRacion') {
                this.rout = 'addRacion'
                return true;
            }

        },

        totalRows_for_adress() {
            return this.AllAdress.length
        },

        totalRows_for_racion() {
            return this.AllRacion.length
        }
    },

    methods: {
        ...mapActions(['GetAllAdress', 'GetAllRacion']),

        EditRacion(row) {
            axios.post('api/v1/sendEditRacion', {
                field_id: row.id,
                field_name: 'name',
                field_value: this.field_for_edit_racion

            })
            .then((response) => {this.GetAllRacion(), this.field_for_edit_racion= ''})
        },

        EditAdress(row) {
            axios.post('api/v1/sendEditAdress', {
                field_id: row.id,
                field_name: 'title',
                field_value: this.field_for_edit_adress

            })
            .then((response) => {this.GetAllAdress(), this.field_for_edit_adress= ''})
        },

        EditKvadrat(row) {
            axios.post('api/v1/sendEditKvadrat', {
                field_id: row.id,
                field_name: 'kvadrat_id',
                field_value: this.field_for_edit_kvadrat

            })
            .then((response) => {this.GetAllAdress(), this.field_for_edit_kvadrat= ''})
        },

        SendData() {

            if (this.rout == 'addAdress') {
                if (this.title && this.kvadrat_id) {
                    axios.post('api/v1/addNewAdress', {

                        // title: this.title, kvadrat_id: this.kvadrat_id
                        title: this.title, kvadrat_id: this.kvadrat_id

                    }).then((response) => {

                        if (response.data === "Адресс записан") {

                            this.success = false
                            this.before_success = true

                            this.GetAllAdress()
                            this.title = ''
                            this.kvadrat_id = ''

                            setTimeout(() => {
                                this.success = true
                                this.before_success = false

                            }, 2000)

                        }
                    });

                } else {
                    this.adress_table = false
                    this.note_adress = true
                    this.success = false
                    this.error = true

                    setTimeout(() => {
                        this.note_adress = false
                        this.adress_table = true
                        this.success = true
                        this.error = false
                    }, 6000)

                }
            }

            if (this.rout == 'addRacion') {

                if (this.racion) {
                    axios.post('api/v1/addNewRacion', {

                        name: this.racion

                    }).then((response) => {

                        if (response.data === "Рацион создан") {

                            this.success = false
                            this.before_success = true

                            this.GetAllRacion()
                            this.racion = ''

                            setTimeout(() => {
                                this.success = true
                                this.before_success = false

                            }, 2000)

                        }
                    });

                } else {
                    this.adress_table = false
                    this.note_racion = true
                    this.success = false
                    this.error = true

                    setTimeout(() => {
                        this.note_racion = false
                        this.adress_table = true
                        this.success = true
                        this.error = false
                    }, 6000)

                }
            }
        },


                           //---------------------------------------------- Удаляем  -------------------------------------------------------------//

        deleteField_Racion(row) {

            const modalTimeoutSeconds = 7;
            const modalId = 'confirm-modal'
            let modalSetTimeout = null;

            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить  ( ' + row.name + ' ) ?', {
                id: modalId,
                size: 'lg',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: 'Да',
                cancelTitle: 'Нет',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
                .then(value => {

                    if (value === true) {

                        axios.delete('api/v1/racion/' + row.id ).then((response) => {

                            if (response.data === "Рацион удален") {

                                this.edit_message = false
                                this.before_delete_message = true

                                setTimeout(() => {

                                    this.edit_message = true
                                    this.GetAllRacion()
                                    this.before_delete_message = false

                                }, 2000)

                            }
                        });

                    }
                })

            modalSetTimeout = setTimeout(() => {
                this.$bvModal.hide(modalId)
            }, modalTimeoutSeconds * 1000)
        },


        deleteField_Adress(row) {

            const modalTimeoutSeconds = 7;
            const modalId = 'confirm-modal'
            let modalSetTimeout = null;


            this.$bvModal.msgBoxConfirm('Вы уверены что хотите удалить  ( ' + row.title + ' ) ?' , {
                id: modalId,
                size: 'lg',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: 'Да',
                cancelTitle: 'Нет',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
                .then(value => {

                    if (value === true) {

                        axios.delete('api/v1/getAdress/' + row.id ).then((response) => {

                            if (response.data === "Адресс удален") {

                                this.edit_message = false
                                this.before_delete_message = true

                                setTimeout(() => {

                                    this.edit_message = true
                                    this.GetAllAdress()
                                    this.before_delete_message = false

                                }, 2000)

                            }
                        });

                    }
                })

            modalSetTimeout = setTimeout(() => {
                this.$bvModal.hide(modalId)
            }, modalTimeoutSeconds * 1000)
        },

        loGout() {
            axios.post("/logout").then(response => {
                window.location.replace("/");

            });
        },


    },


}

</script>

<style scoped>

.personal {
    /*color: whitesmoke;*/
    color: red;
}

.info {
    margin-left: 60px;
}

.avatar_1 {
    width: 30px;
    height: 30px;
}

.avatar_exit {
    width: 50px;
    height: 50px;
}

.avatar img {
    width: 100%;
    height: 100%;
}

.jumbotrons {
    width: 750px;
    height: 870px;
}
.test {
    margin-top: 150px;
    width: 300px;
    /*height: 870px;*/
}

.otstup_forma {
    margin-top: 100px;
}

.pointer {
    cursor: pointer;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 30%, 0);
        -ms-transform: translate3d(0, 30%, 0);
        transform: translate3d(0, 30%, 0);
    }
    100% {
        opacity: 1;
        -webkit-transform: none;
        -ms-transform: none;
        transform: none;
    }
}

.fadeInUp {
    animation-name: fadeInUp;
    animation-timing-function: ease-out;
}

</style>
