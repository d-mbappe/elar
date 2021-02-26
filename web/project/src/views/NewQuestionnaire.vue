<template>
<section>
    <ProjectInfo/>
    <CropImage
            @hideModal="hide"
            @setImg="set($event)"
            v-if="modal"
            :img="img"
    />

    <div class="page-selection">
        Новая анкета
    </div>
    <div class="content-wrapper">

        <div class="new-questionnaire">

            <div class="new-questionnaire__title">
                Добавление героя ВОВ
            </div>

            <div class="new-questionnaire__form">
                <InputCustom  v-model.trim="questionnaire.name" name="Имя" data="" isRequired="true"

                />
                <InputCustom v-model.trim="questionnaire.surname" name="Фамилия" data="" isRequired="true"

                />
                <InputCustom v-model.trim="questionnaire.patronymic" name="Отчество" data="" isRequired=""

                />
                <InputCustom v-model.trim="questionnaire.rank" name="Звание" data="" isRequired=""

                />
                <InputCustom class="military-unit" v-model.trim="questionnaire.military_unit" name="Воинская часть" data="" isRequired=""

                />

                <InputCustom v-model.trim="questionnaire.birthdate.day" name="День рождения" data="" isRequired=""

                />

                <InputCustom v-model.trim="questionnaire.birthdate.month" name="Месяц рождения" data="дд.мм.гг" isRequired="" isType="text"
                />
                <InputCustom v-model.trim="questionnaire.birthdate.year" name="Год рождения" data="дд.мм.гг" isRequired="" isType="text"
                />

                <InputCustom class="birthplace" v-model.trim="questionnaire.birthplace" name="Место рождения" data="" isRequired=""

                />

            </div>
            <div class="text-area">
                <label for="life-path">Жизненный путь</label>
                <textarea v-model="questionnaire.life_path" id="life-path" class="life-path">

            </textarea>
            </div>

            <div class="new-questionnaire__info-death">
                <InputCustom v-model.trim="questionnaire.death_date.day" name="Деньи смерти" data="" isRequired=""

                />

                <InputCustom v-model.trim="questionnaire.death_date.month" name="Месяц смерти" data="дд.мм.гг" isRequired="" isType="text"
                />
                <InputCustom v-model.trim="questionnaire.death_date.year" name="Год смерти" data="дд.мм.гг" isRequired="" isType="text"
                />

                <InputCustom class="death-place" v-model.trim="questionnaire.death_place" name="Место смерти" data="" isRequired=""

                />
            </div>

            <button class="btn orange">Поиск в базах данных Минобороны России</button>

            <p class="new-questionnaire__bd-info">В базах данных Минобороны России найдены похожие записи. Вы можете выбрать
                документы, относящиеся к Вашему Герою или пропустить, нажав на кнопку «Отправить».
            </p>

            <p class="new-questionnaire__document-found"> Найдено допументов: 22</p>

            <div class="new-questionnaire__document-list">
                <div class="new-questionnaire__document-list__item" v-for="(item, i) in documentList"  >
                    <label>
                        <input v-on="" type="checkbox">
                    </label>

                    <div class="new-questionnaire__document-list__item__info">
                        <span class="name">Шмулевич Леонид Семенович </span>
                        <span class="rank">Инженер-полковник Место службы: 46-я стрелковая дивизия</span>
                    </div>
                    <button  class="btn white extend">Дополнить анкету данными из документа</button>
                </div>
            </div>

            <div class="new-questionnaire__link">
                <p class="new-questionnaire__link__title">Или укажите ссылку на документы из проектов Память народа, ОБД Мемориал, ОБД Подвиг народа</p>
                <div class="new-questionnaire__link__item" v-for="(item, i) in linkList">
                    <a :href="item">{{item}}
                    </a>

                    <div class="remove-btn">
                        <button @click="removeLink(i)" class="">+</button>
                    </div>


                </div>
                <div class="new-questionnaire__link__input">
                    <InputCustom v-model.trim="test" name="Вставьте ссылку с проекта" data="" isRequired=""
                                 border="none"
                    />
                    <button @click="addLink" class="">+</button>
                </div>
            </div>

            <PrivacyPolicy/>
        </div>

        <div class="media-content">
            <div class="media-content__photo">
                <div class="media-content__photo__item">
                    <p class="media-content__photo__item__title">Фотография героя ВОВ</p>
                    <Avatar @click="currentPhoto === 'military'" ref="avatar" @setImg="setProfileImg($event, 'military')" :imageURL="img" :modal="changed" />
                </div>
                <div class="media-content__photo__item">
                    <p class="media-content__photo__item__title">Ваша фотография</p>

                    <Avatar @click="currentPhoto === 'military'" ref="avatar" @setImg="setProfileImg($event, 'no')" :imageURL="imgUser" :modal="changed" />
                </div>
            </div>

        </div>
    </div>





</section>
</template>

