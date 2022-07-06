<template>
  <ul class="nav fixed-top border p-2" style="background-color: #fff;">
    <li class="nav-item" v-if="this.$store.state.user_id != 0">
      <router-link to="/" class="nav-link">
        home
      </router-link>
    </li>
    <li class="nav-item" v-if="this.$store.state.user_id != 0">
      <router-link to="/add" class="nav-link">
        add
      </router-link>
    </li>
    <li class="nav-item" v-if="this.$store.state.user_id == 0">
      <router-link to="/login" class="nav-link">
        login
      </router-link>
    </li>
    <li class="nav-item" v-if="this.$store.state.user_id == 0">
      <router-link to="/signin" class="nav-link">
        signin
      </router-link>
    </li>
    <li class="nav-item" v-if="this.$store.state.user_id != 0">
      <router-link to="/user" class="nav-link">
        user
      </router-link>
    </li>
    <li class="nav-item" v-if="this.$store.state.user_id != 0">
      <button @click="logout()" class="nav-link btn">
        logout
      </button>
    </li>
  </ul>
  
  <router-view></router-view>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import { ref, reactive } from 'vue'
import axios from 'axios'

export default {
    name: '',
    props: {
      
    },
    data() {
        return {
          title: '',
          number: null,
          image: '',
        }
    },
    computed: {
        
    },
    methods: {
      logout(){
        var self = this;
        self.$store.commit('logout');
        this.$router.push('/login');
      }
    },
    mounted() {
        
    }
}
</script>
