<template>
    <div class="login">

        <form @submit.prevent="login">
            <!--Убирает автвозаполнение полей-->
            <div style="width: 0; height: 0; overflow: hidden"><input type="text"><input type="password"></div>
            <InputCustom v-model.trim="email"
                         name="Ваш логин"
                         isRequired="true"
                         helper=""
                         :isInvalid=" (!$v.email.required || !$v.email.email)"
            />

            <InputCustom v-model.trim="password"
                         name="Ваш пароль"
                         isRequired="true"
                         isType="password"
                         :autocomplete="'off'"
                         helper="Минимум 6 символов"
                         :isInvalid="!$v.password.required || !$v.password.minLength"
            />

            <div class="login__social">
                <p class="login__social__title">Войти через соцсети:</p>

                <a :href="socialURL[0].url"><img class="login__social__icon" src="../assets/icons/vk-logo.svg" alt=""></a>
                <a :href="socialURL[2].url"><img class="login__social__icon" src="../assets/icons/facebook-logo.svg" alt=""></a>
                <a :href="socialURL[1].url"><img class="login__social__icon" src="../assets/icons/ok-logo.svg" alt=""></a>
            </div>

            <button :disabled=" $v.$invalid" type="submit" class="login-btn">
                Войти
            </button>

        </form>


    </div>

</template>

<script>
    import InputCustom from "./simple/InputCustom";
    import {AXIOS} from "../store/axios";
    import {email, required, minLength } from 'vuelidate/lib/validators'


    export default {
        name: "Login",
        components: {InputCustom},
        data() {
            return{
                email: '',
                password: '',
                social: ['vk', 'ok', 'facebook'],
                socialURL: [{
                    name: 'vk',
                    url: null
                }, {
                    name: 'ok',
                    url: null
                }, {name: 'facebook',
                    url: null }
                ],

            }
        },

        validations: {
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(6)
            }
        },

        computed: {

        },

        methods: {
            async getUrl(social) {
                 AXIOS.get('/api/' + social.name + '/get-auth-link')
                        .then(resp => {
                            social.url = resp.data
                        })
                        .catch(err => {
                            reject(err)
                        })
            },

            login: function () {
                let email = this.email;
                let password = this.password;

                this.$store.dispatch('login', { email, password })
                    .then( res => {
                        console.log(res)

                        if(res.status === 200) {
                            this.$store.dispatch('getUser');
                            this.$router.push('/account')
                        }
                    })
                    .catch(err => console.log(err))
            }
        },
        async mounted() {
            /*Логика для авторизации через соцсети*/
            await this.$store.commit('get_user')
            await this.$store.commit('set_auth_token')

            if(localStorage.token && this.$store.state.tmp_access_token) {
                window.location.href = 'account';
                this.$store.state.auth_social = true;
            }
        },

        created() {
            this.socialURL.forEach( item => this.getUrl(item))
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
        cursor: pointer;
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
