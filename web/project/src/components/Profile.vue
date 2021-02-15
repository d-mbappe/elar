<template>
    <div class="account__modify">
        <div class="account__modify__title">Личные данные</div>

        <div class="account__modify__form">
            <div class="account__modify__form__avatar">
                <Avatar @setImg="setProfileImg($event)" :imageURL="'https://www.worldphoto.org/sites/default/files/default-media/Piercy.jpg'"/>
            </div>

            <form id="profileForm" class="account__modify__form__data">
                <InputCustom v-model.trim="profile.name" name="Ваше имя" data="" isRequired="true"
                             :isInvalid="!$v.profile.name.required || !$v.profile.name.alpha"
                />
                <InputCustom v-model.trim="profile.surname" name="Ваша фамилия" data="" isRequired="true"
                             :isInvalid="!$v.profile.surname.required || !$v.profile.surname.alpha"
                />
                <InputCustom v-model.trim="profile.patronymic" name="Ваше отчество" data="" isRequired=""
                             :isInvalid="!$v.profile.patronymic.alpha"
                />
                <InputCustom v-model.trim="profile.birthdate" name="Дата рождения" data="дд.мм.гг" isRequired="" isType="date"
                />
                <InputCustom class="field-wrap location" v-model.trim="profile.location" name="Место жительства" data="" isRequired="" />
            </form>
        </div>

        <div class="account__modify__footer-info">
            <div class="account__modify__footer-info__policy">
                Заполняя данную форму вы соглашаетесь с <a href="#" class="registration__policy-link">политикой конфиденциальности</a> сайта
            </div>

            <button class="account__modify__footer-info__save-btn" @click="saveProfile">
                Сохранить
            </button>

            <div class="account__modify__footer-info__icons">
                <a href=""><img src="../assets/icons/vk-logo-bg.svg" alt=""></a>
                <a href=""><img src="../assets/icons/facebook-logo-bg.svg" alt=""></a>
                <a href=""><img src="../assets/icons/ok-logo-bg.svg" alt=""></a>
                <a href=""><img src="../assets/icons/twitter-logo-bg.svg" alt=""></a>
                <a class="more-icons" href=""><span>...</span></a>
            </div>
        </div>
    </div>
</template>

<script>
    import InputCustom from "./simple/InputCustom";
    import Avatar from "../components/Avatar";
    import {alpha, email, minLength, numeric, required, sameAs} from "vuelidate/lib/validators";

    export default {
        name: "Profile",
        components: {Avatar, InputCustom},

        data() {
            return {
                item: 'Войти',
                currentTabComponent: 'Login'
            }
        },

        validations: {
            profile: {
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
                    alpha
                },
                surname: {
                    required,
                    alpha
                },
                patronymic: {
                    alpha
                },
            }

        },

        mounted() {
            this.$store.dispatch('getUser')
            this.profile.photo = 'https://www.worldphoto.org/sites/default/files/default-media/Piercy.jpg'

            // this.profile = this.$store.state.profile
        },

        computed: {
            profile() {
                return this.$store.state.profile
            }
        },

        methods: {
            setProfileImg(url) {
                this.profile.photo = url;
                console.log('profile', this.profile)
            },

            saveProfile() {
                this.$store.dispatch('saveProfile', this.profile).then()
            },

            changeForm(e, curr) {
                this.item = e.target.textContent;
                this.currentOption = curr;

            }

        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";

    .account__modify {
        width: 100%;
        max-width: 925px;
        min-height: 655px;
        position: relative;
        background-color: $white;

        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-size: 22px;

        margin-left: 100px;
        padding: 40px 5px 20px;

        border-radius: 10px;

        &__title {
            margin-left: 35px;
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
                height: 170px;

                .field-wrap {
                    width: calc(50% - 10px);
                    max-height: 50px;
                    margin: 0 5px;

                    &.location {
                        width: 100%;
                        max-width: unset;
                    }
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
                    color: #FF5722;

                    &:hover {
                        opacity: 0.8;
                    }
                }
            }

            &__save-btn {
                width: 130px;
                margin-top: 15px;
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
