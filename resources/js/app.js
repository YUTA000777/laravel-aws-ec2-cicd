import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import Paginate from './components/Paginate'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    Paginate
  }
})
