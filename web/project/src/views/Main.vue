<template>
    <section>
        <cropper
                :src="img"
                ref="cropper"
                @change="onChange"
                class="cropper"
        />
        <button @click="rotate(-90, )">left</button>
        <button @click="rotate(90, )">right</button>
    </section>

</template>

<script>
    import { Cropper } from 'vue-advanced-cropper';
    // import 'vue-advanced-cropper/dist/theme.classic.css';
    import 'vue-advanced-cropper/dist/style.css';


    export default {
        components: {
            Cropper,
        },
        data() {
            return {
                // img: 'https://images.unsplash.com/photo-1590291409749-452efbe0d76c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80',
                img: 'https://images.pexels.com/photos/4323307/pexels-photo-4323307.jpeg',

                result: {
                    coordinates: null,
                    image: null
                }
            };
        },
        methods: {
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
        },
    };
</script>
<style lang="scss" scoped>

    /*@import '~vue-advanced-cropper/dist/theme.classic.css';*/


    .cropper {
        height: 600px;
        background-color: black;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC);
        /*opacity: .9;*/

    }

    .сс {
        background-color: black;
        opacity: .2;
    }
</style>
