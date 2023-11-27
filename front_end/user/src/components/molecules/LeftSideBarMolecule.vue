<template>
  <div
    v-bind:class="status ? 'translate-x-0' : 'absolute -translate-x-full'"
    class="p-5 bg-green-700 shadow-lg z-[22] duration-500 xl:w-1/6 h-[100vh]"
  >
    <slot></slot>
  </div>
</template>
  
  <script>
export default {
  name: "LeftSideBarMolecule",
  props: {
    status: Boolean,
  },
};
</script>
  
  <style>
</style>