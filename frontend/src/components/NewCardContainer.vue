<template>
  <b-card align="left" class="mt-4 wrapper-father">
    <b-card-title @click="toggleForm">
      + Add New Card
    </b-card-title>

    <hr v-if="show_form" />

    <b-card-text v-show="show_form">
      <b-row class="justify-content-center">
        <b-col cols="2" md="1">
          <img
            src="../assets/images/Ok green ico.svg"
            alt="New Card Green Checkbox Icon"
            id="new_card_check_mark"
          />
        </b-col>
        <b-col cols="6" md="2">
          <span id="accepted_cards_text">
            We Accept All Major
            <br />
            Debit / Credit Cards
          </span>
        </b-col>
        <b-col cols="12" md="9">
          <img src="../assets/images/Payment-methods.jpg" />
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <NewCardForm />
        </b-col>
      </b-row>
    </b-card-text>
  </b-card>
</template>

<script>
import NewCardForm from "./NewCardForm";

export default {
  name: "NewCardContainer",
  components: { NewCardForm },
  data: function() {
    return {
      show_form: false
    };
  },
  methods: {
    toggleForm() {
      this.show_form = !this.show_form;
    }
  }
};
</script>

<style scoped lang="scss">
h4.card-title {
  color: $second_blue;
}

#new_card_check_mark {
  max-width: 40px;
}

#accepted_cards_text {
  font-family: Arial, sans-serif;
  color: $green;
}
</style>
