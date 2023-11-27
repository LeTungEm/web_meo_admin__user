<template>
  <div class="text-lg py-3 px-16 border rounded-sm hover:font-bold">
    {{ text }}
  </div>
</template>

<script>
export default {
  name: "DetailOptionButtonAtom",
  props: {
    text: String,
  },
};
</script>

<style>
</style>