<template>
    <div class="field-wrap">
        <label class="field">
            <input :type="pass"
                   :value="value"
                   :autocomplete="autocomplete"
                   @input="updateData($event.target.value)"
                   class="field__input"
                   :class="{error : isInvalid, none : border}"
                   :placeholder="1"

            >
            <span class="field__label-wrap">
                <span class="field__label " :class="{required : required}">{{content}}</span>
            </span>

        </label>
        <span v-if="helper" class="field__helper">{{fieldHelper}}</span>

    </div>

</template>

<script>
    export default {
        name: "InputCustom",

        props: {
            value: {
                required: true
            },
            name: {
                type: String,
                required: true
            },
            helper: {
                type: String
            },
            isRequired: {
                type: String,
            },
            isType: {
                type: String,
            },
            autocomplete: {
                type: String,
                default: 'nope',
            },

            isInvalid: {},

            border: ''
        },

        data() {
            return{
                required: this.isRequired,
                innerData: this.value,
                content: this.name,
                fieldHelper: this.helper,

                pass: this.isType,
            }

        },

        methods: {
            updateData(value) {
                this.$emit('input', value)
            }
        },

        mounted() {
        }
    }
</script>
<style lang="scss">
    @import "../../assets/variables";
    $uiFieldPlaceholderColor: #767676;
    $uiFieldBorderWidth:  2px;
    $uiFieldPaddingRight: 1rem;
    $uiFieldPaddingLeft:  1rem;
    $uiFieldBorderColorActive:  rgba(22, 22, 22, 1);

    /*
    =====
    RESET STYLES
    =====
    */
    .error {
        border: 2px solid red !important;
        border-radius: 5px !important;
    }



    .field__input{
        background-color: $white;
        border-radius: 5px;
        border: none;

        font-size: 15px;

    }

    .field__input:focus::-webkit-input-placeholder{
        color: $uiFieldPlaceholderColor;
    }

    .field__input:focus::-moz-placeholder{
        color: $uiFieldPlaceholderColor;
    }

    /*
    =====
    CORE STYLES
    =====
    */

    .field{
        display:  inline-flex;
        position: relative;
        font-size: 15px;
        font-weight: 700;
    }

    .field__input{
        box-sizing: border-box;
        width:  100%;
        height: 3rem;
        padding: 1.25rem  $uiFieldPaddingRight  .5rem $uiFieldPaddingLeft;
        border: 1px solid #D1CFC6;
    }

    .field__input:focus{
        outline: none;
    }

    .field__input::-webkit-input-placeholder{
        visibility: hidden;
        transition: opacity .2s ease-out;
    }

    .field__input::-moz-placeholder{
        visibility: hidden;
        transition: opacity .2s ease-out;
    }

    .field__input:focus::-webkit-input-placeholder{
        visibility: hidden;
        transition-delay: .2s;
    }

    .field__input:focus::-moz-placeholder{
        visibility: hidden;
        transition-delay: .2s;
    }

    .field__label-wrap{
        box-sizing: border-box;
        pointer-events: none;
        cursor: text;
        font-weight: 400;

        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    .field__label-wrap::after{
        content: "";
        box-sizing: border-box;
        width: 100%;
        height: 0;
        /*custom*/
        opacity: 0;

        position: absolute;
        bottom: 0;
        left: 0;
    }

    .field__input:focus ~ .field__label-wrap::after{
        /*opacity: 1;*/
    }

    .field__label{
        position: absolute;
        left: $uiFieldPaddingLeft;
        top: calc(50% - .5em);
        color: #7E7E7E;

        line-height: 1;
        font-size:  inherit;
        transition: all .2s linear;
    }

    .field__input:focus ~ .field__label-wrap .field__label,
    .field__input:not(:placeholder-shown) ~ .field__label-wrap .field__label{
        font-size: 12px;
        top: .25rem;
    }


    /*
    effect 3
    */

    .field_v3 .field__label-wrap::after{
        border: $uiFieldBorderWidth solid $uiFieldBorderWidth;
        will-change: opacity;
        transition: opacity .2s ease-out, opacity .2s ease-out;
    }

    .field_v3 .field__input:focus ~ .field__label-wrap::after{
        height: 100%;
    }

    /*
    =====
    LEVEL 4. SETTINGS
    =====
    */

    .field{
        width: 100%;
    }

    .field__helper {
        font-size: 14px;
        font-weight: 400;
        color: $white;
        padding: 10px 15px;
    }

    .required:after {
        content: ' *';
        color: #EE4F20;
    }


    /*
    =====
    DEMO
    =====
    */

    body{
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Open Sans, Ubuntu, Fira Sans, Helvetica Neue, sans-serif;
        margin: 0;

        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .field-wrap{
        width: 100%;
        max-width: 480px;
        margin-top: 10px;

        display: block;
    }
</style>
