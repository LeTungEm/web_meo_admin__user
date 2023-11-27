<template>
  <div
    v-if="status"
    :onclick="closeReview"
    class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-80"
  >
    <div class="bg-white z-30 m-5 p-5 border-2 border-[#da8393]">
      <div class="text-center font-bold text-2xl">Xác nhận đợn hàng</div>
      <div><b>Tên:</b> {{ userInfo.name }}</div>
      <div><b>Số điện thoại:</b> {{ userInfo.phone }}</div>
      <div><b>Địa chỉ:</b> {{ userInfo.address }}</div>
      <hr class="my-5" />
      <div>
        <div
          class="mb-5 flex gap-5 items-center"
          v-for="cat in listCat.listCat"
          :key="cat"
        >
          <img
            class="w-[100px]"
            :src="`${doman}/back_end/api/Controllers/GetFileController.php?imgURL=${cat.image}`"
            alt=""
          />
          <div>
            <div>{{ cat.name }}</div>
            <div class="flex">
              <price-text-atom :maxPrice="cat.price" :minPrice="cat.price" />&nbsp;&nbsp;x&nbsp;&nbsp;<span>{{ cat.quantity }}</span>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-5" />
      <div class="flex justify-between text-lg font-bold">
        <span> Tổng cộng: </span>
        <price-text-atom class="text-2xl" :maxPrice="listCat.total" :minPrice="listCat.total" />
      </div>
      <p class="text-center text-[#da8393] mt-5">
        Nan Garden sẽ sớm liên hệ bạn để xác nhận đơn đặt bé mèo
      </p>
    </div>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import PriceTextAtom from "../atoms/text/PriceTextAtom.vue";

export default {
  components: { PriceTextAtom },
  name: "ReviewOrderMolecule",
  data() {
    return {
      doman: DOMAN,
    };
  },
  props: {
    userInfo: Object,
    listCat: Object,
    status: Boolean,
  },
  emits:["closeReview"],
  methods:{
    closeReview(){
        this.$emit("closeReview");
    }
  }
};
</script>

<style>
</style>