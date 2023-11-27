<template>
  <h2 class="whitespace-normal text-amber-500 italic">
    {{ text }}
  </h2>
</template>

<script>
export default {
  name: "AmberHeaderAtom",
  props: {
    text: String,
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap");
h2 {
  font-family: "Dancing Script", cursive;
}
</style>