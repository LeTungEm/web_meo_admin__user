<template>
  <LeftSideBarMolecule :status="status">
    <h1 class="text-xl font-bold xl:text-3xl mb-5 xl:mb-10 text-white">Nan Garden</h1>
    <ul
      class="[&>*]:text-white [&>*]:cursor-pointer [&>*]:text-lg xl:[&>*]:text-xl [&>*]:py-1 [&>*]:whitespace-nowrap"
    >
      <li>
        <router-link @click="closeNavBar" to="/quan-ly/quan-ly-meo"
          ><font-awesome-icon :icon="['fas', 'cat']" />
          &nbsp; Quản lý mèo
        </router-link>
      </li>
      <li>
        <router-link @click="closeNavBar" to="/quan-ly/quan-ly-dat-hang"
          ><font-awesome-icon :icon="['fas', 'book']" />
          &nbsp; Quản lý đặt hàng
        </router-link>
      </li>
      <li>
        <router-link @click="closeNavBar" to="/quan-ly/cai-dat"
          ><font-awesome-icon :icon="['fas', 'gear']" />
          &nbsp; Trang tĩnh
        </router-link>
      </li>
    </ul>
  </LeftSideBarMolecule>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import LeftSideBarMolecule from "../molecules/LeftSideBarMolecule.vue";

export default {
  name: "AdminNavBarOrganism",
  props: {
    status: Boolean,
  },
  emits: ["closeNavBar"],
  methods: {
    closeNavBar() {
      if (this.getScreenWidth() < 1280) this.$emit("closeNavBar");
    },
    getScreenWidth() {
      return window.innerWidth;
    },
  },
  components: { LeftSideBarMolecule, FontAwesomeIcon },
};
</script>

<style>
</style>