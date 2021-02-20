<template>
    <section class="avatar">

        <div class="helper"></div><!--
        --><div class="drop display-inline align-center" @dragover.prevent @drop="onDrop">
        <div class="custom__preview" v-if="!image">
            <img class="custom__preview__logo" src="../assets/icons/avatar_logo.svg" alt="">
            <p class="custom__preview__title">Перетащите фотографию сюда  или нажмите:</p>
        </div>

        <div  class="helper"></div><!--

    --><label v-if="!image" class="btn display-inline choose">
        Выберите файл
        <input type="file" name="image" @change="onChange" accept="image/*">


        </label><!--
          --><div class="hidden display-inline align-center" v-else v-bind:class="{ 'image': true }">
        <div class="image__wrap">
            <img :src="image" alt="" class="img" />
            <br>
            <br>
        </div>

        <button class="btn__edit" type="file" @change="onChange"><img src="../assets/icons/edit_logo.svg" alt="">
            <input type="file" name="image" @change="onChange" accept="image/*">
        </button>

        <button class="btn__remove" @click="removeFile">
            <img src="../assets/icons/remove_logp.svg" alt="">
        </button>

        </div>
            </label>

        </div>

    </section>
</template>

<script>
    export default {
        name: "Avatar",
        props: ['imageURL'],

        data() {
            return {
                imageL: '',
                change: false
            }
        },


        computed: {
            image() {

                if (this.imageURL && !this.change ) {
                    return this.imageURL
                }

                return this.imageL
            }
        },

        methods: {
            onDrop: function(e) {
                e.stopPropagation();
                e.preventDefault();
                var files = e.dataTransfer.files;
                this.createFile(files[0]);
            },

            onChange(e) {
                var files = e.target.files;
                this.createFile(files[0])
                this.change = true
            },

            async createFile(file) {

                var img = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function(e) {
                    vm.imageL = e.target.result;
                    console.log(e.target.result)
                    vm.$emit('setImg', vm.image)
                };

                reader.readAsDataURL(file);
            },

            removeFile() {
                this.change = true;
                this.imageL = '';
                this.$emit('setImg', '')
            }
        }
    }
</script>

<style lang="scss" scoped>
    .avatar {
        width: 185px;
        margin: 0 auto;
    }

    .drop {
        margin: 0 auto;
        height: 240px;
        width: 185px;

        background-color: #AEA4A1;
        border-radius: 10px;
    }
    .custom__preview {
        margin-top: 40px;

        color: white;
        font-size: 14px;
        line-height: 17px;

        &__logo {
            margin: 0 auto;
        }

        &__title {
            margin-top: 25px;
            padding: 0 40px;
        }
    }

    .btn {
        margin-top: 15px;
        font-size: 14px;

        background-color: white;
        color: black;
        border: 0;
        cursor: pointer;
        display: inline-block;
        font-weight: bold;
        padding: 3px 7px;
        border-radius: 5px;
        position: relative;

        &.choose {
            min-height: 25px;
            max-width: 130px;
        }

        &__remove, &__edit {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;

            box-shadow: 0 0 10px rgba(0,0,0, 0.8);

            input {
                height: 100%;
                top: 0;
                position: absolute;
                opacity: 0;
                z-index: 1 !important;
                width: 100%;
                left: 0;
                cursor: pointer;
            }

            img {
                margin: auto;
                cursor: pointer;
            }
        }

        &__remove {
            bottom: -20px;
            right: 40px;
        }

        &__edit {
            bottom: -20px;
            left: 40px;
        }
    }

    .btn:hover {
        opacity: 0.8;
    }

    input[type="file"] {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }

    .align-center {
        text-align: center;
    }

    .helper {
        display: inline-block;
        vertical-align: middle;
        width: 0;
    }

    .hidden {
        display: none !important;
    }

    .hidden {
        height: 100%;
        width: 100%;
        display: inline-block !important;
        position: relative;
    }

    .display-inline {
        display: inline-block;
        vertical-align: middle;
    }

    .image__wrap {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .img {
        object-fit: cover;
        width: 100%;
        height: 100%;

        border-radius: 10px;
        display: inline-block;

    }



</style>
