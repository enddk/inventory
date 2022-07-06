<template>
    <div class="border p-5">
        <h2>login</h2>
        <p class="text-danger">{{error}}</p>
        <input type="text" v-model="email" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_email">メールアドレスを入力してください</p>
        <input type="password" v-model="password" class="form-control mb-3">
        <p class="text-start text-danger" v-if="val_password">パスワードを入力してください</p>
        <div class="d-grid">
            <button type="submit"  @click="login()" class="btn btn-primary">submit</button>
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
            val_email: false,
            val_password: false,
            error: '',
        }
    },
    computed: {

    },
    methods: {
        login() {
            if(this.valid()){
                console.log('送信できません');
            } else {
                var self = this;
                const form = new URLSearchParams();
                form.append('email', self.email);
                form.append('password', self.password);
                axios.post('https://www.inventory-json.com/inventory/public/login', form, { 
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                    },
                })
                .then((response) => {
                    self.$store.commit('login', response.data[0].id)
                    self.$router.push('/');
                })
                .catch((error) => {
                    self.error = 'メールアドレスまたはパスワードが正しくありません';
                })
            }
        },
        valid(){
            var check = 0;
            
            if(this.email.length <= 0){
                this.val_email = true;
                check += 1;
            } else {
                this.val_email = false;
            }
            if(this.password.length <= 0){
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