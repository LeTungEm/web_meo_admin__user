<template>
  <div class="w-full lg:w-1/2 relative">
    <div class="flex items-center h-9 relative">
      <InputAtom
        class="pr-8 pl-2 text-base border rounded-2xl focus:outline-2 focus:border-0 focus:outline-pink-400"
        :status="status"
        @change="change"
        :type="'search'"
        :placeholder="'Tìm kiếm...'"
      />
      <div
        class="flex justify-center items-center absolute top-0 right-0 bottom-0"
      >
        <FontAwesomeIcon
          :onclick="searchCat"
          class="mr-3 text-sm duration-300 cursor-pointer hover:text-base hover:text-white"
          :icon="['fas', 'magnifying-glass']"
        />
      </div>
    </div>

    <div
      :onclick="closeTabStatus"
      v-bind:class="tabStatus ? '' : 'hidden'"
      class="inset-0 fixed z-[-1]"
    >
      &nbsp;
    </div>
    <div
      v-bind:class="tabStatus ? '' : 'hidden'"
      class="lg:absolute border-2 top-[110%] lg:bg-white w-full lg:w-[200%] px-1 pt-1 rounded-sm z-[1] h-[80vh] overflow-y-auto"
    >
      <div class="flex flex-col gap-5" v-for="cat in listCat" :key="cat.cat_id">
        <div :onclick="() => toDetailPage(cat)" class="flex gap-5 border-b">
          <img
            class="w-[80px] lg:w-[150px] object-contain mb-1 hover:p-1 hover:border duration-300"
            :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${getImage(
              cat.image
            )}&width=400`"
            alt=""
          />
          <div>
            <span class="text-sm lg:text-lg">{{ cat.name }}</span>
            <price-text-atom
              :maxPrice="cat.new_price > 0 ? cat.new_price : cat.price"
              :minPrice="cat.new_price > 0 ? cat.new_price : cat.price"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import InputAtom from "../atoms/input/InputAtom.vue";
import CatService from "@/service/CatService";
import { DOMAN } from "@/assets/js/config";
import { mapActions } from "vuex";
import PriceTextAtom from "../atoms/text/PriceTextAtom.vue";

export default {
  name: "SearchInputMolecule",
  data() {
    return {
      doman: DOMAN,
      search: "",
      listCat: [],
      tabStatus: false,
    };
  },
  watch: {
    search: function () {
      if (this.search == "") {
        this.listCat = [];
      }
    },
  },
  props: {
    status: Boolean,
  },
  components: {
    FontAwesomeIcon,
    InputAtom,
    PriceTextAtom,
  },
  methods: {
    ...mapActions(["showNotification"]),

    change(value) {
      this.search = value;
    },

    searchCat() {
      if (this.search.trim() != "") {
        CatService.searchCat(this.search).then((res) => {
          this.listCat = res.data;
          this.tabStatus = true;
        });
      } else {
        this.showNotification(["hãy nhập thông tin tìm kiếm !!!", false]);
      }
    },

    closeTabStatus() {
      this.tabStatus = false;
    },

    getImage(jsonString) {
      if (jsonString) {
        let arrImage = JSON.parse(jsonString);
        if (arrImage.length > 0) {
          return arrImage[0];
        } else {
          return "default.jpg";
        }
      }
    },

    toDetailPage(cat) {
      this.$router.push(`/meo-canh/${cat.category_slug}/${cat.slug}`);
      this.tabStatus = false;
      this.$emit("closeTabMobie");
    },
  },
  emits: ["change", "closeTabMobie"],
};
</script>

<style>
</style>