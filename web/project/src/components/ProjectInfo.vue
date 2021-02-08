<template>
    <div class="project">
        <div class="project__logo">

        </div>
        <div class="project__name">
            Наименование проекта
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

        border-radius: 50%;

        background: $white;
     }

    &__name {
        margin-left: 15px;
        align-content: center;

    }
}
</style>
