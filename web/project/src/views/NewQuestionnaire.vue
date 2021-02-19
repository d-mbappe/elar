<template>
<section>
    <ProjectInfo/>
    <div class="page-selection">
        Новая анкета
    </div>
    <div class="new-questionnaire">

        <div class="new-questionnaire__title">
            Добавление героя ВОВ
        </div>

        <div class="new-questionnaire__form">
            <InputCustom  v-model.trim="questionnaire" name="Имя" data="" isRequired="true"

            />
            <InputCustom v-model.trim="questionnaire" name="Фамилия" data="" isRequired="true"

            />
            <InputCustom v-model.trim="questionnaire" name="Отчество" data="" isRequired=""

            />
            <InputCustom v-model.trim="questionnaire" name="Звание" data="" isRequired=""

            />
            <InputCustom class="military-unit" v-model.trim="questionnaire" name="Воинская часть" data="" isRequired=""

            />

            <InputCustom v-model.trim="questionnaire" name="День рождения" data="" isRequired=""

            />

            <InputCustom v-model.trim="questionnaire" name="Месяц рождения" data="дд.мм.гг" isRequired="" isType="date"
            />
            <InputCustom v-model.trim="questionnaire" name="Год рождения" data="дд.мм.гг" isRequired="" isType="date"
            />

            <InputCustom class="birthplace" v-model.trim="questionnaire" name="Место рождения" data="" isRequired=""

            />

        </div>
        <div class="text-area">
            <label for="life-path">Жизненный путь</label>
            <textarea v-model="test" id="life-path" class="life-path">

            </textarea>
        </div>

        <div class="new-questionnaire__info-death">
            <InputCustom v-model.trim="questionnaire" name="Дата смерти" data="" isRequired=""

            />

            <InputCustom v-model.trim="questionnaire" name="Месяц смерти" data="дд.мм.гг" isRequired="" isType="date"
            />
            <InputCustom v-model.trim="questionnaire" name="Год смерти" data="дд.мм.гг" isRequired="" isType="date"
            />

            <InputCustom class="death-place" v-model.trim="questionnaire" name="Место смерти" data="" isRequired=""

            />
        </div>

        <button class="btn orange">Поиск в базах данных Минобороны России</button>

        <p class="new-questionnaire__bd-info">В базах данных Минобороны России найдены похожие записи. Вы можете выбрать
            документы, относящиеся к Вашему Герою или пропустить, нажав на кнопку «Отправить».
        </p>

        <div class="new-questionnaire__document-list">
            <div class="new-questionnaire__document-list__item">

                <label>
                    {{label}}
                    <input v-on="" type="checkbox">
                </label>
                <div class="new-questionnaire__document-list__item__info">
                    <span class=""></span>
                    <span></span>
                </div>
                <span></span>
            </div>
        </div>


    </div>

</section>
</template>

