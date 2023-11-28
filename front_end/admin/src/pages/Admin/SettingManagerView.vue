<template>
  <div>
    <div>
      <div class="text-xl border-b-2 border-black pb-2 mb-5">
        Giới thiệu (Về chúng tôi)
      </div>
      <about-editor-molecule :aboutData="about" />
    </div>
    <div>
      <div class="text-xl border-b-2 border-black pb-2 mb-5">
        Dịch vụ spa và hotel
      </div>
      <ServiceEditorMolecule :service-data="service" />
    </div>
    <div>
      <div class="text-xl border-b-2 border-black pb-2 mb-5">
        Chính sách bảo hành và trả góp 0%
      </div>
      <policy-editor-molecule :policy-data="policy" />
    </div>
    <div>
      <div class="text-xl border-b-2 border-black pb-2 mb-5">
        Kinh nghiệm chăm sóc mèo
      </div>
      <experience-editor-molecule :experience-data="experience" />
    </div>
    <div>
      <div class="text-xl border-b-2 border-black pb-2 mb-5">Phối mèo</div>
      <mating-molecule :matingData="mating" />
    </div>
    <!-- customer response -->
    <div class="mt-5">
      <div class="text-xl border-b-2 border-black pb-2 mb-5">
        ẢNH PHẢN HỒI CỦA KHÁCH
      </div>
      <div class="flex gap-5 flex-wrap">
        <label
          for="clientFile"
          class="flex justify-center items-center border-2 rounded-md w-[25vw] h-[25vw] lg:w-[10vw] lg:h-[10vw] bg-gray-300 hover:text-white hover:bg-green-700"
        >
          Chọn ảnh
        </label>
        <input
          :onchange="changeFile"
          hidden
          id="clientFile"
          accept="image/*"
          multiple
          type="file"
        />
        <div class="flex gap-5 flex-wrap" v-if="listImageUrl.length > 0">
          <div
            v-for="(imageItem, index) in listImageUrl"
            :key="imageItem"
            class="relative m-auto"
          >
            <img
              class="border object-cover object-center w-[25vw] h-[25vw] lg:w-[10vw] lg:h-[10vw] m-auto"
              :src="imageItem"
              alt="hinh anh"
            />
            <span
              :onclick="() => removeImage(index)"
              class="absolute top-0 -right-3 border border-black bg-black text-white px-[0.65rem] py-1 rounded-full cursor-pointer"
              >X</span
            >
          </div>
        </div>
        <!-- Ảnh đã có sẵn -->
        <div class="flex gap-5 flex-wrap" v-if="listOldImage.length > 0">
          <div
            v-for="(imageName, index) in listOldImage"
            :key="imageName"
            class="relative m-auto"
          >
            <img
              class="border object-cover object-center w-[25vw] h-[25vw] lg:w-[10vw] lg:h-[10vw] m-auto"
              :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${imageName}&width=1200`"
              :alt="imageName"
            />
            <span
              :onclick="() => removeOldImage(index)"
              class="absolute top-0 -right-3 border border-black bg-black text-white px-[0.65rem] py-1 rounded-full cursor-pointer"
              >X</span
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Banner -->
    <div class="mt-5">
      <div class="text-xl border-b-2 border-black pb-2 mb-5">BANNER</div>
      <div>
        <div
          class="p-3 lg:p-5 duration-300 bg-gray-300 hover:bg-green-700 hover:text-white rounded-md text-center font-bold"
          :onclick="changeCropImageBannerStatus"
        >
          Đổi Ảnh
        </div>
        <img
          class="w-full max-w-[1000px] m-auto my-5 border"
          v-if="newImage != null"
          :src="newImage"
          alt="hinh anh"
        />
        <img
          v-else
          class="w-full max-w-[1000px] m-auto mt-5 border"
          :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=/banner/banner.jpg&width=1000`"
          alt="meo"
        />
        <div
          v-bind:class="cropImageBannerStatus ? 'flex' : 'hidden'"
          class="fixed inset-0 bg-black bg-opacity-80 z-[25] justify-center items-center p-5"
        >
          <div class="w-full md:w-2/3 xl:w-1/2">
            <div class="flex justify-end">
              <span
                :onclick="changeCropImageBannerStatus"
                class="text-white py-3 px-5 text-lg font-bold cursor-pointer"
                >Đóng</span
              >
            </div>
            <CropImageMolecule
              :width="1920"
              :heigh="1080"
              @changeImage="changeBannerImage"
              class="bg-black"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import CropImageMolecule from "@/components/molecules/CropImageMolecule.vue";
