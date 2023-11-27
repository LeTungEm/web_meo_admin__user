<template>
  <span class="block text-pink-600 font-bold">{{ formattedPrice }}</span>
</template>

<script>
export default {
  name: "PriceTextAtom",
  props: {
    minPrice: Number,
    maxPrice: Number,
  },
  computed: {
    formattedPrice() {
      let priceString = "";
      if (this.minPrice != 0)
        priceString += this.minPrice.toLocaleString("vi-VN", {
          style: "currency",
          currency: "VND",
        });
      if (this.minPrice != this.maxPrice) {
        if (this.minPrice && this.maxPrice) priceString += " - ";
        if (this.maxPrice != 0) {
          priceString += this.maxPrice.toLocaleString("vi-VN", {
            style: "currency",
            currency: "VND",
          });
        }
      }
      return priceString;
    },
  },
};
</script>

<style>
</style>