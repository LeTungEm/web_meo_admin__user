<template>
    <div>
      <label class="text-gray-500" for="description"
        >Chính sách bảo hành và trả góp 0%</label
      >
      <froala
        class="z-20 border rounded-md w-full outline-0 focus:outline-2 focus:outline-green-700 py-1 lg:py-2 px-2 lg:px-4"
        id="description"
        :tag="'textarea'"
        :config="config"
        v-model:value="description"
      ></froala>
      <div :onclick="saveData" class="p-1 text-center bg-gray-300 hover:bg-green-700 duration-300 rounded-md mt-5">Lưu chỉnh sửa</div>
    </div>
  </template>
  
  <script>
  import { DOMAN } from "@/assets/js/config";
  import CatService from "@/service/CatService";
  import SettingService from "@/service/SettingService";
  import UploadFile from "@/service/UploadFile";
  import { mapActions } from 'vuex';
  
  
  export default {
    name: "ServiceEditorMolecule",
    data() {
      return {
        description: "",
        config: {
          events: {
            initialized: function () {
              console.log("initialized");
            },
            "image.inserted": function (img) {
              let imageName =
                Math.floor(Math.random() * (100000000 - 1000000 + 1)) +
                1000000 +
                "image_news.jpg";
              fetch(img[0].src)
                .then((response) => response.blob())
                .then((blob) => {
                  UploadFile.uploadImage([blob], [`word/${imageName}`]).then(
                    (res) => {
                      console.log(res.data);
                      // set new src of image in HTML
                      let newUrls = `${DOMAN}/back_end/api/Controllers/GetFileController.php?imgURL=word/${imageName}&width=1200`;
                      let htmlString = this.html.get();
                      let parser = new DOMParser();
                      let doc = parser.parseFromString(htmlString, "text/html");
  
                      // Lấy tất cả các thẻ <img> trong cây DOM
                      let imgElements = doc.querySelectorAll("img");
  
                      // Thay đổi thuộc tính src của mỗi thẻ <img> bằng các URL mới
                      imgElements.forEach(function (itemImg) {
                        if (itemImg.src === img[0].src) {
                          itemImg.src = newUrls;
                        }
                      });
  
                      // Chuyển cây DOM thành chuỗi HTML mới
                      let newHtmlString = doc.documentElement.outerHTML;
                      this.html.set(newHtmlString);
                    }
                  );
                });
            },
            "image.removed": function (img) {
              let url = img[0].src.toString();
              url = url.replace(
                `${DOMAN}/back_end/api/Controllers/GetFileController.php?imgURL=`,
                ""
              );
              url = url.replace("&width=1200", "");
              console.log(url);
              CatService.deleteImage([url]).then((res) => {
                console.log("da xoa", res.data);
              });
            },
            "image.replaced": function (img) {
              let imageName =
                Math.floor(Math.random() * (100000000 - 1000000 + 1)) +
                1000000 +
                "image_news.jpg";
              fetch(img[0].src)
                .then((response) => response.blob())
                .then((blob) => {
                  UploadFile.uploadImage([blob], [`word/${imageName}`]).then(
                    (res) => {
                      console.log(res.data);
                      // set new src of image in HTML
                      let newUrls = `${DOMAN}/back_end/api/Controllers/GetFileController.php?imgURL=word/${imageName}&width=1200`;
                      let htmlString = this.html.get();
                      let parser = new DOMParser();
                      let doc = parser.parseFromString(htmlString, "text/html");
  
                      // Lấy tất cả các thẻ <img> trong cây DOM
                      let imgElements = doc.querySelectorAll("img");
  
                      // Thay đổi thuộc tính src của mỗi thẻ <img> bằng các URL mới
                      imgElements.forEach(function (itemImg) {
                        if (itemImg.src === img[0].src) {
                          itemImg.src = newUrls;
                        }
                      });
  
                      // Chuyển cây DOM thành chuỗi HTML mới
                      let newHtmlString = doc.documentElement.outerHTML;
                      this.html.set(newHtmlString);
                    }
                  );
                });
            },
          },
        },
      };
    },
    watch:{
      policyData: function(){
        this.description = this.policyData;
      }
    },
    props:{
      policyData: String,
    },
    methods:{
      ...mapActions(["showNotification"]),
  
      saveData(){
          SettingService.updatePolicy(this.description).then(res => {
            console.log(res.data);
            this.showNotification(["Sửa thành công chính sách", false]);
          })
      },
    },
  };
  </script>
  
  <style>
  </style>