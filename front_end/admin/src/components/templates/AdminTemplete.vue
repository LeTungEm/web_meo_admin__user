<template>
  <div class="flex relative">
    <AdminNavBarOrganism class="min-w-[250px]" @closeNavBar="changeNavBarStatus" :status="navBarStatus" />
    <div class="w-full duration-300">
      <div class="sticky top-0 z-20 mb-5 md:mb-10 bg-green-700">
        <font-awesome-icon
          :onclick="changeNavBarStatus"
          class="text-3xl text-white cursor-pointer py-2 px-5"
          :icon="['fas', 'bars']"
        />
      </div>
      <div class="px-5 xl:px-10">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import AdminNavBarOrganism from "@/components/organisms/AdminNavBarOrganism.vue";
import { scrollToTop } from "@/assets/js/quickFunction";

export default {
  name: "AdminTemplete",
  data() {
    return {
      navBarStatus: false,
    };
  },
  methods: {
    changeNavBarStatus() {
      this.navBarStatus = !this.navBarStatus;
      scrollToTop();
    },
  },
  components: { FontAwesomeIcon, AdminNavBarOrganism },
};
</script>

<style>
</style>