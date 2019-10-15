<template>
  <div>
    <template v-if="provider === this.$store.state.VISA">
      <img src="../assets/images/Visa Card Logo.svg" alt="Visa Logo" />
    </template>

    <template v-if="provider === this.$store.state.MASTER_CARD">
      <img src="../assets/images/Master Card Logo.svg" alt="Master Card Logo" />
    </template>

    <template v-if="provider === this.$store.state.AMERICAN_EXPRESS">
      <img
        src="../assets/images/Amex Card logo.svg"
        alt="American Express Logo"
      />
    </template>
  </div>
</template>

<script>
export default {
  name: "CardImage",
  props: {
    provider: {
      type: Number,
      default: null
    }
  }
};
</script>

<style scoped>
img {
  width: 91px;
}

@media screen and (max-width: 599.95px) {
  img {
    width: 59px;
  }
}
</style>
