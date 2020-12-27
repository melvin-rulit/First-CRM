<template>

<!-- Компонент Sitebar -->

  <div>
    <b-button v-b-toggle.sidebar-no-header>Menu</b-button>
    <b-sidebar id="sidebar-no-header" aria-labelledby="sidebar-no-header-title" no-header shadow >
      <template #default="{ hide }">
        <div class="p-3">
          <h4 id="sidebar-no-header-title">Custom header sidebar</h4>
          <p>
            Cras mattis consectetur purus sit amet 
          </p>
          <nav class="mb-3">
            <b-nav vertical>
                 <router-link to="/users" class="nav-link">Fuck</router-link>
                 <router-link to="/callendar" class="nav-link">VCalendar</router-link>
                 <router-link to="/vcallendar" class="nav-link">Calendar</router-link>
            </b-nav>
          </nav>
          <b-button variant="primary" block @click="hide">Close</b-button>
        </div>
                <a href="#" @click.prevent="loGout()">
            <b-button variant="outline-info" class="mb-2">
                <b-icon icon="power" aria-hidden="true"></b-icon>Logout
            </b-button>
        </a>

      </template>
    </b-sidebar>
  </div>

   
</template>

<script>
    export default {


        methods: {

            loGout() {

                axios.post("/logout").then(response => {

                  window.location.replace("/");
         
                });
            }
        }
    }

</script>
