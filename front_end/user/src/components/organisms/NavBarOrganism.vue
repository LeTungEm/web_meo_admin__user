<template>
  <div
    v-if="hiddenNavBar()"
    class="grid grid-cols-3 md:grid-cols-5 sticky top-0 bg-[#da8393] lg:bg-[#e99eab] z-[10] py-2 px-5 shadow-lg md:py-3 lg:px-20"
  >
    <!-- left navbar -->
    <div class="mr-5 md:col-span-2 md:mr-10 xl:hidden h-full flex items-center">
      <font-awesome-icon
        :onclick="changeMainMenuStatus"
        class="cursor-pointer text-white text-2xl"
        :icon="['fas', 'bars']"
      />
    </div>
    <MainMenuMolecule
      class="xl:flex xl:justify-center xl:items-center md:col-span-2"
      @closeMenu="closeAllTab"
      :status="mainMenuStatus"
    />
    <LogoAtom :onclick="() => changeCategory(null)" class="flex justify-center items-center" />
    <!-- right navbar -->
    <div
      class="flex flex-wrap justify-end lg:flex-nowrap lg:justify-around items-center text-base pl-2 lg:px-10 md:text-2xl md:col-span-2"
    >
      <font-awesome-icon
        :onclick="changeSearchBarStatus"
        class="lg:hidden cursor-pointer mr-5 md:mr-10 text-2xl"
        :icon="['fas', 'magnifying-glass']"
      />
      <!-- Search mobie -->
      <div
        v-bind:class="searchBarStatus ? '' : 'hidden'"
        class="fixed inset-0 lg:hidden bg-black opacity-90 flex justify-center items-center"
      >
        <div :onclick="changeSearchBarStatus" class="absolute inset-0">
          &nbsp;
        </div>
        <SearchInputMolecule
          @closeTabMobie="changeSearchBarStatus"
          class="text-white"
        />
      </div>
      <SearchInputMolecule class="mr-5 hidden lg:block" />
      <a
        :href="`tel:${social.phone}`"
        class="bg-white hidden mr-5 px-2 lg:flex text-red-600 font-bold items-center justify-center h-9 w-1/2 text-base border rounded-2xl"
      >
        <font-awesome-icon class="mr-2" :icon="['fas', 'phone']" />
        <span class="text-lg">{{ social.phone }}</span>
      </a>
      <div class="flex justify-center items-center">
        <font-awesome-icon
          class="cursor-pointer text-2xl"
          :onclick="changeCartBarStatus"
          :icon="['fas', 'cart-shopping']"
        />
        <span class="text-sm md:text-lg"> ({{ totalQuantityOfCart }}) </span>
      </div>
    </div>
    <CartBarOrganisms
      @closeCartBar="changeCartBarStatus"
      @changeToTalQuantity="changeToTalQuantity"
      @openCheckoutForm="changeCheckoutForm"
      :status="cartBarStatus"
    />
    <checkout-form
      @closeForm="changeCheckoutForm"
      @showReview="showReview"
      :cartObject="cartObject"
      :status="checkoutFormStatus"
    />
    <review-order-molecule
      @closeReview="closeReview"
      :userInfo="userInfo"
      :listCat="cartObject"
      :status="reviewStatus"
    />
    <div
      v-bind:class="
        mainMenuStatus || cartBarStatus || accountUserBarStatus ? '' : 'hidden'
      "
      :onclick="closeAllTab"
      class="fixed bg-black bg-opacity-70 inset-0 w-full h-full z-[1]"
    >
      &nbsp;
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { mapGetters, mapActions } from "vuex";
import MainMenuMolecule from "../molecules/MainMenuMolecule.vue";
import LogoAtom from "../atoms/LogoAtom.vue";
import CartBarOrganisms from "./CartBarOrganisms.vue";
import SearchInputMolecule from "../molecules/SearchInputMolecule.vue";
import CheckoutForm from "../molecules/CheckoutForm.vue";
import ReviewOrderMolecule from "../molecules/ReviewOrderMolecule.vue";

export default {
  name: "NavBarOrganism",
  data() {
    return {
      social: {},
      reviewStatus: false,
      checkoutFormStatus: false,
      searchBarStatus: false,
      mainMenuStatus: false,
      cartBarStatus: false,
      accountUserBarStatus: false,
      totalQuantityOfCart: 0,
      cartObject: {},
      userInfo: {},
    };
  },
  watch: {
    getCartChangeNumber() {
      this.cartBarStatus = true;
    },
  },
  components: {
    FontAwesomeIcon,
    MainMenuMolecule,
    LogoAtom,
    CartBarOrganisms,
    SearchInputMolecule,
    CheckoutForm,
    ReviewOrderMolecule,
  },
  computed: {
    ...mapGetters(["getCartChangeNumber"]),
    ...mapGetters(["getSocial"]),
    // ...mapGetters(["getUserLoginStatus"]),
  },
  methods: {
    ...mapActions(["changeSelectedCategory"]),

    changeCategory(category){
      this.changeSelectedCategory(category);
    },

    getSocialLink() {
      this.social = this.getSocial;
    },
    closeReview(){
      this.reviewStatus = false;
    },
    showReview(userInfo) {
      this.checkoutFormStatus = !this.checkoutFormStatus;
      this.userInfo = userInfo;
      this.reviewStatus = true;
    },
    changeCheckoutForm(cartObject) {
      this.checkoutFormStatus = !this.checkoutFormStatus;
      this.cartObject = cartObject;
    },
    changeMainMenuStatus() {
      this.mainMenuStatus = !this.mainMenuStatus;
    },
    changeSearchBarStatus() {
      this.searchBarStatus = !this.searchBarStatus;
    },
    changeCartBarStatus() {
      this.cartBarStatus = !this.cartBarStatus;
    },
    changeAccountUserBarStatus() {
      this.accountUserBarStatus = !this.accountUserBarStatus;
    },
    changeToTalQuantity(totalQuantity) {
      this.totalQuantityOfCart = totalQuantity;
    },
    closeAllTab() {
      this.mainMenuStatus = false;
      this.searchBarStatus = false;
      this.cartBarStatus = false;
      this.accountUserBarStatus = false;
    },
    hiddenNavBar() {
      let result = true;
      let routerName = this.$route.name;
      if (routerName == "login" || routerName == "checkout") {
        result = false;
      }
      return result;
    },
    // toLoginView() {
    //   let userSession = sessionStorage.getItem("EMUR");
    //   let userLocal = localStorage.getItem("CEMURK");
    //   if (userSession || userLocal) {
    //     this.changeAccountUserBarStatus();
    //   } else {
    //     this.$router.push("/nguoi-dung/dang-nhap");
    //   }
    // },
  },
  created() {
    this.getSocialLink();
  },
};
</script>

<style>
</style>