<template>
  <div>
    <b-form>
      <div class="row wrapper-new-card">
        <div class="col-md-3">
          <label for="name_on_card">Name On Card</label>
          <b-input
            id="name_on_card"
            class="mb-2 mr-sm-2 mb-sm-0"
            v-model="name_on_card"
          ></b-input>
        </div>

        <div class="col-md-3">
          <label for="card_number">Credit / Debit Card Number</label>
          <b-input id="card_number" v-model="card_number"></b-input>
        </div>

        <div class="col-md-2">
          <label for="exp_month">Exp. Month</label>
          <b-form-select
            class="mb-2 mr-sm-2 mb-sm-0"
            :value="null"
            :options="{
              '1': '01',
              '2': '02',
              '3': '03',
              '4': '04',
              '5': '05',
              '6': '06',
              '7': '07',
              '8': '08',
              '9': '09',
              '10': '10',
              '11': '11',
              '12': '12'
            }"
            id="exp_month"
            v-model="exp_month"
          />
        </div>

        <div class="col-md-2">
          <label for="exp_year">Exp. Year</label>
          <b-form-select
            class="mb-2 mr-sm-2 mb-sm-0"
            :value="null"
            :options="available_years"
            id="exp_year"
            v-model="exp_year"
          />
        </div>

        <div class="col-md-2">
          <label for="security_code">Security Code</label>
          <b-input
            id="security_code"
            v-model="security_code"
            :max="999"
            required
          ></b-input>
        </div>
      </div>

      <div class="wrapper-btns">
        <img
          src="../assets/images/Sectigo trust logo.png"
          alt="Secured By SECTIGO"
        />

        <b-button variant="primary" @click.prevent="saveNewCard" :disabled="!canSubmit">
          Add Card
        </b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  name: "NewCardForm",
  data: function() {
    return {
      name_on_card: "",
      card_number: null,
      exp_month: null,
      exp_year: null,
      security_code: null,
      available_years: {}
    };
  },
  methods: {
    saveNewCard() {
      // Field validations

      let new_card = {
        name_on_card: this.name_on_card,
        card_number: this.card_number,
        exp_month: this.exp_month,
        exp_year: this.exp_year,
        security_code: this.security_code
      };

      this.$store.dispatch("myCards/saveNewCard", new_card);
    }
  },
  computed: {
    canSubmit() {
      return (
        this.name_on_card.length &&
        this.card_number.length === 16 &&
        this.exp_month.length &&
        this.exp_year.length &&
        this.security_code.length === 3
      );
    }
  },
  mounted() {
    for (let i = 2010; i <= 2030; ++i) {
      this.$set(this.available_years, i, i);
    }
  }
};
</script>

<style scoped lang="scss">
.btn-primary {
  font-weight: 700;
  width: calc(90% - 26px);
  margin-left: 26px;
}
</style>