import CatService from "@/service/CatService";
import SettingService from "@/service/SettingService";
import UploadFile from "@/service/UploadFile";
import AboutEditorMolecule from "../../components/molecules/AboutEditorMolecule.vue";
import ServiceEditorMolecule from "@/components/molecules/ServiceEditorMolecule.vue";
import PolicyEditorMolecule from "../../components/molecules/PolicyEditorMolecule.vue";
import ExperienceEditorMolecule from "../../components/molecules/ExperienceEditorMolecule.vue";
import MatingMolecule from "../../components/molecules/MatingMolecule.vue";

export default {
  name: "SettingManagerView",
  data() {
    return {
      aboutFiles: [],
      listAboutImageUrl: [],
      listAboutImageName: [],
      files: [],
      listImageUrl: [],
      listImageName: [],
      listOldImage: [],
      cropImageStatus: false,
      cropImageBannerStatus: false,
      doman: DOMAN,
      newImage: null,
      about: "",
      service: "",
      policy: "",
      experience: "",
      mating: "",
    };
  },
  methods: {
    changeFile(e) {
      if (e.target.files.length > 0) {
        this.files = [...e.target.files];
        this.getImagePropertive(e.target.files);
        this.saveImage(this.files, this.listImageName);
        this.saveData();
      }
    },
    getImagePropertive(listFile) {
      for (let index = 0; index < listFile.length; index++) {
        const element = listFile[index];
        this.listImageUrl.push(URL.createObjectURL(element));
        this.listImageName.push(
          this.formatName("client_responses/", element.name)
        );
      }
    },
    formatName(folder, string) {
      let num = Math.floor(Math.random() * (100000000 - 1000000 + 1)) + 1000000;
      let newName = string.substring(0, string.lastIndexOf("."));
      return folder + num + newName + ".jpg";
    },
    changeCropImageBannerStatus() {
      this.cropImageBannerStatus = !this.cropImageBannerStatus;
    },
    removeImage(index) {
      this.deleteImage(this.listImageName[index]);
      this.listImageUrl.splice(index, 1);
      this.listImageName.splice(index, 1);
      this.files.splice(index, 1);
      this.saveData();
    },
    removeOldImage(index) {
      this.deleteImage(this.listOldImage[index]);
      this.listOldImage.splice(index, 1);
      this.saveData();
    },
    changeImage(image) {
      this.listImage.push(image);
      this.listImageName.push("client_responses/" + image.name);
      this.saveImage(image.blob, "client_responses/" + image.name);
      this.cropImageStatus = false;
    },
    changeBannerImage(image) {
      this.newImage = image.url;
      this.saveImage([image.blob], ["banner/banner.jpg"]);
      this.cropImageBannerStatus = false;
    },
    deleteImage(image) {
      CatService.deleteImage([image]).then((res) => {
        console.log("da xoa", res.data);
      });
    },
    saveImage(imageBlob, imageName) {
      UploadFile.uploadImage(imageBlob, imageName).then((res) => {
        console.log(res.data);
      });
    },
    saveData() {
      let newArr = [...this.listImageName, ...this.listOldImage];
      let jsonArr = JSON.stringify(newArr);
      SettingService.updateClientRespons(jsonArr).then((res) => {
        console.log(res.data);
      });
    },
    getSetting() {
      SettingService.getAll().then((res) => {
        if (res.data) {
          this.listOldImage = JSON.parse(res.data.client_respons);
          this.about = res.data.about;
          this.policy = res.data.policy;
          this.service = res.data.service;
          this.experience = res.data.experience;
          this.mating = res.data.mating;
        }
      });
    },
  },
  components: {
    CropImageMolecule,
    AboutEditorMolecule,
    ServiceEditorMolecule,
    PolicyEditorMolecule,
    ExperienceEditorMolecule,
    MatingMolecule,
  },
  created() {
    this.getSetting();
  },
};
</script>

<style>
</style>