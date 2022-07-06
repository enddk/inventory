<template>
    <h1 class="col-12 text-start p-3 mb-4" style="background-color:#fff;">User</h1>
    <div  class="col-10 border p-3" style="background-color:#fff;">
        <p>{{ id }}</p>

        <ul class="list-inline">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-start m-0">your name</p> 
                    <h3>{{ name }}</h3> 
                </div>
                <p>
                    <button class="btn btn-primary" @click="editChange(1)" v-if="change_name == false">edit</button>
                    <button class="btn btn-info" @click="editChange(1)" v-else>close</button>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-start m-0">your email</p> 
                    <h3>{{ email }}</h3> 
                </div>
                <p>
                    <button class="btn btn-primary" @click="editChange(2)" v-if="change_email == false">edit</button>
                    <button class="btn btn-info" @click="editChange(2)" v-else>close</button>
                </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-start m-0">your password</p> 
                    <h3>{{ password }}</h3> 
                </div>
                <p>
                    <button class="btn btn-primary" @click="editChange(3)" v-if="change_password == false">edit</button>
                    <button class="btn btn-info" @click="editChange(3)" v-else>close</button>
                </p>
            </li>
        </ul>
        
        <div v-if="change_name == true">
            <label class="text-start px-1">your name</label>
            <input type="text" v-model="name" class="form-control mb-3">
            <p class="text-start text-danger" v-if="val_name">名前を入力してください。</p>
        </div>

        <div v-if="change_email == true">
            <label class="text-start px-1">your email</label>
            <input type="text" v-model="email" class="form-control mb-3">
            <p class="text-start text-danger" v-if="val_email">メールアドレスを入力してください。</p>
        </div>

        <div v-if="change_password == true">
            <label class="text-start px-1">your password</label>
            <input type="password" v-model="password" class="form-control mb-3">
            <p class="text-start text-danger" v-if="val_password">パスワードを入力してください。４文字以上です。</p>
        </div>

        <div class="justify-content-between" v-if="change_name == true || change_email == true || change_password == true">
            <button @click="update()" class="btn btn-primary col-2">edit</button>
        </div>
        <div class="justify-content-between" v-else>
            <button @click="update()" class="btn btn-primary col-2" disabled>edit</button>
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
                name: '',
                email: '',
                password: '',
                change_name: false,
                change_email: false,
                change_password: false,
                val_name: false,
                val_email: false,
                val_password: false,
            }
        },
        computed: {

        },
        methods: {
            update(){
                if(this.valid()){
                    console.log('送信できません');
                } else {
                    var self = this;
                    const form = new FormData();
                    form.append('id', this.$store.state.user_id);
                    form.append('name', this.name);
                    form.append('email', this.email);
                    form.append('password', this.password);
                    axios.post('https://www.inventory-json.com/inventory/public/user/update', form)
                    .then(function(response) {
                        self.$router.push('user');
                    }) 
                }
            },
            editChange(key){
                if(key == 1){
                    if(this.change_name){
                        this.change_name = false;
                    } else {
                        this.change_name = true;
                    }
                } else if(key == 2) {
                    if(this.change_email){
                        this.change_email = false;
                    } else {
                        this.change_email = true;
                    }
                } else if(key == 3) {
                    if(this.change_password){
                        this.change_password = false;
                    } else {
                        this.change_password = true;
                    }
                }
            },
            valid(){
                var check = 0;
                
                if(this.name.length <= 0){
                    this.val_name = true;
                    check += 1;
                } else {
                    this.val_name = false;
                }

                const reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);
        
                if(this.email.length <= 0 || !reg.test(this.email)){
                    this.val_email = true;
                    check += 1;
                } else {
                    this.val_email = false;
                }
                
                if(this.password.length > 0 && this.password.length <= 4){
                    this.val_password = true;
                    check += 1;
                } else {
                    this.val_password = false;
                }

                if(check > 0){
                    return true;
                }
            },
        },
        mounted() {
             if(this.$store.state.user_id == 0){
                this.$router.push('/login');
            } else {
                var self = this;
                axios.get('https://www.inventory-json.com/inventory/public/useredit?id='+self.$store.state.user_id)
                .then(function(response) {
                    console.log(response.data);
                    self.name = response.data.name;
                    self.email = response.data.email;
                });
            }
        }
    }
</script>