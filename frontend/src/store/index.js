import Vue from "vue";
import Vuex from "vuex";
import MyCards from "./modules/MyCards";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    access_token: "",
    VISA: 1,
    MASTER_CARD: 2,
    AMERICAN_EXPRESS: 3
  },
  mutations: {
    setAccessToken(state, access_token) {
      state.access_token = access_token;
    }
  },
  modules: {
    myCards: MyCards
  }
});
