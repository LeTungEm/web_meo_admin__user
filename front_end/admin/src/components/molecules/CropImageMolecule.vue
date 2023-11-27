<template>
  <div class="border p-5 border-yellow-500 rounded-md">
    <label
      class="border border-yellow-500 text-center bg-white text-yellow-500 font-bold block rounded-md w-full hover:bg-yellow-500 hover:text-white py-1 lg:py-2 px-2 lg:px-4"
    >
      Chọn từ thiết bị
      <input accept="image/*" hidden type="file" :onchange="changeFile" />
    </label>
    <div class="border h-80 overflow-hidden my-5">
      <cropper
        class="cropper"
        :src="img"
        :stencil-size="{
          width: width || 538,
          height: heigh || 359,
        }"
        :auto-zoom="true"
        image-restriction="stencil"
        ref="cropper"
      />
    </div>
    <div class="flex flex-wrap gap-5">
      <button
        class="md:text-lg border rounded-md border-yellow-500 bg-white hover:bg-yellow-500 hover:text-white py-1 px-3"
        @click="crop"
      >
        Cắt ảnh
      </button>
      <button
        class="md:text-lg border rounded-md border-yellow-500 bg-white hover:bg-yellow-500 hover:text-white py-1 px-3"
        @click="zoomIn"
      >
        Phóng to
      </button>
      <button
        class="md:text-lg border rounded-md border-yellow-500 bg-white hover:bg-yellow-500 hover:text-white py-1 px-3"
        @click="zoomOut"
      >
        Thu nhỏ
      </button>
      <button
        class="w-full font-bold md:text-lg border rounded-md bg-yellow-600 hover:bg-yellow-700 text-white py-1 px-3"
        @click="saveImage"
      >
        Lưu ảnh
      </button>
    </div>
  </div>
</template>

<script>
import { normalizeString } from "@/assets/js/quickFunction";
import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";
// import UploadFile from "@/service/UploadFile";
export default {
  name: "CropImageMolecule",
  components: {
    Cropper,
  },
  data() {
    return {
      img: "",
      imageName: "",
      blob: "",
    };
  },
  props:{
    width: Number,
    heigh: Number,
  },
  emits: ["changeImage"],
  methods: {
    changeFile(e) {
      if (e.target.files.length > 0) {
        this.img = URL.createObjectURL(e.target.files[0]);
        this.imageName = e.target.files[0].name;
      }
    },
    zoomOut() {
      if (this.img) {
        this.$refs.cropper.zoom(0.5);
      }
    },
    zoomIn() {
      if (this.img) {
        this.$refs.cropper.zoom(1.5);
      }
    },
    crop() {
      if (this.img) {
        const { canvas } = this.$refs.cropper.getResult();
        canvas.toBlob((blob) => {
          // UploadFile.uploadImage([blob], ["cute.jpg"]);
          this.blob = blob;
        }, "image/jpeg");
        this.img = canvas.toDataURL();
      }
    },
    saveImage() {
      if (this.blob == "") {
        this.crop();
      } else {
        let name = Math.floor(Math.random() * (100000000 - 1000000 + 1)) + 1000000;
        let objectImage = {
          url: this.img,
          blob: this.blob,
          name: this.formatName(name + normalizeString(this.imageName)),
        };
        
        this.$emit("changeImage", objectImage);
        this.img = "";
        this.imageName = "";
        this.blob = "";
      }
    },

    formatName(string){
      let newName = string.substring(0, string.lastIndexOf('.'));
      return newName + ".jpg";
    }
  },
};
</script>
<style>
</style>