import Vue from 'vue'
import vueCustomElement from 'vue-custom-element'

Vue.use(vueCustomElement)

Vue.customElement('widget-vue', {
  props: [
    'prop1',
    'prop2',
    'prop3'
  ],
  data () {
    return {
      message: 'Hello Vue!'
    }
  },
  template: '<p>{{ message }}, {{ prop1  }}, {{prop2}}, {{prop3}}</p>'
})
