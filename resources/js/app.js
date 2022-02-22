// require('./bootstrap');

import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import InertiaTable from 'inertia-table'
Vue.use(InertiaTable);

InertiaProgress.init()

Vue.component('Link', Link)

createInertiaApp({
  resolve: name => import(`./Pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})
