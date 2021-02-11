<template>
    <section>
        <ProjectInfo/>

        <div class="account">
            <div class="account__title">Личный кабинет</div>

            <div class="account__content">

                <div class="account__sidebar">
                    <div class="account__sidebar__nav">
                        <ul class="account__sidebar__list">
                            <li class="account__sidebar__list__item"><a href="">Мои анкеты</a></li>
                            <li class="account__sidebar__list__item"><a href="">Мои колонны</a></li>
                            <li class="account__sidebar__list__item"><a href="">Личные данные</a></li>
                        </ul>
                    </div>

                    <div class="account__sidebar__widget">Виджет социальных сетей</div>

                </div>
                <div class="account__modify">
                    <div class="account__modify__title">Личные данные</div>

                    <div class="account__modify__form">
                        <div class="account__modify__form__avatar">

                        </div>
                        <div class="account__modify__form__data">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
    import ProjectInfo from "../components/ProjectInfo";
    import InputCustom from "../components/simple/InputCustom";
    export default {
        name: "Account",
        components: {ProjectInfo, InputCustom},

        data() {
            return {

            }
        }
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
                height: 100%;
                max-height: 140px;

                padding:5px 20px ;

                background-color: $white;
                border-radius: 10px;
            }

            &__list {
                &__item {
                    margin-top: 15px;

                    a {
                        color: $black;
                    }
                }
            }

            &__widget {
                margin-top: 20px;
                padding-top: 20px;

                max-height: 170px;

            }
        }

        &__modify {
            width: 100%;
            max-width: 925px;
            max-height: 655px;

            font-family: "Roboto Slab", sans-serif;
            font-weight: 400;
            font-size: 22px;

            margin-left: 100px;
            padding: 40px 70px 25px 45px;
            background-color: $white;

            border-radius: 10px;

        }







    }

</style>
