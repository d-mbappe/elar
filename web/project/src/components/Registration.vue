<template>
    <form @submit.prevent="register">
        <!--Убирает автвозаполнение полей-->
        <div style="width: 0; height: 0; overflow: hidden"><input type="text"><input type="password"></div>

        <InputCustom v-model.trim="user.email" name="Ваш email" isRequired="true" helper=""
                     :isInvalid="!$v.user.email.required || !$v.user.email.email"
        />
        <InputCustom v-model.trim="user.phone" name="Ваш телефон" data=""
                     :isInvalid="!$v.user.phone.numeric"
        />
        <InputCustom v-model.trim="user.password" name="Ваш пароль" data="" isRequired="true" isType="password" helper="Минимум 6 символов"
                     :isInvalid="!$v.user.password.required || !$v.user.password.minLength"
        />
        <InputCustom v-model.trim="user.passwordRepeat" name="Подтвердите пароль" data="" isRequired="true" isType="password"
                     :isInvalid="!$v.user.passwordRepeat.required || !$v.user.passwordRepeat.sameAs"
        />
        <InputCustom v-model.trim="user.birthdate" name="Дата рождения" data="дд.мм.гг" isRequired="" isType="date"
        />
        <InputCustom v-model.trim="user.name" name="Ваше имя" data="" isRequired="true"
                     :isInvalid="!$v.user.name.required || !$v.user.name.text && !$v.user.name.alpha"
        />
        <InputCustom v-model.trim="user.surname" name="Ваша фамилия" data="" isRequired="true"
                     :isInvalid="!$v.user.surname.required || !$v.user.surname.text && !$v.user.surname.alpha"
        />
        <InputCustom v-model.trim="user.patronymic" name="Ваше отчество" data="" isRequired=""
                     :isInvalid="!$v.user.patronymic.text && !$v.user.patronymic.alpha"
        />

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
    import {email, required, minLength, numeric, sameAs, alpha } from 'vuelidate/lib/validators'

    import { helpers } from 'vuelidate/lib/validators'
    const text = helpers.regex('text', /^[а-яА-ЯёЁa-zA-Z]+$/i)



    export default {
        name: "Registration",
        components: {InputCustom},

        data() {
            return {
                user: {
                    email: '',
                    phone: '',
                    password: '',
                    passwordRepeat: '',
                    birthdate: '',
                    name: '',
                    surname: '',
                    patronymic: '',
                }
            }
        },

        validations: {
            user: {
                email: {
                    required,
                    email
                },
                phone: {
                    numeric
                },
                password: {
                    required,
                    minLength: minLength(6)

                },
                passwordRepeat: {
                    required,
                    minLength: minLength(6),
                    sameAs: sameAs('password')
                },
                name: {
                    required,
                    text,
                },
                surname: {
                    required,
                    text,
                },
                patronymic: {
                    text,
                },
            }

        },

        methods: {
            register() {
                let newUser = this.user;

                this.$store.dispatch('register', newUser)
                    .then( res => {
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
