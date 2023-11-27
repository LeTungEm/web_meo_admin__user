<template>
  <span class="block line-through text-gray-500">{{ formattedPrice }}</span>
</template>

<script>
export default {
  name: "PriceTextWLineThroughAtom",
  props: {
    minPrice: Number,
    maxPrice: Number,
  },
  computed: {
    formattedPrice() {
      let priceString = "";
      if (this.minPrice != 0 && this.minPrice != null)
        priceString += this.minPrice.toLocaleString("vi-VN", {
          style: "currency",
          currency: "VND",
        });
      if (this.minPrice != this.maxPrice && this.maxPrice != null) {
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