import Vue from 'vue'
import vueCustomElement from 'vue-custom-element'
import Example from './Example'

Vue.use(vueCustomElement)

Vue.customElement('widget-vue', Example)
