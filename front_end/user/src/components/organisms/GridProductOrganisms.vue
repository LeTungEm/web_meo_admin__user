<template>
  <div class="overflow-hidden">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
      <ProductCardMolecule
        v-for="product in paginate(listProduct)"
        :key="product"
        :product="product"
        :productType="'meo'"
      />
    </div>
    <PanigationMolecule class="my-5" @changePage="changePage" :length="listProduct.length"/>
  </div>
</template>

<script>
import { PRODUCT_EACH_PAGE } from "@/assets/js/config";
import ProductCardMolecule from "../molecules/ProductCardMolecule.vue";
import PanigationMolecule from '../molecules/PanigationMolecule.vue';
export default {
  name: "GridProductOrganisms",
  data() {
    return {
      pageNumber: 0,
    };
  },
  props: {
    listProduct: Array,
    productType: String,
  },
  watch:{
    listProduct: function(){
      this.pageNumber = 0;
    }
  },
  methods: {
    paginate(listProduct) {
      let beginIndex = this.pageNumber * PRODUCT_EACH_PAGE;
      let listLength = (this.pageNumber + 1) * PRODUCT_EACH_PAGE;
      return listProduct.slice(beginIndex, listLength);
    },

    // filterProducts(listProduct){
    //   let result = [];
    //   result = this.paginate(listProduct);
    //   return result;
    // },

    changePage(currentPage){
        this.pageNumber = currentPage;
    }
  },
  components: { ProductCardMolecule, PanigationMolecule },
};
</script>

<style>
</style>