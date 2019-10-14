<template>
  <span>
    <span v-if="provider === this.$store.state.VISA">
      <img src="../assets/images/Visa Card Logo.svg" alt="Visa Logo" />
    </span>

    <span v-if="provider === this.$store.state.MASTER_CARD">
      <img src="../assets/images/Master Card Logo.svg" alt="Master Card Logo" />
    </span>

    <span v-if="provider === this.$store.state.AMERICAN_EXPRESS">
      <img
        src="../assets/images/Amex Card logo.svg"
        alt="American Express Logo"
      />
    </span>
  </span>
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
  max-width: 150px;
}
</style>
