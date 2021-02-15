<template>
    <div class="password__modify">

        <div class="password__modify__title">Смена пароля</div>

        <div class="password__modify__form">
            <form id="profileForm" class="password__modify__form__data">
                <InputCustom v-model="profile.password" name="Новый пароль" data="" isRequired="" />
                <InputCustom v-model="profile.passwordRepeat" name="Повтор пароля" data="" isRequired="" />
            </form>
        </div>

        <button class="password__modify__footer-info__save-btn" @click="saveProfile">
            Сохранить
        </button>

    </div>
</template>

<script>
    import InputCustom from "./simple/InputCustom";

    export default {
        name: "NewPassword",
        components: { InputCustom },

        data() {
            return {
                // profile: {}
            }
        },

        mounted() {
            this.$store.dispatch('getUser')
            // this.profile = this.$store.state.profile
        },

        computed: {
            profile() {
                return this.$store.state.profile
            }
        },

        methods: {
            saveProfile() {
                this.$store.dispatch('saveProfile', this.profile).then()
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

        font-family: "Roboto Slab", sans-serif;
        font-weight: 400;
        font-size: 22px;

        margin-left: 100px;
        padding: 40px 40px 20px;
        background-color: $white;

        border-radius: 10px;


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
