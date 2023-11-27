<template>
  <div>
    <div class="font-bold italic text-center text-xl lg:text-3xl my-5">
      Khách hàng nhà Nan Garden
    </div>
    <div class="flex flex-wrap gap-5 justify-center">
      <img
        v-for="imageName in clientRepons"
        :key="imageName"
        :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${imageName}&width=${
          windowWidth > 1024 ? windowWidth / 4 : 300
        }`"
        alt="meo phan hoi"
        class="border object-cover object-center rounded-md w-[25vw] h-[25vw] lg:w-[10vw] lg:h-[10vw]"
        loading="lazy"
      />
    </div>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import SettingService from "@/service/SettingService";

export default {
  name: "ClientResponseMolecule",
  data() {
    return {
      clientRepons: {},
      doman: DOMAN,
      windowWidth: 250,
    };
  },
  methods: {
    getSetting() {
      SettingService.getAll().then((res) => {
        if (res.data) {
          this.clientRepons = JSON.parse(res.data.client_respons);
        }
      });
    },
  },
  mounted() {
    this.windowWidth = window.innerWidth;
  },
  created() {
    this.getSetting();
  },
};
</script>

<style>
</style>