<script>
    import ProjectInfo from "../components/ProjectInfo";
    import InputCustom from "../components/simple/InputCustom";

    import {email, minLength, numeric, required, sameAs} from "vuelidate/lib/validators";

    import { helpers } from 'vuelidate/lib/validators'
    const text = helpers.regex('text', /^[а-яА-ЯёЁa-zA-Z]+$/i)

    export default {
        name: "NewQuestionnaire",
        components: {ProjectInfo, InputCustom},

        data() {
            return {
                test: '',
                questionnaire: {

                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";
    .page-selection {
        font-family: "Roboto Slab", sans-serif;
        font-size: 32px;
        color: $white;

        margin-top: 50px;
        margin-left: 120px;

    }

    .field-wrap {
        max-width: 100%;
    }

    .new-questionnaire {
        /*padding: 0 160px 55px 120px;*/
        width: 100%;
        margin: 40px 120px;
        padding: 30px 20px;

        max-width: 925px;
        min-height: 655px;
        position: relative;
        background-color: $white;

        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-size: 22px;

        /*padding: 40px 5px 20px;*/

        border-radius: 10px;

        &__title {
            font-family: "Roboto Slab", sans-serif;
        }

        &__form {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-column-gap: 10px;

            .military-unit {
                grid-column-start: 2;
                grid-column-end: 4;
            }

            .birthplace {
                grid-column-start: 1;
                grid-column-end: 4;
            }
        }

        .text-area {
            font-size: 15px;
            position: relative;

            margin-top: 15px;
            padding: 15px 15px;


            border: 1px solid #D1CFC6;
            border-radius: 5px;

            label {
                font-size: 13px;
                top: 15px;
                left: 15px;
                color: #7E7E7E;
            }
            .life-path {
                width: 100%;
                height: 220px;
                grid-column-start: 1;
                grid-column-end: 4;
                resize: none;

                outline: none;
                border: none;

                font-size: 15px;
                font-weight: 400;

            }

        }

        &__info-death {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-column-gap: 10px;

            .death-place {
                grid-column-start: 1;
                grid-column-end: 4;
            }
        }

        .btn.orange {
            margin-top: 25px;
        }

        &__bd-info {
            margin-top: 25px;
            font-size: 16px;
        }

        &__document-list {
            width: 100%;
            /*max-width: 855px;*/
            height: 320px;
            max-height: 100%;

            /*padding-top: 10px;*/

            border: 1px solid #D1CFC6;
            border-radius: 5px;

            overflow: auto;
            padding: 5px;
        }
        /**/
        /**/
        input[type='checkbox'],
        input[type='radio'] {
            --active: #C3523B;
            --active-inner: #fff;
            --focus: #9C2A16;
            --border: #C0C0C0;
            --border-hover: #9C2A16;
            --background: $base-color;
            --disabled: #F6F8FF;
            --disabled-inner: #E1E6F9;
            -webkit-appearance: none;
            -moz-appearance: none;
            height: 24px;
            outline: none;
            display: inline-block;
            vertical-align: top;
            position: relative;
            margin: 0;
            cursor: pointer;
            border: 2px solid var(--bc, var(--border));
            background: var(--b, var(--background));
            transition: background .3s, border-color .3s, box-shadow .2s;
            &:after {
                content: '';
                display: block;
                left: 0;
                top: 0;
                position: absolute;
                transition: transform var(--d-t, .3s) var(--d-t-e, ease), opacity var(--d-o, .2s);
            }
            &:checked {
                --b: var(--active);
                --bc: var(--active);
                --d-o: .3s;
                --d-t: .6s;
                --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
            }
            &:disabled {
                --b: var(--disabled);
                cursor: not-allowed;
                opacity: .9;
                &:checked {
                    --b: var(--disabled-inner);
                    --bc: var(--border);
                }
                & + label {
                    cursor: not-allowed;
                }
            }
            &:hover {
                &:not(:checked) {
                    &:not(:disabled) {
                        --bc: var(--border-hover);
                    }
                }
            }
            &:focus {
                box-shadow: 0 0 0 var(--focus);
            }
            &:not(.switch) {
                width: 24px;
                &:after {
                    opacity: var(--o, 0);
                }
                &:checked {
                    --o: 1;
                }
            }
            & + label {
                font-size: 14px;
                line-height: 21px;
                display: inline-block;
                vertical-align: top;
                cursor: pointer;
                margin-left: 4px;
            }
        }
        input[type='checkbox'] {
            &:not(.switch) {
                border-radius: 3px;
                &:after {
                    width: 8px;
                    height: 15px;
                    border: 2px solid var(--active-inner);
                    border-top: 0;
                    border-left: 0;
                    left: 6px;
                    top: 0px;
                    transform: rotate(var(--r, 20deg));
                }
                &:checked {
                    --r: 43deg;
                }
            }
            &.switch {
                width: 38px;
                border-radius: 11px;
                &:after {
                    left: 2px;
                    top: 2px;
                    border-radius: 50%;
                    width: 15px;
                    height: 15px;
                    background: var(--ab, var(--border));
                    transform: translateX(var(--x, 0));
                }
                &:checked {
                    --ab: var(--active-inner);
                    --x: 17px;
                }
                &:disabled {
                    &:not(:checked) {
                        &:after {
                            opacity: .6;
                        }
                    }
                }
            }
        }
        input[type='radio'] {
            border-radius: 50%;
            &:after {
                width: 19px;
                height: 19px;
                border-radius: 50%;
                background: var(--active-inner);
                opacity: 0;
                transform: scale(var(--s, .7));
            }
            &:checked {
                --s: .5;
            }
        }
    }

</style>
