<template>
  <b-card title="My Cards" align="left" class="mb-4">
    <hr />
    <template v-slot:header>
      <b-nav card-header tabs>
        <b-nav-item disabled>MY APPLICATIONS</b-nav-item>
        <b-nav-item disabled>MY TRAVELERS</b-nav-item>
        <b-nav-item active>MY CARDS</b-nav-item>
        <b-nav-item disabled>MY ACCOUNT</b-nav-item>
      </b-nav>
    </template>

    <b-card-text>
      <Card
        v-for="card in myCards"
        :key="card.id"
        :card_id="card.id"
        :provider="card.provider_id"
        :number="card.number"
        :expiration_date="card.expiration_date"
        :is_default="card.is_default"
      />
    </b-card-text>

    <b-modal
      id="set-default-modal"
      @ok="confirmAsDefault"
      @cancel="clearSelected"
      title="BootstrapVue"
    >
      <p class="my-4">Hello from modal!</p>
    </b-modal>

    <b-modal
      id="remove-modal"
      @ok="confirmForRemoval"
      @cancel="clearSelected"
      title="BootstrapVue"
    >
      <p class="my-4">Hello from modal!</p>
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
    this.$store.dispatch("myCards/loadCards");
  }
};
</script>

<style scoped lang="scss">
h4.card-title {
  color: $second_blue;
}
</style>
