<template>
    <section class="navigation">
        <HeaderAuth v-if="!isLoggedIn"/>
        <HeaderNoneAuth v-else/>
    </section>
</template>

<script>
    import SelectCustom from "./SelectCustom";
    import HeaderAuth from "./HeaderAuth";
    import HeaderNoneAuth from "./HeaderNoneAuth";

    export default {
        name: "Header",
        components: {HeaderAuth, SelectCustom, HeaderNoneAuth},

        data() {
            return {
                auth: false,
                value:"Москва",
                cities: ['Москва', 'Киев', 'Санкт-Петербург'],
                isActive: true,
                // profile: {}
                // user: {
                //     // name: 'Леонид',
                //     // surname: 'Терехов'
                // }

            }
        },

        mounted() {
        },

        computed: {
            isLoggedIn : function(){
                return this.$store.getters['isLoggedIn']
            },
        },

        methods: {
            logout() {
                this.$store.dispatch('logout')

                this.$store.dispatch('logout')
                    .then(() => this.$router.push('/'))
                    .catch(err => console.log(err))
            },

            getUser() {
                if(this.isLoggedIn) {
                }

            }
        },
    }
</script>

<style lang="scss" scoped>
    @import "../assets/variables";

.selected {
    background: #2c3e50 !important;
}

.navigation {
    max-width: 100%;
    min-height: 40px;
    z-index: -1;
    font-size: 16px;

    padding: 8px 50px;

    color: $white;
    background: $white;
    background: linear-gradient(45deg, black, transparent);

    .region__city {
        background: none;
        border: none;
        color: $white;
    }

    &__auth  {
        display: flex;
        justify-content: space-between;

        &__region {
        }

        &__cabinet {
        }
    }

    &__auth-none {
        display: flex;
        justify-content: space-between;

        &-left {

        }

        &-right {
            display: flex;
        }
    }

    &__link {
        display: flex;
        margin: 0 25px;

        &__title {
            margin-left: 25px;
        }
    }

    &__logout {
        margin-left: 25px;
    }

}

/* Reset Select */
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-shadow: none;
    border: 0 !important;
    background: transparent;
    background-image: none;
}
/* Remove IE arrow */
select::-ms-expand {
    display: none;
}
/* Custom Select */
.select {
    position: relative;
    display: flex;
    /*display: inline-block;*/
    width: 15em;
    /*height: 3em;*/
    line-height: 3;
    background: transparent;
    overflow: hidden;
    /*border-radius: .25em;*/
}
select {
    flex: 1;
    /*padding: 0 .5em;*/
    color: $white;
    cursor: pointer;
}
/* Arrow */
.select::after {
    content: '\25BC';
    position: absolute;
    top: 0;
    right: 0;
    padding: 0 1em;
    /*background: #34495e;*/
    background: transparent;
    cursor: pointer;
    pointer-events: none;
    -webkit-transition: .25s all ease;
    -o-transition: .25s all ease;
    transition: .25s all ease;
}
/* Transition */
.select:hover::after {
    color: $base-color;
}

.select__option {
    outline: none;
    background: $base-color;
    color: #000;
    &:hover {
        background-color: #2c3e50;
    }
}

</style>