<script>
    import VideoPlayer from "../components/VideoPlayer";
    import 'video.js/dist/video-js.css'


    import ProjectInfo from "../components/ProjectInfo";
    import InputCustom from "../components/simple/InputCustom";
    import PrivacyPolicy from "../components/PrivacyPolicy";
    import CropImage from "../components/CropImage";
    import Avatar from "../components/Avatar";

    import { Cropper } from 'vue-advanced-cropper';
    import 'vue-advanced-cropper/dist/style.css';


    import {email, minLength, numeric, required, sameAs} from "vuelidate/lib/validators";

    import { helpers } from 'vuelidate/lib/validators'
    const text = helpers.regex('text', /^[а-яА-ЯёЁa-zA-Z]+$/i)

    export default {
        name: "NewQuestionnaire",
        components: {ProjectInfo, InputCustom, PrivacyPolicy, CropImage, Avatar, Cropper, VideoPlayer},

        data() {
            return {
                videoOptions: {
                    autoplay: true,
                    controls: true,
                    sources: [
                        {
                            src:
                                "https://vimeo.com/164438721",
                            type: "application/x-mpegURL"
                        }
                    ]
                },
                /**/
                currentPhoto: '',
                changed: true,
                img: '',
                imgUser: '',
                modal: false,
                test: '',
                hover: false,
                documentList: [1,2,3,4,5,6],
                linkList: [
                    "https://pamyat-naroda.ru/heroes/memorial-chelovek_vpp2001446844/"
                ],
                questionnaire: {
                    name: '',
                    surname: '',
                    patronymic: '',
                    rank: '',
                    military_unit: '',
                    birthdate: {
                        day: '',
                        month: '',
                        year: '',
                    },
                    birthplace: '',
                    life_path: '',

                    death_date: {
                        day: '',
                        month: '',
                        year: '',
                    },
                    death_place: ''

                }
            }
        },

        computed: {
            profile() {
                return this.$store.state.profile
            }
        },



        methods: {
            set(url) {
                /*
                для будущего принятия фотографий с бэка
                this.profile.photo = url;
                */
                this.img = url;
                this.modal = false
            },

            addLink() {
                this.linkList.push(this.test)
                this.test= ''
            },

            removeLink(i) {
                this.linkList.splice(i, 1)
            },

            hide() {
                this.modal = false
            },

            setProfileImg(url , user) {
                this.profile.photo = url;
                this.changed = true;
                user === 'military'? this.img = url : this.imgUser = url;

                url ? this.modal = true : ''
            },
        }
    }
</script>
<style lang="scss" >
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

    .content-wrapper {
        display: flex;
    }

    .new-questionnaire {
        width: 100%;
        margin: 40px 120px;
        padding: 30px 20px;

        max-width: 925px;
        min-height: 655px;
        position: relative;
        background-color: $white;

        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-size: 14px;

        border-radius: 10px;

        &__title {
            font-family: "Roboto Slab", sans-serif;
            font-size: 22px;

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

        &__document-found {
            margin: 15px 0 5px;
            color: #5F5F5F;
        }

        &__document-list {
            width: 100%;
            height: 320px;
            max-height: 100%;

            border: 1px solid #D1CFC6;
            border-radius: 5px;

            overflow: auto;
            padding: 5px 0;

            &__item {
                display: flex;
                padding: 12px 19px;
                position: relative;

                cursor: pointer;
                transition: all ease .3s;

                &:hover  {
                    background-color: #F1F1F1;
                    .extend {
                        opacity: 1;
                    }
                }

                &__info {
                    margin-left: 15px;

                    span {
                        display: inherit;

                        &.name {
                            color: #1677E9;
                        }
                        &.rank {
                            color: #5F5F5F;
                        }
                    }
                }

                .extend {
                    opacity: 0;
                    position: absolute;
                    right: 19px;
                    bottom: 12px;

                    max-width: 150px;
                    min-height: 36px;
                    font-size: 12px;

                    border: 1px solid #D9D9D9;
                    transition: opacity .3s linear;

                }
            }
        }

        &__link {
            margin-top: 20px;

            &__item {
                margin-top: 10px;

                a {
                    color: #1677E9;

                    &:hover {
                        opacity: .8;
                    }
                }

                .remove-btn {
                    width: 20px;
                    height: 15px;
                    display: inline-block;
                    position: relative;

                    button {
                        position: absolute;
                        font-size: 30px;
                        color: #7E7E7E;
                        font-weight: 200;
                        transform: rotate(45deg);

                        top: -13px;
                        right: -10px;
                    }
                }


            }


            &__input {
                display: flex;
                align-items: flex-end;
                margin: 10px 0 35px;

                /*Переопределение кастомного инпута*/
                .field-wrap {
                    border-top: 1px solid #D1CFC6 !important;
                    border-bottom: 1px solid #D1CFC6 !important;
                    border-left: 1px solid #D1CFC6 !important;

                    border-top-left-radius: 5px;
                    border-bottom-left-radius: 5px;

                }

                button {
                    font-size: 25px;
                    color: #767676;
                    width: 36px;
                    height: 50px;
                    border: 1px solid #C0C0C0;

                    border-top-right-radius: 5px;
                    border-bottom-right-radius: 5px;
                }
            }
        }


        /*Кастомный чекбокс*/
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

    .media-content {
        margin-top: 40px;

        &__photo {
            display: flex;

            &__item {
                margin-right: 15px;


                &__title {
                    font-family: "Roboto Slab", sans-serif;
                    font-size: 22px;
                    color: $white;

                    margin-bottom: 25px;
                }

                .avatar {
                    width: 280px;
                    margin: 0;

                    .drop {
                        width: 100%;
                        height: 360px;

                        background-color: rgba(0, 0, 0, .3);
                        border: 1px dashed $white;

                        .btn.display-inline.choose {
                            overflow: hidden;
                        }

                        .custom__preview {
                            margin-top: 65px;
                            &__title {
                                margin-top: 45px;
                                line-height: 1.5;
                            }
                        }
                    }

                }


            }
        }
    }

</style>
