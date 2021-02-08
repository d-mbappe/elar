<template>
<section>
    <ProjectInfo/>

    <div class="authorization">
        <div class="authorization-option">
            <button class="authorization-option__reg" :class="{'active': item ==='Регистрация'}" @click="changeForm($event, reg)">Регистрация</button>
            <button class="authorization-option__log" :class="{'active': item ==='Войти'}" @click="changeForm($event, log)">Войти</button>
        </div>

        <keep-alive class="authorization__form">
            <component v-bind:is="currentOption"></component>
        </keep-alive>



    </div>


</section>
</template>

<script>
    import ProjectInfo from "../components/ProjectInfo";
    import InputCustom from "../components/simple/InputCustom";
    import Login from "../components/Login";
    import Registration from "../components/Registration";

    export default {
        name: "Authentication",
        components: {InputCustom, ProjectInfo, Login, Registration},

        data() {
            return{
                log: 'Login',
                reg: 'Registration',
                isActive: true,
                item: 'Войти',
                currentOption: 'Login',

                registration: {

                }
            }
        },

        methods: {
            changeForm(e, curr) {
                this.item = e.target.textContent;
                this.currentOption = curr;

            }
        },

    }
</script>

<style lang="scss" scoped>
@import "../assets/variables";
.authorization {
    max-width: 360px;
    margin: 45px auto 0;

    &-option {
        display: flex;
        justify-content: space-between;
        align-items: baseline;

        min-height: 70px;

        font-family: "Roboto Slab", sans-serif;
        font-size: 20px;
        color: $white;
        transition: font-size .3s ease;

        &__reg, &__log {
            transition: font-size .3s ease;
            opacity: 0.6;
        }

    }
}

.active {
    font-size: 32px;
    opacity: 1;
    transition: font-size .3s ease;
}
</style>
