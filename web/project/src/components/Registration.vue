<template>
    <form @submit.prevent="register">
        <InputCustom v-model="user.email" name="Ваш email" isRequired="true" helper="" />
        <InputCustom v-model="user.telephone" name="Ваш телефон" data="" />
        <InputCustom v-model="user.password" name="Ваш пароль" data="" isRequired="true" isType="password" helper="Минимум 6 символов"/>
        <InputCustom v-model="user.confirmPass" name="Подтвердите пароль" data="" isRequired="true" isType="password" />
        <InputCustom v-model="user.birthday" name="Дата рождения" data="дд.мм.гг" isRequired="" />
        <InputCustom v-model="user.name" name="Ваше имя" data="" isRequired="true" />
        <InputCustom v-model="user.surname" name="Ваша фамилия" data="" isRequired="true" />
        <InputCustom v-model="user.patronymic" name="Ваше отчество" data="" isRequired="true" />

        <div class="registration__policy">
            Нажимая на кнопку «зарегистрироваться», вы даёте согласие на <a href="#" class="registration__policy-link">обработку персональных данных</a>
        </div>

        <button type="submit" class="registration-btn">
            Зарегистрироваться
        </button>

    </form>
</template>

<script>
    import InputCustom from "./simple/InputCustom";
    export default {
        name: "Registration",
        components: {InputCustom},

        data() {
            return {
                user: {
                    email: '',
                    telephone: '',
                    password: '',
                    confirmPass: '',
                    birthday: '',
                    name: '',
                    surname: '',
                    patronymic: '',
                }
            }
        },

        methods: {
            register() {
                let newUser = this.user
                this.$store.dispatch('register', newUser)
                    .then(() => this.$router.push('/main'))
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";

    .registration__policy {
        margin-top: 30px;

        font-size: 14px;
        color: $white;

        &-link {
            font-weight: 700;
            text-decoration: underline;
        }
    }
    .registration-btn {
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
