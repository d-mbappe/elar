<template>
    <div class="field-wrap">
        <label class="field">
            <input :type="pass"
                   :value="value"
                   :autocomplete="autocomplete"
                   @input="updateData($event.target.value)"
                   class="field__input"
                   :class="{error : isInvalid}"
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

            isInvalid: {}
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
<style lang="scss" scoped>
    @import "../../assets/variables";

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
        --uiFieldPlaceholderColor: var(--fieldPlaceholderColor, #767676);

        background-color: $white;
        border-radius: 5px;
        border: none;

        -webkit-appearance: none;
        -moz-appearance: none;

        font-size: 15px;

    }

    .field__input:focus::-webkit-input-placeholder{
        color: var(--uiFieldPlaceholderColor);
    }

    .field__input:focus::-moz-placeholder{
        color: var(--uiFieldPlaceholderColor);
    }

    /*
    =====
    CORE STYLES
    =====
    */

    .field{
        --uiFieldBorderWidth: var(--fieldBorderWidth, 2px);
        --uiFieldPaddingRight: var(--fieldPaddingRight, 1rem);
        --uiFieldPaddingLeft: var(--fieldPaddingLeft, 1rem);
        --uiFieldBorderColorActive: var(--fieldBorderColorActive, rgba(22, 22, 22, 1));

        display: var(--fieldDisplay, inline-flex);
        position: relative;
        /*font-size: var(--fieldFontSize, 1rem);*/
        font-size: 15px;
        font-weight: 700;
    }

    .field__input{
        box-sizing: border-box;
        width: var(--fieldWidth, 100%);
        height: var(--fieldHeight, 3rem);
        padding: var(--fieldPaddingTop, 1.25rem) var(--uiFieldPaddingRight) var(--fieldPaddingBottom, .5rem) var(--uiFieldPaddingLeft);
        /*border-bottom: var(--uiFieldBorderWidth) solid var(--fieldBorderColor, rgba(0, 0, 0, .25));*/
        border: 1px solid #D1CFC6;
        /*border: 1px solid black;*/
    }

    .field__input:focus{
        outline: none;
    }

    .field__input::-webkit-input-placeholder{
        opacity: 0;
        transition: opacity .2s ease-out;
    }

    .field__input::-moz-placeholder{
        opacity: 0;
        transition: opacity .2s ease-out;
    }

    .field__input:focus::-webkit-input-placeholder{
        opacity: 0;
        transition-delay: .2s;
    }

    .field__input:focus::-moz-placeholder{
        opacity: 0;
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
        left: var(--uiFieldPaddingLeft);
        top: calc(50% - .5em);
        color: #7E7E7E;

        line-height: 1;
        font-size: var(--fieldHintFontSize, inherit);
        /*font-size: 12px;*/

        transition: top .2s cubic-bezier(0.9, -0.15, 0.1, 1.15), opacity .2s ease-out, font-size .2s ease-out;
        will-change: bottom, opacity, font-size;
    }

    .field__input:focus ~ .field__label-wrap .field__label,
    .field__input:not(:placeholder-shown) ~ .field__label-wrap .field__label{
        /*--fieldHintFontSize: var(--fieldHintFontSizeFocused, .75rem);*/
        --fieldHintFontSize: var(--fieldHintFontSizeFocused, 12px);

        top: var(--fieldHintTopHover, .25rem);
    }


    /*
    effect 3
    */

    .field_v3 .field__label-wrap::after{
        border: var(--uiFieldBorderWidth) solid var(--uiFieldBorderColorActive);
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
        /*--fieldBorderColor: #D1C4E9;
        --fieldBorderColorActive: $base-hover;*/

        /*--fieldBorderColor: #D1C4E9;*/
        /*--fieldBorderColorActive: #673AB7;*/
    }

    .field__helper {
        /*position: absolute;*/
        font-size: 14px;
        font-weight: 400;
        color: $white;
        padding: 10px 15px;
        /*color: black;*/
        /*bottom: -25px;
        left: 15px;*/
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
        /*box-sizing: border-box;*/
        width: 100%;
        max-width: 480px;
        margin-top: 10px;
        /*padding: 1rem;*/

        display: grid;
        /*grid-gap: 30px;*/
    }
</style>
