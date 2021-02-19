<template>
    <div class="project">
        <div class="project__logo">
            <img  src="../assets/icons/bpolk_logo.svg" alt="">
        </div>
        <div class="project__name">
            Бессмертный полк России
        </div>
        <div class="project__sub-name">
            Шествие Бессмертного полка онлайн
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProjectInfo"
    }
</script>

<style lang="scss" scoped>
@import "../assets/variables";

.project {
    font-family: "Roboto Slab", sans-serif;
    font-weight: normal;
    font-size: 21px;
    line-height: 26px;
    color: $white;

    margin: 40px 0 0 55px;

    display: flex;
    align-items: center;

    &__logo {
        width: 59px;
        height: 59px;
        position: relative;

        img {
            left: 86px;
            position: absolute;
            transform: scale(4.0)
        }
     }

    &__name {
        max-width: 160px;
        margin-left: 15px;
        align-content: center;

    }

    &__sub-name {
        margin-left: 20px;
        max-width: 255px;
    }
}
</style>
