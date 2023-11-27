<template>
  <div
  v-bind:class="status?'':'hidden'"
    class="fixed flex items-center justify-center z-50 top-0 left-0 bg-black bg-opacity-70 w-full h-full"
  >
    <div class="m-auto">
      <div class="animate-bounce relative">
        <FontAwesomeIcon
          class="text-9xl text-amber-500"
          :icon="['fas', 'sun']"
        />
        <span
          class="absolute flex items-center justify-center top-0 right-0 bottom-0 left-0"
        >
          <span
            class="shadow-2xl block rounded-full w-3/4 h-3/4 shadow-yellow-300"
            >&nbsp;</span
          >
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

export default {
  name: "LoadingAtom",
  props: {
    status: Boolean,
  },
  components: {
    FontAwesomeIcon,
  },
};
</script>

<style>
</style>