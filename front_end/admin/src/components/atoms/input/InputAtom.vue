<template>
  <input
    ref="searchInput"
    :placeholder="placeholder"
    class="input-search w-full h-full bg-transparent outline-0"
    :type="type"
    v-model="search"
  />
</template>

<script>
export default {
  name: "InputAtom",
  data() {
    return {
      search: "",
    };
  },
  props: {
    type: String,
    placeholder: String,
    status: Boolean,
  },
  watch: {
    search: function () {
      this.change();
    },
    status: function () {
      if (this.status) {
        this.$refs.searchInput.focus();
      }
    },
  },
  methods: {
    change() {
      this.$emit("change", this.search);
    },
  },
  emits: ["change"],
};
</script>

<style>

</style>