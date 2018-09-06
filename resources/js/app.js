require('./bootstrap');

window.Vue = require('vue');

Vue.use(require("vee-validate"));

Vue.component("categories-list", require("./components/categories/list"));
Vue.component("categories-form", require("./components/categories/form"));
Vue.component("posts-list", require("./components/posts/list"));
Vue.component("posts-form", require("./components/posts/form"));
Vue.component("comments-form", require("./components/comments/form"));
Vue.component("visits-counter", require("./components/visits/counter"));

const app = new Vue({
    el: '#app'
});
