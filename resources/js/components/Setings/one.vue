<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">

                  <!-- Modal -->
                    <edit-roles @get-method="clearTableWhenExitModal" ref="getmodal"></edit-roles>

                <b-form-input

                    v-model="value"
                    placeholder="Добавить новую должность"
                     v-on:keydown.enter ="addNewRole">

                </b-form-input>

            </div>

            <div class="row">
                <div class="col-md-8 mt">

                    <b-table
                        :items="roles"
                        :fields="fields"
                        
                        :no-border-collapse="noCollapse"
                        :striped="striped"
                        :bordered="bordered"
                        :borderless="borderless"
                        :outlined="outlined"
                        :small="small"
                        :hover="hover"
                        :dark="dark"
                        :fixed="true"
                    >

                        <!-- <at-popover placement="top" v-model="show" @toggle="toggleShow">
                            <at-button size="small">Delete</at-button>
                            <template slot="content">
                                <p>This is part of the content, sure to delete it?</p>
                                <div style="text-align: right; margin-top: 8px;">
                                    <at-button size="smaller" @click="show = false">Cancel</at-button>
                                    <at-button type="primary" size="smaller" @click="show = false">Sure</at-button>
                                </div>

                                 selectable
                        :select-mode="single"
                        @row-selected="onRowSelected"

                            </template>
                        </at-popover> -->


              <template v-slot:cell(selected)="row">
                   <b-form-group>
                    
                        <button class="pading_button"> <b-icon icon="pencil-square" @click="rowSelectedForUpdate(row.item.title)" ></b-icon> </button>
                         <button> <b-icon  icon="trash" @click="rowSelectedForDelete(row)"></b-icon>  </button>
                    </b-form-group>
               </template>

    <!-- <template v-slot:cell(selected)="{rowSelected}">
            
                    <b-form-group> 
                       <button> <b-icon  icon="pencil-square" ></b-icon> </button>
                         <button> <b-icon  icon="trash" @click="rowSelected"></b-icon>  </button>
                    </b-form-group>
    </template> -->
    <!-- <template v-slot:cell(checkbox)="row" style="border-left='5px dotted blue'">                      
       <input type="checkbox" v-model="row.rowSelected" @input="toggleSelectRow(row)"/>             
    </template> -->

<!-- Выводим упорядоченный Index для полейё -->
      <template v-slot:cell(index)="data">
        {{ data.index + 1 }}
      </template>




                    </b-table>


                </div>

                <div class="col-md-2 mti">
                    <b-form-group label="Настройка таблицы" label-cols-lg="2" v-slot="{ ariaDescribedby }">
                        <b-form-checkbox v-model="striped" :aria-describedby="ariaDescribedby" inline>Striped</b-form-checkbox>
                        <b-form-checkbox v-model="bordered" :aria-describedby="ariaDescribedby" inline>Bordered</b-form-checkbox>
                        <b-form-checkbox v-model="borderless" :aria-describedby="ariaDescribedby" inline>Borderless</b-form-checkbox>
                        <b-form-checkbox v-model="outlined" :aria-describedby="ariaDescribedby" inline>Outlined</b-form-checkbox>
                        <b-form-checkbox v-model="small" :aria-describedby="ariaDescribedby" inline>Small</b-form-checkbox>
                        <b-form-checkbox v-model="hover" :aria-describedby="ariaDescribedby" inline>Hover</b-form-checkbox>
                        <b-form-checkbox v-model="dark" :aria-describedby="ariaDescribedby" inline>Dark</b-form-checkbox>
                        <b-form-checkbox v-model="noCollapse" :aria-describedby="ariaDescribedby" inline>Border</b-form-checkbox>
                    </b-form-group>
                </div>


            </div>

        </div>


    </div>
</template>

<script>

export default {

    data() {
        return {

            roles: {},
            value: '',
            user: {},
          
            fields:[

                'index',

                // {
                //     key: 'id',
                //     label: 'Индекс',
                // },

                {
                    key: 'title',
                    label: 'Должность',
                },

                {
                    key: 'selected',
                    label: 'Редактировать',
                }
            ],

            striped: false,
            bordered: false,
            borderless: false,
            outlined: false,
            small: false,
            hover: false,
            dark: false,
            headVariant: null,
            tableVariant: '',
            noCollapse: false,



        }

    },

    mounted() {
        this.getRoles()
     
    },

    methods:{

        getRoles(){
            axios.get('api/v1/getRoles')
            .then(response => {this.roles = response.data.data;})

        },


        addNewRole(){
            axios.post('api/v1/roles', {title: this.value})
            this.value = ''
            this.getRoles()
        },

         rowSelectedForUpdate(row) {
             this.$refs.getmodal.ShowModalEditRoles(row)      
      },

      rowSelectedForDelete(row){
                // this.$confirm("Удалить сотрудника " + surname + " ?").then(() => {
                //     this.users.splice(index,1);
                //     axios.delete('api/v2/users/'+ id);
                // });
                alert("Да это модальное окно работает");
    }
    }


}

</script>

<style>

.mt{
    margin-top: 20px;
    /*width: 600px;*/
}
.mti{
    margin-top: 5%;
    margin-left: 5%;
}
.pading_button{
    padding-left:35%;
    border: 0px;
}
</style>
