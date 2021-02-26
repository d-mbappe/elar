<template>
    <section class="modal">
        <div  class="modal__overlay">
            <div class="cropper-wrapper">
                <button @click="hide" class="btn white close">
                    <img src="../assets/cropper/close.png" alt="">
                </button>
                <div :style="{backgroundImage: 'url(' + imgBg + ')'}" class="image-background"></div>
                <cropper :src="image"
                         ref="cropper"
                         @change="onChange"
                         class="cropper"
                         imageClass="image"
                         backgroundClass="cropper-background"
                         imageRestriction="none"
                         :stencil-props="{
                            aspectRatio: 3/4,
                        }"
                />

                <div class="cropper__btn">
                    <button class="btn white change" @click="rotate(-90, )">
                        <img src="../assets/cropper/rotate.png" alt="">
                    </button>
                    <button class="btn white change" @click="rotate(90, )">
                        <img class="rotateR" src="../assets/cropper/rotate.png" alt="">
                    </button>
                    <button class="btn white change" @click="zoom(2)">
                        <img  src="../assets/cropper/plus.png" alt="">
                    </button>
                    <button class="btn white change" @click="zoom(0.5)">
                        <img src="../assets/cropper/minus.png" alt="">
                    </button>

                    <button class="btn white change" title="Move Top" @click="move('left')">
                        <img class="left" src="../assets/cropper/arrow.png" alt="">
                    </button>
                    <button class="btn white change" title="Move Left" @click="move('right')">
                        <img src="../assets/cropper/arrow.png" alt="">
                    </button>
                    <button class="btn white change" title="Move Right" @click="move('top')">
                        <img class="top" src="../assets/cropper/arrow.png" alt="">
                    </button>
                    <button class="btn white change" title="Move Bottom" @click="move('bottom')">
                        <img class="bottom" src="../assets/cropper/arrow.png" alt="">
                    </button>

                    <button class="btn white change" title="Move Bottom" @click="reset" >
                        <img class="reload" src="../assets/cropper/reload.png" alt="">
                    </button>

                    <button class="save" title="Move Bottom" @click="setImage" >
                        Загрузить
                    </button>
                </div>
            </div>

        </div>

    </section>

</template>

<script>
    import { Cropper } from 'vue-advanced-cropper';
    import 'vue-advanced-cropper/dist/style.css';


    export default {
        name: "CropImage",
        components: {
            Cropper,
        },

        props: {
            img: ''
        },
        data() {
            return {
                // img: 'https://images.pexels.com/photos/4323307/pexels-photo-4323307.jpeg',
                // img: 'data:image/jpeg;base64,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',
                imgBg: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC',

                image: this.img,
                result: {
                    coordinates: null,
                    image: null
                },

            };
        },
        methods: {
            setImage() {
                const result = this.$refs.cropper.getResult().canvas.toDataURL();
                this.$emit('setImg', result)
                // const result = this.$refs.cropper.getResult().canvas.toDataURL();
                // console.log('ressssssssssssssss',result)
                // const newTab = window.open();
                // newTab.document.body.innerHTML = `<img src="${result}"></img>`;
            },

            hide() {
                this.$emit('hideModal')
            },

            onChange({ coordinates, image }) {
                this.result = {
                    coordinates,
                    image
                };
            },

            flip(x,y) {
                this.$refs.cropper.flip(x,y);
            },

            rotate(angle) {
                this.$refs.cropper.rotate(angle);
            },

            zoom(factor) {
                this.$refs.cropper.zoom(factor);
            },

            move(direction) {
                if (direction === 'left') {
                    this.$refs.cropper.move(-this.result.coordinates.width /8);
                } else if (direction === 'right') {
                    this.$refs.cropper.move(this.result.coordinates.width /8);
                } else if (direction === 'top') {
                    this.$refs.cropper.move(0, -this.result.coordinates.height / 8);
                } else if (direction === 'bottom') {
                    this.$refs.cropper.move(0, this.result.coordinates.height / 8);
                }
            },

            reset() {
                this.$refs.cropper.reset()
            }
        },
    };
</script>
<style lang="scss">

    $base-color: #367DBF;
    @import '~vue-advanced-cropper/dist/theme.classic.scss';

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 99999999999999;

        &__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            z-index: 1;
        }
    }

    .cropper-wrapper {
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        max-width: 1280px;
        min-height: 500px;
        max-height: 700px;
        background: black;

        top: 50%;
        transform: translateY(-50%);
    }

    .cropper__btn {
        position: absolute;
        display: flex;
        bottom: 0;
        left: 25%;
        align-items: center;
    }
    .cropper-background {
        background: none !important;
        min-height: 800px !important;
    }
    .image-background {
        position: absolute;
        width: calc(100% + 20px);
        height: calc(100% + 20px);
        left: -10px;
        top: -10px;
    }

    .vue-advanced-cropper__image-wrapper {
        height: 700px;
    }

    .vue-advanced-cropper__foreground {
        transform: none;
        top: 0;
        left: 0;
        height: 700px !important;
    }

    .image {
        border-radius: 20px ;
    }

    .btn.white.change {
        width: 40px;
        min-height: 40px;
        border-radius: 50%;

        img {
            margin: 0 auto;

            &.rotateR {
                transform: rotateY(180deg);
            }

            &.left {
                transform: rotateY(180deg);
            }

            &.top {
                transform: rotateZ(-90deg);
            }

            &.bottom {
                transform: rotateZ(90deg);
            }
        }
    }

    .btn.white.close {
        width: 20px;
        min-height: 20px;
        margin: 0;
        border-radius: 50%;
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 1;

        img {
            margin: 0 auto;
        }
    }

    .save {
        width: 120px;
        margin-left: 10px ;

        background-color: #1C9700;
        border-radius: 100px;
        min-height: 40px;
        color: white;
    }

</style>
