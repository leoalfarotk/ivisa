<template>
  <b-card title="My Cards" align="left" class="mb-4" id="cards-container">
    <hr />
    <template v-slot:header>
      <b-nav card-header tabs align="center">
        <b-nav-item disabled>
          <img
            src="../assets/images/My applications ico.svg"
            class="navbar-icon"
            alt="My Applications"
          />
          <span class="desktop-only">
            MY APPLICATIONS
          </span>
        </b-nav-item>
        <b-nav-item disabled>
          <img
            src="../assets/images/My travelers ico.svg"
            class="navbar-icon"
            alt="My Travelers"
          />
          <span class="desktop-only">
            MY TRAVELERS
          </span>
        </b-nav-item>
        <b-nav-item active>
          <img
            src="../assets/images/My cards ico.svg"
            class="navbar-icon"
            alt="My Cards"
          />
          <span class="desktop-only"> MY CARDS </span>>
        </b-nav-item>
        <b-nav-item disabled>
          <img
            src="../assets/images/My Account ico.svg"
            class="navbar-icon"
            alt="My Account"
          />
          <span class="desktop-only"> MY ACCOUNT </span>>
        </b-nav-item>
      </b-nav>
    </template>

    <b-card-text>
      <Card
        v-for="card in myCards"
        :key="card.id"
        :card_id="card.id"
        :provider="card.provider_id"
        :number="card.number"
        :exp_month="card.exp_month"
        :exp_year="card.exp_year"
        :is_default="card.is_default"
      />

      <div v-if="myCards.length === 0" style="text-align: center;">
        You have no cards, yet.
      </div>
    </b-card-text>

    <b-modal
      ok-title="Yes"
      id="set-default-modal"
      @ok="confirmAsDefault"
      @cancel="clearSelected"
    >
      <template v-slot:modal-header-close class="close">
        ×
      </template>
      <template v-slot:modal-title>
        <img
          src="../assets/images/Default card ico.svg"
          alt="Default Card Icon"
          class="modal-icon"
        />

        <br />

        <div class="custom-modal-title">
          Change default card
        </div>
      </template>
      <p class="my-4">
        This card will appear as a primary option for your payment. Are you sure
        you want to set this card as default?
      </p>

      <template v-slot:modal-footer="{ ok, cancel, hide }">
        <b-button variant="success" @click="ok()">
          Yes
        </b-button>
        <b-button variant="secondary" @click="cancel()">
          Cancel
        </b-button>
      </template>
    </b-modal>

    <b-modal
      ok-title="Yes"
      id="remove-modal"
      @ok="confirmForRemoval"
      @cancel="clearSelected"
    >
      <template v-slot:modal-header-close class="close">
        ×
      </template>
      <template v-slot:modal-title>
        <img
          src="../assets/images/Remove payment ico.svg"
          alt="Default Card Icon"
          class="modal-icon"
        />

        <br />

        <div class="custom-modal-title">
          Remove card
        </div>
      </template>
      <p class="my-4">
        Are you sure you want to remove from wallet?
      </p>

      <template v-slot:modal-footer="{ ok, cancel, hide }">
        <b-button variant="success" @click="ok()">
          Yes
        </b-button>
        <b-button variant="secondary" @click="cancel()">
          Cancel
        </b-button>
      </template>
    </b-modal>
  </b-card>
</template>

<script>
import Card from "./Card";
export default {
  name: "CardsContainer",
  components: { Card },
  computed: {
    myCards() {
      return this.$store.state.myCards.cards;
    }
  },
  methods: {
    confirmAsDefault() {
      this.$store.dispatch("myCards/setSelectedAsDefault");
    },
    confirmForRemoval() {
      this.$store.dispatch("myCards/deleteSelectedCard");
    },
    clearSelected() {
      this.$store.commit("myCards/clearSelectedCard");
    }
  },
  mounted() {
    this.$axios
      .post("login", {
        email: "test@email.com",
        password: "123456"
      })
      .then(response => {
        this.$store.commit("setAccessToken", response.data.access_token);

        this.$axios.interceptors.request.use(
          config => {
            let token = this.$store.state.access_token;

            if (token) {
              config.headers["Authorization"] = `Bearer ${token}`;
            }

            return config;
          },

          error => {
            return Promise.reject(error);
          }
        );

        this.$store.dispatch("myCards/loadCards");
      });
  }
};
</script>

<style lang="scss">
@import "../styles/components/CardsContainer.scss";
</style>
