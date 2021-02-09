<template>
    <section class="navigation">
        <!--         <div v-if="auth"-->
         <div v-if="!isLoggedIn1"

              class="navigation__auth"
         >
            <div class="navigation__auth__region">
                <label for="city" class="region__title">Ваш регион: </label>
                <SelectCustom id="city" v-model="value" :select-list="cities"/>

            </div>
             <div class="navigation__auth__cabinet">
                 <a href="#">Личный кабинет</a>
             </div>
         </div>

         <div v-else
              class="navigation__auth-none"
         >
             <div class="navigation__auth-none-left">
                 <ul class="navigation__link">
                     <li class="navigation__link__title"><a href="">Записаться в колонну</a></li>
                     <li class="navigation__link__title"><a href="">Список колонн</a></li>
                     <li class="navigation__link__title"><a href="">Мои анкеты</a></li>
                     <li class="navigation__link__title"><a href="">О проекта</a></li>
                 </ul>
             </div>

             <div class="navigation__auth-none-right">
                 <div class="navigation__user"><a href="">{{profile1.surname}} {{profile1.name}}</a></div>

                 <div class="navigation__logout"><button @click="logout">Выйти</button></div>

                 <div class="navigation__social">
             </div>


             </div>

         </div>
    </section>
</template>

<script>
    import SelectCustom from "./SelectCustom";
    import { mapGetters } from 'vuex';

    export default {
        name: "NavigationMenu",
        components: {SelectCustom},

        data() {
            return {
                auth: false,
                value:"Москва",
                cities: ['Москва', 'Киев', 'Санкт-Петербург'],
                isActive: true,
                isLoggedIn: '',
                // profile: {}
                // user: {
                //     // name: 'Леонид',
                //     // surname: 'Терехов'
                // }

            }
        },

        mounted() {
            console.log('moubt')
            console.log(this.profile1);
            console.log(this.isLoggedIn)
            // this.getUser();
          // this.isLoggedIn ? this.user = this.$store.dispatch('getUser') : '' ;
        },

        computed: {
            ...mapGetters({
                isLoggedIn1: 'isLoggedIn',
                profile1: 'profile'
            })
            // isLoggedIn : function(){
            //     return this.$store.getters['isLoggedIn']
            // },

            // profile: function () {
            //     return this.$store.getters['profile']
            // }

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
                    // this.user = this.$store.dispatch('getUser');
                    // console.log(111)
                    // console.log(this.user)
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
            /*padding: 8px 50px;*/
        }

        &__cabinet {
            /*padding: 8px 50px;*/
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
