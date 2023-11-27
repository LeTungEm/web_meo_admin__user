<template>
  <div class="flex overflow-hidden">
    <img
      class="object-contain w-full"
      :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=/banner/banner.jpg&width=${windowWidth}`"
      alt="meo"
    />
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";

export default {
  name: "BannerOrganism",
  data() {
    return {
      doman: DOMAN,
      windowWidth: 1000,
    };
  },
  mounted() {
    this.windowWidth = window.innerWidth;
  },
};
</script>

<style>
</style>