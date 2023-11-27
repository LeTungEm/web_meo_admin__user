<template>
  <h1 class="text-xl font-bold my-5">
    {{ text }}
    <slot></slot>
  </h1>
</template>

<script>
export default {
  name: "DetailPropertyHeaderAtom",
  props: {
    text: String,
  },
};
</script>

<style>
</style>