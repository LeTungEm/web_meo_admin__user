<template>
  <div>
    <div class="font-bold text-2xl mb-2">CHI TIẾT ĐƠN HÀNG</div>
    <div v-if="isNotCorrect()" class="font-bold text-xl text-red-500 mb-5">
      (Một số sản phẩm đã không được hiển thị do sự thay đổi của danh sách sản
      phẩm.)
    </div>
    <div class="flex flex-col lg:flex-row gap-5">
      <div class="lg:w-1/2 p-5 border rounded-md">
        <div><b>Tên khách hàng: </b>{{ orderInfo.user_name }}</div>
        <div><b>Số điện thoại: </b>{{ orderInfo.user_phone }}</div>
        <div><b>Địa chỉ: </b>{{ orderInfo.user_address }}</div>
        <div class="flex">
          <b>Tổng tiền:&nbsp;</b>
          <price-text-atom
            :maxPrice="orderInfo.total || 0"
            :minPrice="orderInfo.total || 0"
          />
        </div>
        <div><b>Ngày đặt hàng: </b>{{ orderInfo.create_date }}</div>
      </div>
      <div class="lg:w-1/2 p-5 border rounded-md flex flex-col gap-5">
        <div class="flex gap-5" v-for="cat in orderDetail" :key="cat">
          <img
            class="w-1/3"
            :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${getImage(
              cat.image
            )}`"
            alt="anh meo"
          />
          <div>
            {{ cat.name }}
            <div class="flex">
              <price-text-atom
                :maxPrice="cat.price"
                :minPrice="cat.price"
              />&nbsp;&nbsp;x&nbsp;&nbsp;
              {{ cat.quantity }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrderDetailService from "@/service/OrderDetailService";
import OrderService from "@/service/OrderService";
import PriceTextAtom from "../../components/atoms/text/PriceTextAtom.vue";
import { DOMAN } from "@/assets/js/config";

export default {
  components: { PriceTextAtom },
  name: "OrderDetailView",
  data() {
    return {
      orderInfo: {},
      orderDetail: [],
      doman: DOMAN,
    };
  },
  methods: {
    getOrderInfo() {
      OrderService.getByID(this.$route.params.orderID).then((res) => {
        this.orderInfo = res.data;
      });
    },
    getOrderDetail() {
      OrderDetailService.getAllByOrderId(this.$route.params.orderID).then(
        (res) => {
          this.orderDetail = res.data;
        }
      );
    },
    getImage(string) {
      if (string) {
        let arr = JSON.parse(string);
        if (arr.length > 0) {
          return arr[0];
        }
      }
      return "default.jpg";
    },
    getTotal() {
      let total = 0;
      this.orderDetail.map((cat) => {
        total += cat.price * cat.quantity;
      });
      return total;
    },
    isNotCorrect() {
      let currentTotal = this.getTotal();
      if (this.orderInfo.total != currentTotal) {
        return true;
      }
      return false;
    },
  },
  created() {
    this.getOrderInfo();
    this.getOrderDetail();
  },
};
</script>

<style>
</style>