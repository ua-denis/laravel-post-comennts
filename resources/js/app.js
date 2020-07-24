
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import store from './store';

Vue.use(Vuetify);

Vue.component('post-comments', require('./components/PostComments.vue').default);
/*Vue.component('comments', require('./components/Comments.vue').default);*/

const app = new Vue({
    store,
    vuetify: new Vuetify(),
    el: '#post-comments-section',
});
