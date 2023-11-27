<template>
  <div v-bind:class="status?'translate-x-0':'translate-x-full'" class="fixed top-0 right-0 bottom-0 shadow-lg p-5 bg-white z-[10] overflow-y-scroll scrollbar-hide duration-500 w-3/4 md:w-1/2 xl:w-2/5">
      <slot></slot>
  </div>
</template>

<script>
export default {
  name: "RightSidebarMolecule",
  props:{
    status: Boolean,
  },
};
</script>

<style>
</style>