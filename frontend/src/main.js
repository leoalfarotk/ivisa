import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import axios from "axios";

Vue.use({
  install(Vue) {
    Vue.prototype.$axios = axios.create({
      baseURL: "http://localhost:8000/api",
      headers: {
        "X-Requested-With": "XMLHttpRequest"
      }
    });
  }
});

import BootstrapVue from "bootstrap-vue";

Vue.use(BootstrapVue);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
