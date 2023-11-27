<template>
  <div
    v-if="splitPage() > 1"
    class="flex justify-center items-center text-sm md:text-lg [&>*]:w-7 [&>*]:h-7 md:[&>*]:w-10 md:[&>*]:h-10 [&>*]:border [&>*]:justify-center [&>*]:items-center hover:[&>*]:border-[#da8393] hover:[&>*]:text-[#da8393]"
  >
    <span :onclick="toPreviousPage" class="flex"
      ><font-awesome-icon :icon="['fas', 'arrow-left']"
    /></span>
    <span
      v-bind:class="formatPanigation(pageNumber)"
      :onclick="() => changePage(pageNumber)"
      v-for="pageNumber in splitPage()"
      :key="pageNumber"
      >{{ pageNumber }}</span
    >
    <span :onclick="toNextPage" class="flex"
      ><font-awesome-icon :icon="['fas', 'arrow-right']"
    /></span>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { scrollToMainDiv } from "@/assets/js/quickFunction.js";
import { PRODUCT_EACH_PAGE } from "@/assets/js/config";

export default {
  name: "PanigationMolecule",
  data() {
    return {
      currentPage: 1,
    };
  },
  props: {
    length: Number,
  },
  watch: {
    length: function () {
      this.currentPage = 1;
    },
    currentPage: function () {
      scrollToMainDiv();
    },
  },
  methods: {
    splitPage() {
      return Math.ceil(this.length / PRODUCT_EACH_PAGE);
    },

    formatPanigation(pageNumber) {
      let style;
      let maximunPage = this.splitPage();
      if (this.currentPage === pageNumber) {
        style = "text-[#da8393] border-[#da8393] font-bold";
      }
      if (
        (pageNumber > this.currentPage - 2 &&
          pageNumber < this.currentPage + 2) ||
        pageNumber == maximunPage ||
        pageNumber == 1
      ) {
        style += " flex";
      } else {
        style += " hidden";
      }
      return style;
    },

    changePage(pageNumber) {
      this.currentPage = pageNumber;
      this.$emit("changePage", this.currentPage - 1);
    },

    toNextPage() {
      let maximunPage = this.splitPage();
      if (this.currentPage < maximunPage) {
        this.currentPage += 1;
        this.$emit("changePage", this.currentPage - 1);
      }
    },

    toPreviousPage() {
      let minimunPage = 1;
      if (this.currentPage > minimunPage) {
        this.currentPage -= 1;
        this.$emit("changePage", this.currentPage - 1);
      }
    },
  },
  components: {
    FontAwesomeIcon,
  },
};
</script>

<style>
</style>