<template>
  <div
    v-bind:class="status ? '' : 'hidden'"
    class="fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center p-10"
  >
    <div class="w-full md:w-2/3 xl:w-1/2 bg-white rounded-sm">
      <div
        class="text-lg bg-gray-100 underline px-7 py-2 rounded-t-md border-b-2 font-bold"
      >
        Thông báo
      </div>
      <div class="text-lg px-7 py-3 rounded-b-md">
        {{ text }}
      </div>
      <div class="m-5 flex justify-between gap-5">
        <WhiteButtonAtom
          @click="() => pickOption(false)"
          class="w-1/3 p-1 whitespace-nowrap"
          :text="'Hủy'"
        />
        <GreenButtonAtom
          @click="() => pickOption(true)"
          class="w-1/3 p-1 whitespace-nowrap"
          :text="'Đồng ý'"
        />
      </div>
    </div>
  </div>
</template>

<script>
import GreenButtonAtom from "./button/GreenButtonAtom.vue";
import WhiteButtonAtom from "./button/WhiteButtonAtom.vue";

export default {
  name: "OptionNotificationAtom",
  props: {
    text: String,
    status: Boolean,
  },
  components: {
    GreenButtonAtom,
    WhiteButtonAtom,
  },
  emits: ["pickOption"],
  methods: {
    pickOption(result) {
      this.$emit("pickOption", result);
    },
  },
};
</script>

<style>
</style>