<template>
<section class="new-profile">
    <ProjectInfo/>
    <div class="new-profile__title">
        Новая анкета
    </div>
</section>
</template>

<script>
    import ProjectInfo from "../components/ProjectInfo";
    export default {
        name: "NewProfile",
        components: {ProjectInfo}
    }
</script>

<style lang="scss" scoped>
    .new-profile {
        padding: 0 160px 55px 120px;
    }
</style>
