<template>
    <section>
        <ProjectInfo/>

        <div class="account">
            <div class="account__title">Личный кабинет</div>

            <div class="account__content">

                <div class="account__sidebar">
                    <div class="account__sidebar__nav">
                        <ul class="account__sidebar__list">
                            <li class="account__sidebar__list__item"><router-link  to="/example">Мои анкеты</router-link></li>
                            <li class="account__sidebar__list__item"><router-link  to="/example">Мои колонны</router-link></li>
                            <li class="account__sidebar__list__item"><router-link  to="/account/profile">Личные данные</router-link></li>
                            <li v-if="!$store.state.auth_social" class="account__sidebar__list__item"><router-link  to="/account/new-password">Смена пароля</router-link></li>
                        </ul>
                    </div>

                    <div class="account__sidebar__widget">Виджет социальных сетей</div>
                </div>

                <!--Отображения контента -->
                <router-view></router-view>

            </div>

        </div>
    </section>
</template>

<script>
    import ProjectInfo from "../components/ProjectInfo";
    import InputCustom from "../components/simple/InputCustom";
    import Avatar from "../components/Avatar";
    import Profile from "../components/Profile";
    import NewPassword from "../components/NewPassword";

    export default {
        name: "Account",
        components: {ProjectInfo, InputCustom, Avatar, Profile, NewPassword },

        data() {
            return {
                item: 'Войти',
                currentTabComponent: 'Login'
            }
        },

        mounted() {
        },

        computed: {
            profile() {
                return this.$store.state.profile
            }
        },
        //
        // methods: {
        //     setProfileImg(url) {
        //         this.profile.photo = url;
        //         console.log('profile', this.profile)
        //     },
        //
        //     saveProfile() {
        //         this.$store.dispatch('saveProfile', this.profile).then()
        //     },
        //
        //     changeForm(e, curr) {
        //         this.item = e.target.textContent;
        //         this.currentOption = curr;
        //
        //     }
        //
        // }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";

    .account {
        margin:  50px 125px;

        &__title {
            font-family: "Roboto Slab", sans-serif;
            font-weight: 400;
            font-size: 32px;
            line-height: 26px;
            color: $white;
        }

        &__content {
            display: flex;
            max-width: 1295px;
            margin-top: 40px;
        }

        &__sidebar {
            width: 100%;
            max-width: 276px;

            font-size: 15px;
            font-weight: 700;

            &__nav, &__widget {
                width: 100%;
                min-height: 140px;

                padding: 25px 20px ;

                background-color: $white;
                border-radius: 10px;
            }

            &__list {
                li:first-of-type {
                    margin: 0;
                }
                &__item {
                    margin-top: 15px;
                    color: $black;

                    a {
                        color: $black;

                        &.router-link-active {
                            color: $base-hover;
                        }

                        &:hover {
                            color: $base-hover;
                        }
                    }
                }
            }

            &__widget {
                margin-top: 20px;
                padding-top: 20px;

                max-height: 170px;
            }
        }
    }






</style>
