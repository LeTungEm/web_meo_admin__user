<template>
  <div class="lg:flex justify-between items-center mb-10">
    <!-- filter by price -->
    <div class="lg:w-1/2 flex flex-col justify-center items-center lg:block">
      <label
        for="steps-range"
        class="inline-block mr-5 text-xl font-bold text-gray-900 dark:text-white"
        >Lọc theo giá</label
      >
      <input
        id="default-range"
        type="range"
        v-model="price"
        :onchange="changePriceOfRange"
        step="10000000"
        min="1000000"
        max="120000000"
        class="w-1/2 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-black"
      />
      <div class="text-xl">
        <span class="whitespace-nowrap"
          >Từ:
          <price-text-atom
            class="inline-block"
            :minPrice="Number.parseInt(price)"
            :maxPrice="Number.parseInt(price)"
          />
        </span>
        &nbsp; &nbsp;
        <span class="whitespace-nowrap"
          >Đến:
          <price-text-atom
            class="inline-block"
            :minPrice="Number.parseInt(price) + 10000000"
            :maxPrice="Number.parseInt(price) + 10000000"
          />
        </span>
        <div
          :onclick="resetPrice"
          v-bind:class="resetButtonStatus ? '' : 'hidden'"
          class="m-auto lg:m-0 w-fit py-1 px-4 rounded-md border text-white bg-black font-bold"
        >
          Hiện tất cả giá
        </div>
      </div>
    </div>
    <!-- selection -->
    <div class="lg:w-1/2 flex justify-center lg:block mt-5 lg:mt-0">
      <select
        v-model="selectedOption"
        :onchange="changeOption"
        class="lg:float-right w-2/3 shadow-md border border-gray-300 p-3"
      >
        <option value="0">Giá từ thấp đến cao</option>
        <option value="1">Giá từ cao đến thấp</option>
        <option value="2">Mèo đực</option>
        <option value="3">Mèo cái</option>
      </select>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import PriceTextAtom from "../atoms/text/PriceTextAtom.vue";
export default {
  name: "FilterMolecule",
  data() {
    return {
      price: 1000000,
      selectedOption: 0,
      resetButtonStatus: false,
    };
  },
  watch: {
    getSelectedCategory() {
      this.price = 1000000;
      this.selectedOption = 0;
    },
  },
  computed: {
    ...mapGetters(["getSelectedCategory"]),
  },
  emits: ["changePriceOfRange", "changeOption"],
  methods: {
    changePriceOfRange() {
      this.$emit("changePriceOfRange", this.price);
      this.resetButtonStatus = true;
    },
    changeOption() {
      this.$emit("changeOption", this.selectedOption);
    },
    resetPrice() {
      this.resetButtonStatus = false;
      this.price = 1000000;
      this.$emit("changePriceOfRange", null);
    },
  },
  components: { PriceTextAtom },
};
</script>

<style>
</style>