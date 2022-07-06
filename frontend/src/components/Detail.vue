<template>
    <h1 class="col-12 text-start p-3 mb-4" style="background-color:#fff;">detail</h1>
    <div class="col-10 border p-3" style="background-color:#fff;">
        <p>{{ id }}</p>
        <div class="text-center mb-5">
            <img :src="url" class="card-img-top" style="width:200px; height:200px;">
        </div>
        <input type="file" @change="fileSelected" class="form-control mb-3">
        <input type="text" v-model="title" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_title">タイトルを入力してください</p>
        <input type="number" v-model="number" class="form-control mb-3">
        <div>
            <button @click="update()" class="btn btn-primary float-start">edit</button>
            <button @click="del()" class="btn btn-danger float-end">delete</button>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import axios from 'axios'

export default {
    name: 'Detail',
    props: {
        id: Number,
    },
    data() {
        return {
            datas: [],
            title: '',
            number: 0,
            image: '',
            url: 'https://sample-bucket-inventory.s3.ap-northeast-1.amazonaws.com/',
            val_title: false,
        }
    },
    computed: {

    },
    methods: {
        fileSelected(event){
            this.image = event.target.files[0];
        },
        update(){
            if(this.valid()){
                console.log('送信できません');
            } else {
                var self = this;
                const form = new FormData();
                form.append('id', this.id);
                form.append('title', this.title);
                form.append('num', this.number);
                form.append('image', this.image);
                axios.post('https://www.inventory-json.com/inventory/public/items/update', form, { 
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then(function(response) {
                    self.$router.push('/');
                })
            }
        },
        del(){
            if (window.confirm("データを削除します。よろしいですか？")) {
                var self = this;
                axios.delete('https://www.inventory-json.com/inventory/public/item/'+this.id);
                self.$router.push('/');
            }
        },
        valid(){
            if(this.title.length <= 0){
                this.val_title = true;
                return true;
            } else {

            }
        },
    },
    mounted() {
        if(this.$store.state.user_id == 0){
            this.$router.push('/login');
        } else {
            var self = this;
            axios.post('https://www.inventory-json.com/inventory/public/itemedit/'+this.id)
            .then(function(response) {
                console.log(response.data.title);
                self.title = response.data.title;
                self.number = response.data.num;
                self.url = self.url + response.data.image;
            });
        }
    }
}
</script>