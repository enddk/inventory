<template>
    <div class="border p-5">
        <h2>signin</h2>
        <input type="text" v-model="name" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_name">名前を入力してください。</p>
        <input type="text" v-model="email" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_email">メールアドレスを入力してください。</p>
        <input type="password" v-model="password" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_password">パスワードを入力してください。４文字以上です。</p>
        <div class="d-grid">
            <button type="submit"  @click="signin()" class="btn btn-primary">submit</button>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import axios from 'axios'

export default {
    name: 'Detail',
    props: {
        
    },
    data() {
        return {
            datas: [],
            name: '',
            email: '',
            password: '',
            val_name: false,
            val_email: false,
            val_password: false,
        }
    },
    computed: {

    },
    methods: {
        signin() {
            if(this.valid()){
                console.log('送信できません');
            } else {
                var self = this;
                const form = new URLSearchParams();
                form.append('name', self.name);
                form.append('email', self.email);
                form.append('password', self.password);
                axios.post('https://www.inventory-json.com/inventory/public/signin', form, { 
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then(function(response) {
                    alert('ユーザー登録しました。引き続きログインしてください。');
                    self.$router.push('/login');
                })
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
            if(this.password.length <= 4){
                this.val_password = true;
                check += 1;
            }else {
                this.val_password = false;
            }

            if(check > 0){
                return true;
            }
        },
    },
    mounted() {
        if(this.$store.state.user_id != 0){
            this.$router.push('/');
        }
    }
}
</script>