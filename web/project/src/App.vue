<template>
  <div id="app">

    <Header/>

    <router-view/>

    <flash-message></flash-message>




  </div>
</template>

<script>
  import Header from "./components/Header";
  import router from "./router";
  import store from "./store";
  require('vue-flash-message/dist/vue-flash-message.min.css');



  export default {
    name: "App",
    components: {Header},

    mounted() {
    }

  }



</script>


<style lang="scss">
@import "assets/main.scss";
@import "assets/variables.scss";

/* Указываем box sizing */
*,
*::before,
*::after {
  box-sizing: border-box;
}

/* Убираем внутренние отступы */
ul[class],
ol[class] {
  padding: 0;
}

/* Убираем внешние отступы */
body,
h1,
h2,
h3,
h4,
p,
ul[class],
ol[class],
li,
figure,
figcaption,
blockquote,
dl,
dd {
  margin: 0;
}

/* Выставляем основные настройки по-умолчанию для body */
body {
  min-height: 100vh;
  scroll-behavior: smooth;
  text-rendering: optimizeSpeed;
  line-height: 1.5;

  /* background */
  padding: 0;
  margin: 0;
  background: rgb(63,28,20);
  background: linear-gradient(218.14deg, #3F1C14 0.57%, $base-color 43.26%, $base-color 58.57%, #3F1C14 102.23%);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#3f1c14",endColorstr="#3f1c14",GradientType=1);

}

/* Удаляем стандартную стилизацию для всех ul и il, у которых есть атрибут class*/
ul[class],
li[class],
ol[class] {
  list-style: none;
}

/* Элементы a, у которых нет класса, сбрасываем до дефолтных стилей */
/*a:not([class]) {*/
a {
  text-decoration-skip-ink: auto;
  text-decoration: none;
  color: $white;
  &:visited {

  }

  &:active {
    text-decoration: underline;
    color: $base-color;
  }

  &:hover {
    text-decoration: none;
    color: #9C2A16;
  }
}


/* Упрощаем работу с изображениями */
img {
  max-width: 100%;
  display: block;
}

/* Указываем понятную периодичность в потоке данных у article*/
article > * + * {
  margin-top: 1em;
}

/* Наследуем шрифты для инпутов и кнопок */
input,
textarea,
select {
  font: inherit;
}

button {
  padding: 0;
  border: none;
  font: inherit;
  color: inherit;
  background-color: transparent;
  cursor: pointer;

  &:disabled {
    opacity: 0.8;
    cursor: not-allowed !important;

    &:hover {
      box-shadow: none !important;
    }
  }


}

#app {
  font-family: "Roboto", "Roboto Slab", sans-serif;
  smoothing: antialiased;
  font-smoothing: grayscale;
}

#nav {
  padding: 30px;

}

/*Уведомления*/
.flash__message {
  position: absolute;
  bottom: 0;
  right: 10px;
}

</style>
