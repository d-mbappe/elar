<template>
    <div class="account__modify__footer-info">
        <div class="account__modify__footer-info__policy">
            Заполняя данную форму вы соглашаетесь с <a href="#" class="registration__policy-link">политикой конфиденциальности</a> сайта
        </div>

        <button :disabled="disabled" class="account__modify__footer-info__save-btn" @click="saveProfile">
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
</template>

<script>
    export default {
        name: "PrivacyPolicy",

        props: {
            saveUrl: '',
            data: {},
            disabled: ''
        },

        methods: {
            saveProfile() {
                this.$store.dispatch(this.saveUrl, this.data).then()
            },
        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";


    .account__modify__footer-info {

        &__policy {
            font-family: Roboto, sans-serif;
            font-size: 15px;
            color: #3E3E3E;

            a {
                color: $privacy;

                &:hover {
                    opacity: 0.8;
                }
            }
        }

        &__save-btn {
            width: 100%;
            max-width: 186px;
            height: 50px;
            margin-top: 15px;
            padding: 10px 0;
            border-radius: 4px;

            font-size: 15px;
            color: #fff;
            background-color: $base-color;

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
                    font-size: 22px;

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

</style>
