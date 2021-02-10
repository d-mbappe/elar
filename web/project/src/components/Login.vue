<template>
    <div class="login">

        <form @submit.prevent="login">
            <InputCustom v-model="email" name="Ваш логин" isRequired="true" helper=""/>
            <InputCustom v-model="password" name="Ваш пароль" isRequired="true" isType="password" :autocomplete="'on'" helper="Минимум 6 символов"/>


            <div class="login__social">
                <p class="login__social__title">Войти через соцсети:</p>

                <a :href="baseURL + 'vk/get-auth-link'"><img class="login__social__icon" src="../assets/icons/vk-logo.svg" alt=""></a>
                <a :href="baseURL + 'ok/get-auth-link'"><img class="login__social__icon" src="../assets/icons/ok-logo.svg" alt=""></a>
                <a :href="baseURL + 'facebook/get-auth-link'"><img class="login__social__icon" src="../assets/icons/facebook-logo.svg" alt=""></a>
            </div>

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
                password: '',
                baseURL: this.$http.defaults.baseURL

            }
        },

        methods: {
            login: function () {
                let email = this.email;
                let password = this.password;
                console.log( { email, password })

                this.$store.dispatch('login', { email, password })
                    .then( res => {
                        console.log(res)
                        if(res.status === 200) {
                            this.$store.dispatch('getUser');
                            this.$router.push('/main')
                        }
                    })
                    .catch(err => console.log(err))
            }
        }

    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";


    img {
        width: 20px;
    }
    .login {
        color: $white;
    }

    .login__social {
        margin-top: 25px;
        display: flex;
        align-items: center;

        &__icon {
            margin-left: 7px;

            &:hover {
                opacity: 0.8;
            }
        }
    }

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
