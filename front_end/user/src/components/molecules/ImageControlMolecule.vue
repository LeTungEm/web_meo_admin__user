<template>
  <div class="lg:w-1/2 flex flex-col-reverse lg:flex-row gap-5 mb-5 lg:mb-0">
    <div
      class="flex h-[80px] w-full overflow-auto lg:h-auto gap-5 lg:flex-col lg:w-[10vw]"
    >
      <img
        v-for="img in listImg"
        loading="lazy"
        class="h-full lg:h-auto hover:scale-105 duration-300 border p-1 shadow-md"
        v-bind:class="img == showedImg ? '' : 'opacity-50'"
        :onclick="() => changeImage(img)"
        :key="img"
        :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${img}&width=${
          windowWidth > 1080 ? 300 : 200
        }`"
        alt="hinh meo"
      />
    </div>
    <!-- Main image -->
    <div class="w-full h-full">
      <div class="p-1 border border-gray-300 shadow-md">
        <div class="p-1 border relative">
          <img
            loading="lazy"
            class="w-full object-contain"
            :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${showedImg}&width=${
              windowWidth > 1080 ? windowWidth / 2 : windowWidth
            }`"
            alt=""
          />
          <!-- Button Zoom -->
          <span
            :onclick="zoomImage"
            class="absolute bottom-0 left-0 m-5 rounded-full border border-black py-3 px-4 hover:bg-black [&>*]:hover:text-white duration-300"
          >
            <font-awesome-icon
              :icon="['fas', 'up-right-and-down-left-from-center']"
            />
          </span>
          <!-- Zoom Image -->
          <div
            :onclick="zoomImage"
            v-bind:class="isZoom ? '' : 'hidden'"
            class="flex justify-center items-center bg-black bg-opacity-80 fixed top-0 right-0 left-0 h-full z-[10]"
          >
            <img
              class="w-full lg:w-2/3 object-contain"
              :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${showedImg}&width=${windowWidth}`"
              alt=""
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

export default {
  name: "ImageControlMolecule",
  data() {
    return {
      doman: DOMAN,
      windowWidth: 400,
      listImg: [
        "https://pethouse.com.vn/wp-content/uploads/2023/08/2-aln-ma-1238-2048x1366.jpg",
        "https://pethouse.com.vn/wp-content/uploads/2023/08/1-aln-ma-1237-2048x1366.jpg",
      ],
      showedImg:
        "https://pethouse.com.vn/wp-content/uploads/2023/08/2-aln-ma-1238-2048x1366.jpg",
      isZoom: false,
    };
  },
  props: {
    listImageLink: String,
  },
  watch: {
    listImageLink: function (newValue) {
      if (newValue) {
        let arrImage = JSON.parse(newValue);
        if (arrImage.length > 0) {
          this.listImg = arrImage;
          this.showedImg = arrImage[0];
          this.$emit("currentImage", arrImage[0]);
        } else {
          this.$emit("currentImage", "default.jpg");
        }
      }
    },
  },
  methods: {
    changeImage(newImg) {
      this.showedImg = newImg;
    },
    zoomImage() {
      this.isZoom = !this.isZoom;
    },
  },
  components: {
    FontAwesomeIcon,
  },
  mounted() {
    this.windowWidth = window.innerWidth;
  },
};
</script>

<style>
</style>