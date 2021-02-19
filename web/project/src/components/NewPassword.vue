<template>
    <div class="password__modify">

        <div class="password__modify__title">Смена пароля</div>

        <div class="password__modify__form">
            <form id="profileForm" class="password__modify__form__data">
                <InputCustom v-model.trim="oldPassword"
                             name="Старый пароль"
                             data=""
                             isType="password"
                             isRequired=""
                             :isInvalid=" (!$v.oldPassword.required || !$v.oldPassword.minLength)"
                />
                <InputCustom v-model.trim="profile.password"
                             name="Новый пароль"
                             data=""
                             isType="password"
                             isRequired=""
                             :isInvalid=" (!$v.profile.password.required || !$v.profile.password.minLength)"
                />
                <InputCustom v-model.trim="profile.passwordRepeat"
                             name="Повтор пароля"
                             isType="password"
                             data=""
                             isRequired=""
                             :isInvalid=" (!$v.profile.passwordRepeat.required || !$v.profile.passwordRepeat.sameAs ||!$v.profile.passwordRepeat.minLength)"
                />
            </form>
        </div>

        <button :disabled=" $v.$invalid" class="password__modify__footer-info__save-btn" @click="resetPassword">
            Сохранить
        </button>

    </div>
</template>

<script>
    import InputCustom from "./simple/InputCustom";
    import {minLength, required, sameAs} from "vuelidate/lib/validators";

    export default {
        name: "NewPassword",
        components: { InputCustom },

        data() {
            return {
                oldPassword: ''
            }
        },

        validations: {
            oldPassword: {
                required,
                minLength: minLength(6)
            },
            profile: {
                password: {
                    required,
                    minLength: minLength(6)
                },
                passwordRepeat: {
                    required,
                    minLength: minLength(6),
                    sameAs: sameAs('password')
                }
            }

        },

        mounted() {
            this.$store.dispatch('getUser')
        },



        computed: {
            profile() {
                return this.$store.state.profile
            }
        },

        methods: {
            resetPassword() {
                this.$store.dispatch('resetPassword', {oldPassword: this.oldPassword, newPassword: this.profile.password, newPasswordRepeat: this.profile.passwordRepeat } ).then()

                this.oldPassword = ''
                this.profile.password = ''
                this.profile.passwordRepeat = ''
            },
        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";

    .password__modify {
        width: 100%;
        height: 50%;
        max-width: 685px;
        max-height: 655px;
        position: relative;

        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-size: 22px;

        margin-left: 100px;
        padding: 40px 40px 20px;
        background-color: $white;

        border-radius: 10px;

        &__title {
            font-family: "Roboto Slab", sans-serif;
        }

        &__form {
            display: flex;
            margin-top: 30px;

            &__avatar {
                width: 100%;
                max-width: 270px;
                height: 239px;
            }

            &__data {
                display: flex;
                flex-wrap: wrap;

                width: 100%;
                max-width: 590px;
                max-height: 170px;

                .field-wrap {
                    width: calc(50% - 10px);
                    max-height: 50px;
                    margin: 5px 5px;

                    &.location {
                        width: 100%;
                        max-width: unset;
                    }
                }

                .field-wrap:first-of-type {
                    margin-right: 50px;
                }
            }
        }

        &__footer-info {
            position: absolute;
            left: 40px;
            bottom: 25px;

            &__policy {
                font-family: Roboto, sans-serif;
                font-size: 15px;
                color: #3E3E3E;

                a {
                    color: #3E3E3E;

                    &:hover {
                        color: #FF5722;
                    }
                }
            }

            &__save-btn {
                width: 130px;
                margin-top: 30px;
                padding: 10px 0;
                border-radius: 4px;

                font-size: 15px;
                color: #fff;
                text-transform: uppercase;
                background-color: #FF5722;

                &:hover {
                    opacity: 0.8;
                }
            }

            &__icons {
                display: flex;
                margin-top: 30px;

                a {
                    width: 24px;
                    margin-left: 4px;

                    img {
                        border-radius: 5px;
                    }

                    &:hover {
                        opacity: 0.8;
                    }

                    &.more-icons {
                        position: relative;
                        height: 24px;
                        color: #ccc;
                        background-color: #F7F7F7;

                        border-radius: 5px;

                        span {
                            color: #999999;
                            position: absolute;
                            top: -12px;
                            left: 4px;
                        }
                    }
                }
            }

            a:first-of-type {
                margin: 0;
            }
        }
    }
</style>
