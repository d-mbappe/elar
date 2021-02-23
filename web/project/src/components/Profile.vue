<template>
    <div class="account__modify">
        <div class="account__modify__title">Личные данные</div>

        <div class="account__modify__form">
            <div class="account__modify__form__avatar">
                <Avatar @setImg="setProfileImg($event)" :imageURL="profile.photo"/>
            </div>

            <form id="profileForm" class="account__modify__form__data">
                <InputCustom v-model.trim="profile.name" name="Ваше имя" data="" isRequired="true"
                             :isInvalid="!$v.profile.name.required || !$v.profile.name.text"
                />
                <InputCustom v-model.trim="profile.surname" name="Ваша фамилия" data="" isRequired="true"
                             :isInvalid="!$v.profile.surname.required || !$v.profile.surname.text"
                />
                <InputCustom v-model.trim="profile.patronymic" name="Ваше отчество" data="" isRequired=""
                             :isInvalid="!$v.profile.patronymic.text"
                />
                <InputCustom v-model.trim="profile.birthdate" name="Дата рождения" data="дд.мм.гг" isRequired="" isType="date"
                />
                <InputCustom class="field-wrap location" v-model.trim="profile.location" name="Место жительства" data="" isRequired=""
                             :isInvalid="!$v.profile.location.text"
                />
            </form>
        </div>

        <PrivacyPolicy
                class="privacy"
                save-url="saveProfile"
                :data="profile"
                :disabled="$v.profile.$invalid"
        />

    </div>
</template>

<script>
    import InputCustom from "./simple/InputCustom";
    import Avatar from "../components/Avatar";
    import PrivacyPolicy from "./PrivacyPolicy";

    import {email, minLength, numeric, required, sameAs} from "vuelidate/lib/validators";

    import { helpers } from 'vuelidate/lib/validators'
    const text = helpers.regex('text', /^[а-яА-ЯёЁa-zA-Z]+$/i)

    export default {
        name: "Profile",
        components: {Avatar, InputCustom, PrivacyPolicy},

        data() {
            return {
                item: 'Войти',
                currentTabComponent: 'Login'
            }
        },

        validations: {
            profile: {
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
                location: {
                    text,
                },
            }

        },

       async mounted() {
           await this.$store.dispatch('getUser')
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

        .privacy {
            position: absolute;
            left: 40px;
            bottom: 25px;
        }
    }
</style>
