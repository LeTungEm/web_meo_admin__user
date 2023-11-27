<template>
  <div class="flex gap-5 w-full">
    <div class="relative flex-[3] lg:flex-[2]">
      <img
        loading="lazy"
        :onclick="toDetail"
        class="border rounded-sm object-center object-cover w-full bg-white duration-300 hover:shadow-lg hover:p-1"
        :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${product.image}&width=400`"
        :alt="product.name"
      />
    </div>
    <div class="flex-[7] lg:flex-[8]">
      <h5
        :onclick="toDetail"
        class="block text-base md:text-2xl cursor-pointer hover:underline duration-300"
      >
        {{ product.name }}
      </h5>
      <div class="flex justify-between text-xs md:text-lg">
        <div class="flex justify-between">
          <span class="font-bold">{{ product.quantity }}</span
          >&nbsp;&nbsp;x&nbsp;&nbsp;
          <PriceTextAtom :minPrice="product.price" :maxPrice="product.price" />
        </div>
        <button :onclick="removeProduct" class="italic underline text-gray-500">
          xóa
        </button>
      </div>
    </div>
  </div>
</template>
  
  <script>
import { DOMAN } from "@/assets/js/config";
import PriceTextAtom from "../atoms/text/PriceTextAtom.vue";

export default {
  name: "CartItemMolecule",
  data() {
    return {
      doman: DOMAN,
    };
  },
  props: {
    product: Object,
    productType: String,
    index: Number,
    quantityBarStatus: Boolean,
  },
  emits: ["removeProduct", "closeCartBar"],
  methods: {
    toDetail() {
      this.$emit("closeCartBar");
      this.$router.push(
        `/meo-canh/${this.product.category_slug}/${this.product.slug}`
      );
    },

    removeProduct() {
      this.$emit("removeProduct", this.index);
    },
  },
  components: {
    PriceTextAtom,
  },
  created() {},
};
</script>
  
  <style>
</style>