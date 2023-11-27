<template>
  <div
    class="relative overflow-x-auto overflow-y-scroll h-[80vh] shadow-md sm:rounded-lg z-10"
  >
    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
      <thead
        class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 shadow-lg"
      >
        <table-column-molecule :columns="columns" />
      </thead>
      <tbody>
        <tr
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 xl:[&>*]:text-base [&>*]:border-2 [&>*]:p-2"
          v-for="order in listOrder"
          :key="order.order_id"
        >
          <td class="font-bold min-w-[100px]">
              <ping-node-atom class="inline-block" v-if="order.isView == 0"/>
            {{ order.user_name }}
          </td>
          <td>{{ order.user_phone }}</td>
          <td>{{ order.user_address }}</td>
          <td>
            <PriceTextAtom :minPrice="order.total" :maxPrice="order.total" />
          </td>
          <td>{{ order.create_date }}</td>
          <td>
            <div class="flex justify-center items-center gap-10">
              <a :href="`tel:${order.user_phone}`">
                <font-awesome-icon
                  class="text-lg text-green-700 cursor-pointer hover:animate-bounce"
                  :icon="['fas', 'phone']"
                />
              </a>
              <font-awesome-icon
                  class="text-lg text-green-700 cursor-pointer hover:animate-bounce"
                  :icon="['fas', 'eye']"
                  :onclick="() => detailOrder(order)"
                />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { DOMAN } from "@/assets/js/config";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import OrderService from "@/service/OrderService";
import TableColumnMolecule from "../../components/molecules/TableColumnMolecule.vue";
import PriceTextAtom from "@/components/atoms/text/PriceTextAtom.vue";
import PingNodeAtom from "../../components/atoms/PingNodeAtom.vue";

export default {
  name: "OrderManagerView",
  components: {
    TableColumnMolecule,
    PriceTextAtom,
    FontAwesomeIcon,
    PingNodeAtom,
  },
  data() {
    return {
      doman: DOMAN,
      listOrder: [],
      columns: ["Tên", "Số điện thoại", "Địa chỉ", "Tổng đơn", "Ngày đặt", ""],
    };
  },
  methods: {
    getAllOrder() {
      OrderService.getAll().then((res) => {
        this.listOrder = res.data;
      });
    },
    detailOrder(order){
      this.$router.push(`/quan-ly/quan-ly-dat-hang/${order.order_id}`);
      if(order.isView == 0){
        OrderService.setIsView(order.order_id);
      }
    }
  },
  created() {
    this.getAllOrder();
  },
};
</script>

<style>
</style>