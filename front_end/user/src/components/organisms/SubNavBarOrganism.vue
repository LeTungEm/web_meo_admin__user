<template>
  <div v-if="hiddenNavBar()" class="hidden text-sm py-1 bg-[#da8393] text-white lg:flex lg:justify-between lg:px-20 lg:items-center">
    <!-- <SubNavInfoMolecule /> -->
    <h1>Dia Chi Cua Hang</h1>
    <SocialMolecule />
    <h1>Dia Chi Cua Hang</h1>
  </div>
</template>

<script>
import SocialMolecule from "../molecules/SocialMolecule.vue";
// import SubNavInfoMolecule from "../molecules/SubNavInfoMolecule.vue";

export default {
  components: { SocialMolecule },
  name: "SubNavBarOrganism",
  methods: {
    hiddenNavBar() {
      let result = true;
      let routerName = this.$route.name;
      if (routerName == "login" || routerName == 'checkout' || this.$route.matched.some(route => route.name == 'admin')) {
        result = false;
      }
      return result;
    },
  },
};
</script>

<style>
</style>