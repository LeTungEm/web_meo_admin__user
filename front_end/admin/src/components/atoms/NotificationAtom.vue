<template>
  <div
    v-bind:class="seltStatus ? 'translate-x-0' : 'translate-x-full'"
    class="fixed z-10 top-[10%] font-bold w-5/6 xl:w-1/3 right-0 duration-300 border-2 shadow-md rounded-t-md rounded-b-md"
  >
    <div
      v-bind:class="isWarning ? 'text-red-700' : 'text-green-700'"
      class="text-base bg-gray-100 underline px-7 py-2 rounded-t-md border-b-2"
    >
      Thông báo
    </div>
    <div
      v-bind:class="isWarning ? 'bg-white' : 'bg-white'"
      class="text-lg px-7 py-3 rounded-b-md"
    >
      {{ text }}
    </div>
  </div>
</template>

<script>
export default {
  name: "NotificationAtom",
  data() {
    return {
      seltStatus: false,
      timeOutId: null,
    };
  },
  props: {
    text: String,
    status: Boolean,
    isWarning: Boolean,
  },
  watch: {
    status: function () {
      this.onpenInTime();
    },
  },
  methods: {
    onpenInTime() {
      if (this.timeOutId) {
        clearTimeout(this.timeoutId);
      }
      let self = this;
      this.seltStatus = true;
      this.timeOutId = setTimeout(function () {
        self.seltStatus = false;
      }, 2500);
    },
  },
};
</script>

<style>
</style>