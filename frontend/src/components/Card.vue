<template>
  <b-card tag="article" class="card-container mb-2">
    <b-card-text>
      <b-row>
        <b-col sm="1" cols="2" class="vertical-center">
          <img
            src="../assets/images/Ok green ico.svg"
            v-if="is_default"
            class="default-checkbox"
          />
          <img
            src="../assets/images/Ok grey ico.svg"
            v-else
            class="not-default-checkbox"
          />
        </b-col>
        <b-col sm="11" cols="10">
          <b-row>
            <b-col
              id="card-image"
              order="1"
              order-md="1"
              cols="5"
              sm="2"
              lg="2"
              class="vertical-center"
            >
              <CardImage :provider="provider" />
            </b-col>

            <b-col
              id="text-column"
              order="3"
              order-md="2"
              cols="12"
              sm="4"
              lg="5"
            >
              <div>
                <span v-if="provider === this.$store.state.VISA">Visa</span>
                <span v-else-if="provider === this.$store.state.MASTER_CARD"
                  >Master Card</span
                >
                <span
                  v-else-if="provider === this.$store.state.AMERICAN_EXPRESS"
                  >American Express</span
                >
                <span v-else>Tarjeta desconocida</span>
                {{ number }}
              </div>

              <div>
                Ex.Date: {{ expiration_date }}

                <br class="mobile-break" />

                <span v-if="is_default" class="default-text">
                  Default card
                </span>
              </div>
            </b-col>

            <b-col
              id="set-as-default"
              order="4"
              order-md="3"
              cols="12"
              sm="3"
              lg="3"
            >
              <b-button
                variant="link"
                @click.prevent="markAsDefault"
                v-b-modal="'set-default-modal'"
                v-if="!is_default"
                class="set-default-text"
                >Set as default</b-button
              >
            </b-col>
            <b-col
              id="remove-button"
              order="2"
              order-md="4"
              cols="7"
              sm="2"
              lg="2"
            >
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
    exp_month: {
      type: Number,
      default: 0
    },
    exp_year: {
      type: Number,
      default: 0
    },
    is_default: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    expiration_date() {
      let str = "" + this.exp_month;
      let pad = "00";
      let month = pad.substring(0, pad.length - str.length) + str;

      str = "" + this.exp_year;
      pad = "0000";
      let year = pad.substring(0, pad.length - str.length) + str;

      return month + "/" + year;
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
