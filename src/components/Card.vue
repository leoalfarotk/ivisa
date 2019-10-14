<template>
  <b-card tag="article" class="card-container mb-2" img-src="">
    <b-card-text>
      <b-row>
        <b-col sm="2" xs="1">
          <b-checkbox
            :disabled="true"
            :checked="is_default"
            class="default-card-checkbox"
          ></b-checkbox>
        </b-col>
        <b-col sm="10 xs=11">
          <b-row>
            <b-col order="1" order-md="1">
              <CardImage :provider="provider" />
            </b-col>
            <b-col order="3" order-md="2" xs="12">
              <span v-if="provider === this.$store.state.VISA">
                Visa
              </span>
              <span v-else-if="provider === this.$store.state.MASTER_CARD">
                Master Card
              </span>
              <span v-else-if="provider === this.$store.state.AMERICAN_EXPRESS">
                American Express
              </span>
              <span v-else>
                Tarjeta desconocida
              </span>
              {{ number }}
              <br />
              Ex.Date: {{ expiration_date }}
            </b-col>
            <b-col order="4" order-md="3" xs="12">
              <b-button
                variant="link"
                @click.prevent="markAsDefault"
                v-b-modal="'set-default-modal'"
                >Set as default</b-button
              >
            </b-col>
            <b-col order="2" order-md="4" xs="5">
              <b-button
                variant="danger"
                class="remove-card-button"
                @click.prevent="markForRemoval"
                v-b-modal="'remove-modal'"
                >Remove</b-button
              >
            </b-col>
          </b-row>
        </b-col>
      </b-row>
    </b-card-text>
  </b-card>
</template>

<script>
import CardImage from "./CardImage";
export default {
  name: "Card",
  components: { CardImage },
  props: {
    card_id: {
      type: Number,
      default: null
    },
    provider: {
      type: Number,
      default: null
    },
    number: {
      type: String,
      default: "**** **** ****"
    },
    expiration_date: {
      type: Date,
      default: null
    },
    is_default: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    markAsDefault() {
      this.$store.commit("myCards/setSelectedCardId", this.card_id);
    },
    markForRemoval() {
      this.$store.commit("myCards/setSelectedCardId", this.card_id);
    }
  }
};
</script>

<style lang="scss">
@import "../styles/components/Card.scss";
</style>
