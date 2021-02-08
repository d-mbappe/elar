<template>
    <div class="login">

        <form @submit.prevent="login">
            <InputCustom v-model="email" name="Ваш логин" isRequired="true" helper=""/>
            <InputCustom v-model="password" name="Ваш пароль" isRequired="true" isType="password" helper="Минимум 6 символов"/>

            <button type="submit" class="login-btn">
                Войти
            </button>
        </form>

    </div>

</template>

<script>
    import InputCustom from "./simple/InputCustom";

    export default {
        name: "Login",
        components: {InputCustom},
        data() {
            return{
                email: '',
                password: ''
            }
        },

        methods: {
            login: function () {
                let email = this.email;
                let password = this.password;

                this.$store.dispatch('login', { email, password })
                    .then(() => this.$router.push('/main'))
                    .catch(err => console.log(err))
            }
        }

    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";


    .login-btn {
        border:none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        /**/
        cursor: pointer;
        margin-top: 15px;

        width: 100%;
        background: $white;

        min-height: 50px;

        font-family: 'Roboto Slab', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: $black;
        text-align: center;

        border-radius: 5px;

    &:hover {
         box-shadow: 0 0 10px rgba(0,0,0,0.4) inset;
     }

    &:active, &:focus {
                   box-shadow: 0 0 10px rgba(0,0,0,0.8) inset;

               }
    }
</style>
