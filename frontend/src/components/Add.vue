<template>
    <h2 class="col-12 text-start p-3 mb-4" style="background-color:#fff;">Add item</h2>
    <div class="col-10 border p-3" style="background-color:#fff;">
        <input type="file" @change="fileSelected" class="form-control mb-3">
        <p style="font-size:8px;" class="text-start">※2MBまでです。</p>
        <p class="text-start text-danger" v-if="val_image">画像が大きすぎます</p>
        <input type="text" v-model="title" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_title">タイトルを入力してください</p>
        <input type="number" v-model="number" class="form-control mb-3">
        <div class="d-grid">
            <button type="submit"  @click="post()" class="btn btn-primary">submit</button>
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
            title: '',
            number: 0,
            image: null,
            val_title: false,
            val_image: false,
        }
    },
    computed: {
        
    },
    methods: {
        fileSelected(event){
            this.image = event.target.files[0];
        },
        post(){
            if(this.valid()){
                console.log('送信できません');
            } else {
                var self = this;
                const form = new FormData();
                form.append('user_id', self.$store.state.user_id);
                form.append('title', this.title);
                form.append('num', this.number);
                form.append('image', this.image);
                axios.post('https://www.inventory-json.com/inventory/public/items', form, {
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then(function(response) {
                    self.$router.push('/');
                })
            }
        },
        valid(){
            var check = 0;

            if(this.title.length <= 0){
                this.val_title = true;
                check+=1;
            } else {
                this.val_title = false;
            }
            if(this.image.size > 2000000){
                this.val_image = true;
                check+=1;
            } else {
                this.val_image = false;
            }

            if(check > 0){
                return true;
            }
        },
    },
    mounted() {
        if(this.$store.state.user_id == 0){
            this.$router.push('/login');
        } 
    }
}
</script>