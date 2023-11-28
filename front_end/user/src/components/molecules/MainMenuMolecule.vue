<template>
  <ul
    v-bind:class="
      status ? 'translate-x-0 shadow-lg z-[10]' : '-translate-x-full'
    "
    class="overflow-y-scroll scrollbar-hide lg:overflow-visible text-lg h-full w-2/3 [&>*]:mr-10 hover:[&>li]:text-black hover:[&>li]:italic fixed top-0 left-0 bg-black text-white xl:text-black xl:bg-[#e99eab] duration-500 xl:w-auto xl:h-auto xl:top-[unset] xl:translate-x-0 xl:left-[unset] xl:flex xl:flex-wrap xl:relative"
  >
    <div class="py-1 ml-5 mt-1 flex justify-between items-center xl:hidden">
      <h1 class="text-xl text-white font-bold xl:text-3xl">Menu</h1>
      <font-awesome-icon
        class="hover:text-green-700 text-white translate-x-7"
        :onclick="closeMenu"
        :icon="['fas', 'xmark']"
      />
    </div>
    <li class="py-1 ml-5 border-b xl:border-0 group text-white group relative">
      <router-link
        to="/"
        class="flex justify-between cursor-pointer capitalize"
      >
        <span :onclick="() => changeCategory(null)">
          <font-awesome-icon
            class="group-hover:animate-bounce duration-1000"
            :icon="['fas', 'house']"
          />
          &nbsp;Trang chủ
        </span>
        <font-awesome-icon
          :onclick="changeMenuStatus"
          class="lg:hidden"
          :icon="['fas', 'caret-down']"
        />
      </router-link>
      <ul
        v-bind:style="menuStatus ? 'display: block !important' : ''"
        class="hidden text-white lg:text-black whitespace-nowrap lg:group-hover:block lg:absolute top-full lg:bg-gray-300 p-3 rounded-md [&>*]:mb-2 lg:hover:[&>*]:bg-white [&>*]:p-1 [&>*]:rounded-md [&>*]:cursor-pointer capitalize"
      >
        <li :onclick="closeMenu">
          <router-link to="/chinh-sach/ve-chung-toi"> Về chúng tôi </router-link>
        </li>
        <li :onclick="closeMenu">
          <router-link to="/chinh-sach/spa-hotel">
            Dịch vụ Spa&Hotel
          </router-link>
        </li>
        <li :onclick="closeMenu">
          <router-link to="/chinh-sach/bao-hanh-va-tra-gop">
            Chính sách bảo hành & trả góp 0%
          </router-link>
        </li>
        <li :onclick="closeMenu">
          <router-link to="/chinh-sach/kinh-nghiem-cham-soc">
            Kinh nghiệp chăm sóc
          </router-link>
        </li>
      </ul>
    </li>
    <li
      class="py-1 ml-5 border-b xl:border-0 group text-white group relative capitalize"
    >
      <router-link class="flex justify-between" to="/meo-canh">
        <span :onclick="() => changeCategory(null)">
          <font-awesome-icon
            class="group-hover:animate-bounce duration-1000"
            :icon="['fas', 'cat']"
          />
          &nbsp;Mèo cảnh
        </span>
        <font-awesome-icon
          :onclick="changeCatMenuStatus"
          class="lg:hidden"
          :icon="['fas', 'caret-down']"
        />
      </router-link>
      <ul
        v-bind:style="catMenuStatus ? 'display: block !important' : ''"
        class="hidden text-white lg:text-black whitespace-nowrap lg:group-hover:block lg:absolute top-full lg:bg-gray-300 p-3 rounded-md [&>*]:mb-2 lg:hover:[&>*]:bg-white [&>*]:p-1 [&>*]:rounded-md [&>*]:cursor-pointer capitalize"
      >
        <li
          :onclick="() => changeCategory(category)"
          v-for="category in categories"
          :key="category.slug"
        >
          <router-link :to="`/meo-canh/${category.slug}`">
            {{ category.name }}
          </router-link>
        </li>
      </ul>
    </li>
    <li
      :onclick="closeMenu"
      class="py-1 ml-5 border-b xl:border-0 group text-white capitalize"
    >
      <router-link class="block" to="/chinh-sach/phoi-meo">
        <font-awesome-icon
          class="group-hover:animate-bounce duration-1000"
          :icon="['fas', 'shield-cat']"
        />
        &nbsp;Phối mèo
      </router-link>
    </li>
  </ul>
</template>

<script>
import CategoryService from "@/service/CategoryService";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { mapActions } from "vuex";

export default {
  name: "MainMenuMolecule",
  data() {
    return {
      menuStatus: false,
      catMenuStatus: false,
      categories: [],
    };
  },
  props: {
    status: Boolean,
  },
  emits: ["closeMenu"],
  methods: {
    ...mapActions(["changeSelectedCategory"]),
    closeMenu() {
      this.$emit("closeMenu");
    },
    changeMenuStatus() {
      if (window.outerWidth < 1024) {
        this.menuStatus = !this.menuStatus;
      }
    },
    changeCatMenuStatus() {
      if (window.outerWidth < 1024) {
        this.catMenuStatus = !this.catMenuStatus;
      }
    },
    getAllCategory() {
      CategoryService.getAll().then((res) => {
        this.categories = res.data;
      });
    },

    changeCategory(category) {
      this.changeSelectedCategory(category);
      this.closeMenu();
    },
  },
  components: {
    FontAwesomeIcon,
  },
  created() {
    this.getAllCategory();
  },
};
</script>

<style>
.router-link-exact-active {
  color: white !important;
  font-style: italic;
  font-weight: bolder;
  position: relative;
}
@media screen and (min-width: 1024px) {
  .router-link-exact-active {
    color: black !important;
  }
}
</style>