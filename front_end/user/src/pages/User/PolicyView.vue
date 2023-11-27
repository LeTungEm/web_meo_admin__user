<template>
  <div class="flex justify-center">
    <div
      class="flex flex-col gap-5 lg:gap-10 max-w-[1000px] p-[5%] w-full border"
    >
      <div v-html="policyData"></div>
    </div>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import SettingService from "@/service/SettingService";

export default {
  name: "PolicyView",
  data() {
    return {
      doman: DOMAN,
      policyData: "",
    };
  },
  watch: {
    "$route.params.pageName"(newNamePage) {
      // Xử lý khi giá trị của namePage thay đổi
      this.getData(newNamePage);
    },
  },
  methods: {
    getData(newNamePage) {
      SettingService.getAll().then((res) => {
        console.log(res.data);
        console.log(newNamePage);
        switch (newNamePage) {
          case "ve-chung-toi":
            this.policyData = res.data.about;
            break;
          case "spa-hotel":
            this.policyData = res.data.service;
            break;
          case "bao-hanh-va-tra-gop":
            this.policyData = res.data.policy;
            break;
          case "kinh-nghiem-cham-soc":
            this.policyData = res.data.experience;
            break;
          default:
            break;
        }
      });
    },
  },
  created() {
    this.getData(this.$route.params.pageName);
  },
};
</script>

<style>
</style>