<template>
  <div
    v-bind:class="status ? '' : 'hidden'"
    class="fixed bg-black bg-opacity-90 inset-0 z-10 flex justify-center items-center"
  >
    <div class="flex justify-center bg-white">
      <div class="p-5 border-2 border-[#da8393] rounded-md">
        <div class="flex justify-end">
          <span
            :onclick="closeForm"
            class="cursor-pointer text-lg px-3 py-1 border border-black rounded-full font-bold"
            >X</span
          >
        </div>
        <div class="text-xl lg:text-2xl font-bold">
          Vui lòng điền thông tin của bạn để được tư vấn.
        </div>
        <div class="text-lg font-bold mt-5">Tên của bạn</div>
        <input
          v-model="name"
          type="text"
          class="border w-full p-1 rounded-sm"
        />
        <div class="text-lg font-bold mt-5">Số điện thoại</div>
        <input
          v-model="phone"
          type="text"
          class="border w-full p-1 rounded-sm"
        />
        <div class="text-lg font-bold mt-5">Địa chỉ</div>
        <input
          v-model="address"
          type="text"
          class="border w-full p-1 rounded-sm"
        />
        <div class="flex justify-center items-center gap-5 mt-5">
          <input
            v-model="isRemember"
            id="saveUserInfo"
            class="w-5 h-5"
            type="checkbox"
          />
          <label for="saveUserInfo" class="text-lg font-bold"
            >Lưu tên và số điện thoại của tôi vào trình duyệt này cho lần mua
            hàng kế tiếp.</label
          >
        </div>
        <div
          :onclick="submitForm"
          class="mt-5 text-center font-bold py-2 px-5 rounded-md border text-white bg-[#da8393] cursor-pointer"
        >
          <span v-bind:class="loading ? 'hidden' : ''">GỬI THÔNG TIN</span>
          <span
            v-bind:class="loading ? '' : 'hidden'"
            class="block w-5 h-5 border-t-2 rounded-full animate-spin m-auto"
            >&nbsp;</span
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { decodeEmail, encodeEmail } from "@/assets/js/quickFunction";
import OrderDetailService from "@/service/OrderDetailService";
import OrderService from "@/service/OrderService";
import { mapActions } from "vuex";

export default {
  name: "CheckoutForm",
  data() {
    return {
      name: "",
      phone: "",
      address: "",
      isRemember: true,
      loading: false,
    };
  },
  props: { status: Boolean, cartObject: Object },
  emits: ["closeForm", "showReview"],
  methods: {
    ...mapActions(["showNotification"]),
    ...mapActions(["changeCartChangeNumber"]),
    closeForm() {
      this.$emit("closeForm");
    },

    submitForm() {
      if (
        this.isFullData() &&
        this.isPhoneNumberCorrect() &&
        this.loading == false
      ) {
        this.loading = true;
        this.setRemember();
        this.saveData();
      }
    },

    saveData() {
      let listCat = JSON.stringify(this.cartObject.listCat);
      OrderService.insertOrder(
        this.name,
        this.phone,
        this.address,
        this.cartObject.total,
        listCat
      )
        .then((res) => {
          console.log(res.data);
          if (res.data.message) {
            this.showNotification(["Thông tin đã được gửi đi", false]);
            this.$emit("showReview", {
              name: this.name,
              phone: this.phone,
              address: this.address,
            });
            this.createOrderDetail(res.data.order_id, listCat);
          } else {
            this.showNotification(["Không thể gửi thông tin", true]);
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },

    createOrderDetail(orderId, listCat) {
      OrderDetailService.insertOrderDetail(orderId, listCat).then((res) => {
        console.log(res.data);
      });
      localStorage.setItem("CCNN", encodeEmail("[]"));
      this.changeCartChangeNumber(1);
    },

    isFullData() {
      if (this.name.trim() == "" && this.phone.trim() == "") {
        this.showNotification(["Hãy điền tên và số điện thoại", true]);
        return false;
      }
      return true;
    },

    isPhoneNumberCorrect() {
      if (this.phone.length != 10) {
        this.showNotification(["Số điện thoại chưa đúng !!!", true]);
        return false;
      } else if (this.phone.match(/[a-zA-Z]/)) {
        this.showNotification([
          "Số điện thoại không được chứa chữ cái !!!",
          true,
        ]);
        return false;
      }
      return true;
    },

    setRemember() {
      let encodeInfo;
      if (this.isRemember) {
        encodeInfo = JSON.stringify({
          name: this.name,
          phone: this.phone,
          address: this.address,
        });
        localStorage.setItem("USIO", encodeEmail(encodeInfo));
      }
    },
    getRemember() {
      let userInfo = localStorage.getItem("USIO");
      if (userInfo) {
        let decodeUser = decodeEmail(userInfo);
        let userObject = JSON.parse(decodeUser);
        if (Object.keys(userObject).length > 0) {
          this.name = userObject.name;
          this.phone = userObject.phone;
          this.address = userObject.address;
        }
      }
    },
  },
  created() {
    this.getRemember();
  },
};
</script>

<style>
</style>