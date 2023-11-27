<template>
  <RightSidebarMolecule class="py-0" :status="status">
    <div class="flex justify-between items-center">
      <h1 class="sticky top-0 bg-white text-xl font-bold py-5 xl:text-3xl z-10">
        Giỏ hàng&nbsp;({{ totalQuantity }})
      </h1>
      <font-awesome-icon
        class="text-xl xl:text-3xl hover:text-green-700 cursor-pointer"
        :onclick="closeCartBar"
        :icon="['fas', 'xmark']"
      />
    </div>
    <div class="grid grid-cols-1 gap-5">
      <CartItemMolecule
        :quantityBarStatus="true"
        @closeCartBar="closeCartBar"
        @removeProduct="removeProduct"
        class="max-w-full"
        v-for="(product, index) in list"
        :key="product"
        :index="index"
        :product="product"
        :productType="product.type"
      />
    </div>
    <div
      class="w-full h-1/3 flex justify-center items-center"
      v-if="list.length < 1"
    >
      <div class="p-5">
        <h1 class="text-3xl text-center">Bạn hiện chưa có đơn hàng nào.</h1>
        <h2
          @click="toShop"
          class="text-xl text-[#e99eab] text-center cursor-pointer"
        >
          Mua hàng ngay
        </h2>
      </div>
    </div>
    <div class="sticky bottom-0 w-full bg-white pb-5 mt-10 z-10">
      <button
        @click="checkout"
        class="w-full py-[4%] xl:text-2xl md:whitespace-nowrap bg-[#da8393] text-white font-bold rounded-sm hover:bg-[#c16979] duration-200"
      >
        Đặt hàng
      </button>
    </div>
  </RightSidebarMolecule>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { mapActions, mapGetters } from "vuex";
import CartItemMolecule from "../molecules/CartItemMolecule.vue";
import RightSidebarMolecule from "../molecules/RightSidebarMolecule.vue";
import { decodeEmail, encodeEmail } from "@/assets/js/quickFunction";
export default {
  name: "CartBarOrganisms",
  data() {
    return {
      list: [],
      totalQuantity: 0,
      totalPrice: 0,
    };
  },
  props: {
    status: Boolean,
  },
  watch: {
    getCartChangeNumber: function () {
      this.getAllProduct();
    },
  },
  emits: ["closeCartBar", "changeToTalQuantity", "openCheckoutForm"],
  computed: {
    ...mapGetters(["getCartChangeNumber"]),
  },
  methods: {
    toShop() {
      this.$router.push("/");
      this.closeCartBar();
    },
    ...mapActions(["showNotification"]),
    checkout() {
      if (this.totalQuantity > 0) {
        this.$emit("openCheckoutForm", {listCat: this.list, total: this.totalPrice});
        this.closeCartBar();
      } else {
        this.showNotification(["Giỏ hàng rỗng", false]);
      }
    },
    closeCartBar() {
      this.$emit("closeCartBar");
    },

    writeToLocalStorage(list) {
      let jsonString = JSON.stringify(list);
      let jsonEncode = encodeEmail(jsonString);
      localStorage.setItem("CCNN", jsonEncode);
    },

    setTotalQuantity() {
      let newTotalQuantity = this.getTotalQuantity(this.list);
      this.$emit("changeToTalQuantity", newTotalQuantity);
      this.totalQuantity = newTotalQuantity;
    },

    removeProduct(index) {
      this.list.splice(index, 1);
      this.writeToLocalStorage(this.list);
      this.setTotalQuantity();
    },

    getTotalQuantity(list) {
      let totalQuantity = 0;
      let totalPrice = 0;
      list.forEach((product) => {
        totalQuantity += product.quantity;
        totalPrice += product.quantity * product.price;
      });
      this.totalPrice = totalPrice;
      return totalQuantity;
    },

    getAllProduct() {
      let cartJson = localStorage.getItem("CCNN");
      let list = [];
      if (cartJson != null) {
        let jsonDecode = decodeEmail(cartJson);
        list = JSON.parse(jsonDecode);
      }
      this.list = list;
      this.setTotalQuantity();
    },
  },
  components: {
    RightSidebarMolecule,
    CartItemMolecule,
    FontAwesomeIcon,
  },
  created() {
    this.getAllProduct();
  },
};
</script>

<style>
</style>