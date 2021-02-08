<template>
<div class="custom-select">
    <p
            @click="changeListDisplaying"
            class="custom-select__title"
    >
        {{value}}
    </p>
    <ul
            v-show="showList"
            class="custom-select__list"
    >
        <li
                v-for="item in selectList"
                :key="item"
                class="custom-select__item"
                @click="changeSelectedValue($event.target.textContent)"
        >
            {{item}}
        </li>
    </ul>
</div>
</template>

<script>
    export default {
        name: "SelectCustom",
        props: {
            value: {
                type: String,
                default: ''
            },
            selectList: {
                type: Array,
                default: function () {
                    return ['Пусто']
                }
                // required: true
            }
        },
        data(){
            return{
                showList: false
            }
        },
        methods: {
            changeListDisplaying(){
                this.showList = !this.showList;
            },
            changeSelectedValue(newValue){
                this.$emit('input', newValue);
                this.changeListDisplaying();
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";

    .custom-select{
        display: inline-block;
        position: relative;
        min-width: 150px;
        margin: 0 auto;
        padding: 0 10px;

        background-color: transparent;
        color: $white;
        &__title {
            position: relative;
            padding: 0 15px 0 0;
            &:before {
                position: absolute;
                bottom: 8px;
                right: 0;
                content: '';
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 5px 4px 0 4px;
                border-color: #f5f5f5 transparent transparent transparent;
            }
            &:hover{
                cursor: pointer;
            }
        }

        &__list{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 0 10px;
            margin: 0;
            transform: translateY(100%);
            /*border: 1px solid;*/
            border-top: none;
            /*border-radius: 0 0 4px 4px;*/
        }
        &__item{
            width: 100%;
            padding: 0 10px;
            list-style-type: none;
            background: #000;
            opacity: 0.8;
            transition: background-color .5s ease-in-out;
            &:hover{
                cursor: pointer;
                background-color: $base-color;
            }
        }
    }
</style>
