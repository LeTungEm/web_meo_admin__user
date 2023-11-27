<template>
  <div
    class="relative overflow-x-auto overflow-y-scroll h-[80vh] shadow-md sm:rounded-lg z-10"
  >
    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
      <thead
        class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 shadow-lg"
      >
        <TableColumnMolecule :columns="columns" />
      </thead>
      <tbody>
        <tr
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 xl:[&>*]:text-base [&>*]:border-2 [&>*]:p-1"
          v-for="(cat, index) in listCat"
          :key="cat.cat_id"
        >
          <td class="font-bold min-w-[200px]">{{ cat.name }}</td>
          <td>{{ cat.age }}&nbsp;tháng</td>
          <td class="min-w-[300px]">
            <div>
              <span class="font-bold">Giới tính: </span
              >{{
                cat.gender == 0 ? "Cái" : cat.gender == 1 ? "Đực" : "Đực và Cái"
              }}
            </div>
            <div><span class="font-bold">Màu:</span> {{ cat.color }}</div>
            <div>
              <span class="font-bold">Trạng thái:</span> {{ cat.status }}
            </div>
            <div>
              <span class="font-bold">Tẩy giun:</span> {{ cat.dewormmed }}
            </div>
            <div><span class="font-bold">Xuất xứ:</span> {{ cat.origin }}</div>
            <div><span class="font-bold">Cha:</span> {{ cat.father }}</div>
            <div><span class="font-bold">Mẹ:</span> {{ cat.mother }}</div>
            <div><span class="font-bold">Sức khỏe:</span> {{ cat.health }}</div>
            <div>
              <span class="font-bold">Tiêm phòng:</span> {{ cat.vaccination }}
            </div>
            <div>
              <span class="font-bold">Tính cách:</span> {{ cat.characteristic }}
            </div>
          </td>
          <td>
            <div class="px-10" v-html="cat.description"></div>
          </td>
          <td class="items-center">
            <input
              :onchange="() => setDisplayOfCat(cat, index)"
              class="w-[20px] h-[20px] mx-auto flex cursor-pointer"
              :checked="cat.isShow == 1 ? true : false"
              type="checkbox"
            />
          </td>
          <td>
            <div class="flex flex-wrap justify-center gap-5">
              <img
                v-for="imageItem in parseJson(cat.image)"
                :key="imageItem"
                loading="lazy"
                class="w-[200px]"
                :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${imageItem}&width=300`"
                alt=""
              />
            </div>
          </td>
          <td>
            <div class="flex flex-wrap justify-center gap-5">
              <div
                class="[&>*]:w-[200px] [&>*]:h-[100px]"
                v-for="videoItem in parseJson(cat.video)"
                :key="videoItem"
                v-html="videoItem"
              ></div>
            </div>
          </td>
          <td>{{ cat.category_name }}</td>
          <td>
            <div class="flex justify-center items-center gap-5">
              <font-awesome-icon
                :onclick="() => showOptionNotification(cat, index)"
                class="text-lg hover:text-green-700 cursor-pointer"
                :icon="['fas', 'delete-left']"
              />
              <font-awesome-icon
                :onclick="() => editCat(cat.slug)"
                class="text-lg hover:text-green-700 cursor-pointer"
                :icon="['fas', 'pen-to-square']"
              />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <OptionNotificationAtom
      @pickOption="deleteProduct"
      :status="optionNotifiStatus"
      :text="optionNotifiMessage"
    />
  </div>
</template>
  
  <script>
// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import TableColumnMolecule from "../molecules/TableColumnMolecule.vue";
import OptionNotificationAtom from "../atoms/OptionNotificationAtom.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import CatService from "@/service/CatService";
import { mapActions } from "vuex";
import { DOMAN } from "@/assets/js/config";
import OrderDetailService from "@/service/OrderDetailService";
import RatingService from "@/service/RatingService";

export default {
  name: "CatsTableOrganism",
  data() {
    return {
      doman: DOMAN,
      listCat: [],
      columns: [
        "Tên",
        "Tuổi",
        "Thông tin",
        "Mô tả",
        "Hiển thị",
        "Hình ảnh",
        "Link video",
        "Loại",
        "",
      ],
      optionNotifiMessage: "",
      optionNotifiStatus: false,
      deleteInfo: null,
    };
  },
  components: { TableColumnMolecule, OptionNotificationAtom, FontAwesomeIcon },
  methods: {
    ...mapActions(["showNotification"]),

    getAllCat() {
      CatService.getAllCat().then((res) => {
        this.listCat = res.data;
      });
    },
    parseJson(string) {
      if (string) {
        return JSON.parse(string);
      }
    },
    showOptionNotification(cat, index) {
      this.optionNotifiMessage = `Bạn có muốn xóa ${cat.name}? Việc này sẽ khiến các đơn đặt hàng của sản phẩm này cũng bị xóa!`;
      this.optionNotifiStatus = true;
      this.deleteInfo = { index: index, cat_id: cat.cat_id };
    },
    async deleteProduct(result) {
      if (result) {
        await this.deleteOrderDetail();
        await this.deleteRating();
        this.deleteCat();
      }
    },
    async deleteOrderDetail() {
      await OrderDetailService.deleteByCatID(this.deleteInfo.cat_id).then(
        (res) => {
          console.log(res.data);
        }
      );
    },
    async deleteRating() {
      await RatingService.deleteByCatID(this.deleteInfo.cat_id).then((res) => {
        console.log(res.data);
      });
    },
    deleteCat() {
      CatService.deleteCat(
        this.deleteInfo.cat_id,
        this.listCat[this.deleteInfo.index].image
      ).then((res) => {
        if (res.data.message == true) {
          this.showNotification([
            `Đã xóa ${this.listCat[this.deleteInfo.index].name}`,
            false,
          ]);
          this.listCat.splice(this.deleteInfo.index, 1);
        } else {
          this.showNotification([`Xóa thất bại !!!`, true]);
        }
      });

      this.optionNotifiMessage = "";
      this.optionNotifiStatus = false;
    },
    setDisplayOfCat(cat, index) {
      this.listCat[index].isShow = cat.isShow == 1 ? 0 : 1;
      CatService.changeIsShow(cat.cat_id, this.listCat[index].isShow).then(
        (res) => {
          if (res.data.message) {
            this.showNotification(["Sửa thành công", false]);
          }
        }
      );
    },
    editCat(catSlug) {
      this.$router.push(`/quan-ly/quan-ly-meo/${catSlug}`);
    },
  },
  created() {
    this.getAllCat();
  },
};
</script>
  
  <style>
</style>