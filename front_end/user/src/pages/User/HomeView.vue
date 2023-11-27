<template>
  <div>
    <BannerOrganism />
    <PageTemplate class="relative">
      <div
        id="mainDiv"
        class="text-lg lg:text-2xl mb-2 inline-block text-gray-400 font-bold capitalize"
      >
        <span> Trang Chủ </span>
        <span v-bind:class="selectedCategory == null ? 'text-black' : ''">
          / Mèo Cảnh
        </span>
        <span v-if="selectedCategory != null" class="text-black">
          / {{ selectedCategory.name }}
        </span>
      </div>
      <FilterMolecule
        @changePriceOfRange="changePriceOfRange"
        @changeOption="changeOption"
      />
      <GridProductOrganisms
        class="xl:flex-[8]"
        :listProduct="listFiltered"
        :productType="'meo'"
      />
      <ClientResponseMolecule />
    </PageTemplate>
  </div>
</template>

<script>
import BannerOrganism from "@/components/organisms/BannerOrganism.vue";
import PageTemplate from "@/components/templates/PageTemplate.vue";
import GridProductOrganisms from "@/components/organisms/GridProductOrganisms.vue";
import FilterMolecule from "@/components/molecules/FilterMolecule.vue";
import CatService from "@/service/CatService";
import { mapGetters } from "vuex";
import { scrollToMainDiv } from "@/assets/js/quickFunction.js";
import ClientResponseMolecule from "@/components/molecules/ClientResponseMolecule.vue";

export default {
  name: "HomeView",
  data() {
    return {
      listProduct: [],
      listFiltered: [],
      priceOfRange: null,
      selectedOption: 0,
      selectedCategory: null,
    };
  },
  watch: {
    getSelectedCategory(newValue) {
      this.selectedCategory = newValue;
      this.priceOfRange = null;
      this.selectedOption = 0;
      this.filterCat();
      scrollToMainDiv();
    },
  },
  computed: {
    ...mapGetters(["getSelectedCategory"]),
  },
  methods: {
    async getAllCat() {
      await CatService.getAll().then((res) => {
        this.listProduct = res.data;
      });
    },

    filterCat() {
      this.listFiltered = this.listProduct;

      if (this.selectedCategory != null) {
        this.listFiltered = this.listFiltered.filter(
          (cat) => cat.category_id == this.selectedCategory.category_id
        );
      }

      if (this.priceOfRange != null) {
        this.listFiltered = this.listFiltered.filter(
          (cat) => this.filterByPrice(cat) == true
        );
      }

      this.sortListCat(this.listFiltered);
    },

    sortListCat(listCat) {
      let self = this;
      if (this.selectedOption == 0) {
        listCat.sort(function (a, b) {
          return self.getCurrentPrice(a) - self.getCurrentPrice(b);
        });
      } else if (this.selectedOption == 1) {
        listCat.sort(function (a, b) {
          return self.getCurrentPrice(b) - self.getCurrentPrice(a);
        });
      } else if (this.selectedOption == 2) {
        this.listFiltered = listCat.filter(
          (cat) => cat.gender == 1 || cat.gender == 2
        );
      } else if (this.selectedOption == 3) {
        this.listFiltered = listCat.filter(
          (cat) => cat.gender == 0 || cat.gender == 2
        );
      }
    },

    filterByPrice(cat) {
      if (
        this.getCurrentPrice(cat) >= parseInt(this.priceOfRange) &&
        this.getCurrentPrice(cat) <= parseInt(this.priceOfRange) + 10000000
      ) {
        return true;
      } else {
        return false;
      }
    },

    getCurrentPrice(cat) {
      if (cat.new_price > 0) return cat.new_price;
      else return cat.price;
    },

    changePriceOfRange(priceOfRange) {
      this.priceOfRange = priceOfRange;
      this.filterCat();
    },

    changeOption(selectedOption) {
      this.selectedOption = selectedOption;
      this.filterCat();
    },
  },
  components: {
    BannerOrganism,
    PageTemplate,
    GridProductOrganisms,
    FilterMolecule,
    ClientResponseMolecule,
},
  async created() {
    await this.getAllCat();
    this.selectedCategory = this.getSelectedCategory;
    this.filterCat();
  },
};
</script>
