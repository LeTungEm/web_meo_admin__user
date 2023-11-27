<template>
  <div>
    <hr />
    <div :onclick="changeStatus" class="flex items-center cursor-pointer">
      <font-awesome-icon v-bind:class="status?'-rotate-180':''" class="mr-5 text-3xl duration-300" :icon="['fas', 'caret-down']" />
      <DetailPropertyHeaderAtom :text="title" />
    </div>
    <div class="md:text-xl" v-bind:class="status ? '' : 'hidden'">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import DetailPropertyHeaderAtom from "../atoms/header/DetailPropertyHeaderAtom.vue";
export default {
  name: "DropTextMolecule",
  data() {
    return {
      status: false,
    };
  },
  props: {
    title: String,
    defaultStatus: Boolean,
  },
  methods: {
    changeStatus() {
      this.status = !this.status;
    },
  },
  components: { DetailPropertyHeaderAtom, FontAwesomeIcon },
  created(){
    if(this.defaultStatus){
      this.status = this.defaultStatus;
    }
  }
};
</script>

<style>
</style>