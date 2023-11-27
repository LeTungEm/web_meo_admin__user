<template>
  <div
    :onclick="toDetail"
    class="relative flex flex-col w-full h-full shadow-md"
  >
    <div class="relative">
      <ProductLabelAtom
        v-if="product.new_price > 0"
        class="absolute text-sm xl:text-lg top-[2%] left-0"
        :text="'Giảm giá'"
      />
      <img
        loading="lazy"
        class="border rounded-sm object-center object-cover bg-white w-full duration-300 hover:shadow-lg hover:p-1"
        :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${image}&width=${
          windowWidth > 1024 ? windowWidth / 2 : 500
        }`"
        :alt="product"
      />
    </div>
    <div class="flex flex-col flex-1 justify-between p-3">
      <h1 class="block text-base md:text-2xl font-semibold text-gray-500">
        {{ product.name }}
      </h1>
      <div class="flex flex-wrap gap-x-5 text-xs md:text-lg">
        <PriceTextAtom :minPrice="currentPrice" :maxPrice="currentPrice" />
        <PriceTextWLineThroughAtom
          v-if="true"
          :minPrice="oldPrice"
          :maxPrice="oldPrice"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import ProductLabelAtom from "../atoms/ProductLabelAtom.vue";
import PriceTextAtom from "../atoms/text/PriceTextAtom.vue";
import PriceTextWLineThroughAtom from "../atoms/text/PriceTextWLineThroughAtom.vue";

export default {
  name: "ProductCardMolecule",
  data() {
    return {
      doman: DOMAN,
      currentPrice: 0,
      oldPrice: 0,
      image: "",
      windowWidth: 400,
    };
  },
  props: {
    product: Object,
    productType: String,
  },
  methods: {
    getCurrentPrice() {
      if (this.product.new_price > 0) {
        this.oldPrice = this.product.price;
        this.currentPrice = this.product.new_price;
      } else {
        this.currentPrice = this.product.price;
      }
    },

    toDetail() {
      let self = this;
      setTimeout(function () {
        self.$router.push(
          `/meo-canh/${self.product.category_slug}/${self.product.slug}`
        );
      }, 300);
    },
    getImage() {
      if (this.product.image) {
        let imageArr = JSON.parse(this.product.image);
        if (imageArr.length > 0) this.image = imageArr[0];
        else this.image = "default.jpg";
      }
    },
  },
  components: {
    PriceTextAtom,
    PriceTextWLineThroughAtom,
    ProductLabelAtom,
  },
  mounted() {
    this.windowWidth = window.innerWidth;
  },
  created() {
    this.getCurrentPrice();
    this.getImage();
  },
};
</script>

<style>
</style>