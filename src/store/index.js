import Vue from "vue";
import Vuex from "vuex";
import MyCards from "./modules/MyCards";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    VISA: 1,
    MASTER_CARD: 2,
    AMERICAN_EXPRESS: 3
  },
  modules: {
    myCards: MyCards
  }
});
