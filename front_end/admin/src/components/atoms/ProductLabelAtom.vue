<template>
  <!-- icon: paw/star/heart -->
  <div class="py-1 px-2 max-w-2/3 text-white bg-gradient-to-r from-pink-500 to-pink-300">
    <font-awesome-icon icon="star" />
    &nbsp;{{ text }}
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

export default {
  name: "ProductLabelAtom",
  components: {
    FontAwesomeIcon,
  },
  props:{
    text: String,
  }
};
</script>

<style>
</style>