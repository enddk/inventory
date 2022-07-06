<template>
    <h1 class="col-12 text-start p-3 mb-4" style="background-color:#fff;">Home</h1>
    <div class="col-10 border p-3" style="background-color:#fff;">
        <div class="form-row">
            <div class="col-auto">
                <input type="text" class="form-control" v-model="keyword">
            </div>
        </div>
        <div class="pt-3">
            <div class="row border p-3" v-for="data in search">
                <img :src="url + data.image" style="width:40px; height:40px;" class="col-2">
                <p class="col mt-2">{{ data.title }}</p>
                <p class="col mt-2">{{ data.num }}</p>
                <router-link :to="/detail/ + data.id" class="col">
                    <button class="col btn btn-primary">detail</button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import axios from 'axios'

export default {
    name: 'Home',
    props: {

    },
    data() {
        return {
            datas: [],
            url: 'https://sample-bucket-inventory.s3.ap-northeast-1.amazonaws.com/',
            keyword: '',
        }
    },
    computed: {
        search(){
            var datas = [];

            for(var i in this.datas) {
                var data = this.datas[i];

                if(data.title.indexOf(this.keyword) !== -1) {
                    datas.push(data);
                }
            }

            return datas;
        }
    },
    methods: {

    },
    mounted() {
        if(this.$store.state.user_id == 0){
            this.$router.push('/login');
        } else {
            var self = this;
            axios.get('https://www.inventory-json.com/inventory/public/index?user_id='+self.$store.state.user_id)
            .then(function(response) {
                console.log(response.data);
                self.datas = response.data;
            })
        }
    }
}
</script>