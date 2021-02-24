<template>
    <section>

        <div class="cropper-wrapper">
            <div :style="{backgroundImage: 'url(' + imgBg + ')'}" class="image-background"></div>
            <cropper :src="img"
                     ref="cropper"
                     @change="onChange"
                     class="cropper"
                     imageClass="image"
                     background-class="cropper-background"
            />
        </div>
        <button class="btn white change" @click="rotate(-90, )">rotateL</button>
        <button class="btn white change" @click="rotate(90, )">rotateR</button>
        <button class="btn white change" @click="zoom(2)">+</button>
        <button class="btn white change" @click="zoom(0.5)">-</button>

        <button class="btn white change" title="Move Top" @click="move('top')">
           top
        </button>
        <button class="btn white change" title="Move Left" @click="move('left')">
            left
        </button>
        <button class="btn white change" title="Move Right" @click="move('right')">
            right
        </button>
        <button class="btn white change" title="Move Bottom" @click="move('bottom')">
            bottom
        </button>

    </section>

</template>

<script>
    import { Cropper } from 'vue-advanced-cropper';
    import 'vue-advanced-cropper/dist/style.css';


    export default {
        components: {
            Cropper,
        },
        data() {
            return {
                img: 'https://images.pexels.com/photos/4323307/pexels-photo-4323307.jpeg',
                imgBg: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC',

                result: {
                    coordinates: null,
                    image: null
                },

            };
        },
        methods: {
            test(left, top) {
                this.$refs.cropper.move(left, top);
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
                    this.$refs.cropper.move(-this.result.coordinates.width );
                } else if (direction === 'right') {
                    this.$refs.cropper.move(this.result.coordinates.width );
                } else if (direction === 'top') {
                    this.$refs.cropper.move(0, -this.result.coordinates.height / 4);
                } else if (direction === 'bottom') {
                    this.$refs.cropper.move(0, this.result.coordinates.height / 4);
                }
            },
        },
    };
</script>
<style lang="scss">

$base-color: #367DBF;
@import '~vue-advanced-cropper/dist/theme.classic.scss';

    .cropper-wrapper {
        overflow: hidden;
        position: relative;
        height: 700px;
        background: black;
    }
    .cropper-background {
        background: none !important;
    }
    .image-background {
        position: absolute;
        width: calc(100% + 20px);
        height: calc(100% + 20px);
        left: -10px;
        top: -10px;
    }

    .image {
        border-radius: 20px ;
    }

    .btn.white.change {
        width: 40px;
        margin: 10px;
    }

</style>
