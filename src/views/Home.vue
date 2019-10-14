<template>
  <div>
    <CardsContainer />
    <NewCard />
  </div>
</template>

<script>
// @ is an alias to /src
import CardsContainer from "../components/CardsContainer";
import NewCard from "../components/NewCardContainer";

export default {
  name: "home",
  components: {
    NewCard,
    CardsContainer
  }
};
</script>

<style scoped lang="scss">
h4.card-title {
  color: $second_blue;
}
</style>
