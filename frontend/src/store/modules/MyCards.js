const MyCards = {
  namespaced: true,
  state: {
    cards: [],
    selected_card_id: null
  },
  mutations: {
    setCards(state, cards) {
      state.cards = cards;
    },
    removeCardById(state, card_id) {
      // In case of success
      // eslint-disable-next-line no-unused-vars
      state.cards = state.cards.filter(card => {
        return card.id !== card_id;
      });
    },
    addCard(state, card_object) {
      state.cards.push(card_object);
    },
    setNewDefault(state, card_id) {
      state.cards.some((card, index, array) => {
        if (card.is_default) {
          array[index].is_default = false;
          return true;
        }

        return false;
      });

      state.cards.some((card, index, array) => {
        if (card.id === card_id) {
          array[index].is_default = true;
          return true;
        }

        return false;
      });
    },
    clearSelectedCard(state) {
      state.selected_card_id = null;
    },
    setSelectedCardId(state, card_id) {
      state.selected_card_id = parseInt(card_id);
    }
  },
  actions: {
    loadCards(context) {
      this._vm.$axios.get("cards").then(response => {
        context.commit("setCards", response.data.cards);
      });

      // Static data for now
      /*let cards = [
        {
          id: 1,
          provider_id: context.rootState.AMERICAN_EXPRESS,
          number: "**** **** 9786",
          exp_month: 1,
          exp_year: 2024,
          is_default: true
        },
        {
          id: 2,
          provider_id: context.rootState.VISA,
          number: "**** **** 4950",
          exp_month: 11,
          exp_year: 2022,
          is_default: false
        },
        {
          id: 3,
          provider_id: context.rootState.VISA,
          number: "**** **** 4567",
          exp_month: 7,
          exp_year: 2023,
          is_default: false
        }
      ];

      context.commit("setCards", cards);*/
    },
    saveNewCard(context, new_card_object) {
      this._vm.$axios.post("save", new_card_object).then(response => {
        new_card_object.id = response.data.card_id;
        new_card_object.provider_id = response.data.provider_id;
        //context.commit("addCard", { ...new_card_object });
        context.dispatch("loadCards");
      });
    },
    setSelectedAsDefault(context) {
      // POST request
      // if successful
      context.commit("setNewDefault", context.state.selected_card_id);
      context.commit("clearSelectedCard");
    },
    deleteSelectedCard(context) {
      // POST request to delete card from the database

      // if request is successful
      context.commit("removeCardById", context.state.selected_card_id);
      context.commit("clearSelectedCard");
    }
  }
};
export default MyCards;
