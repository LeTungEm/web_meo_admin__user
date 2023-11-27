<template>
  <div class="flex-[3] flex justify-between items-center">
    <button
      :onclick="decreate"
      class="w-7 h-7 flex justify-center items-center border border-black rounded-full"
      ><font-awesome-icon :icon="['fas', 'minus']"
    /></button>
    <span class="text-lg font-bold">{{ quantity }}</span>
    <button
      :onclick="increate"
      class="w-7 h-7 flex justify-center items-center border border-black rounded-full"
      ><font-awesome-icon :icon="['fas', 'plus']"
    /></button>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

export default {
  name: "QuantityBarMolecule",
  data() {
    return {
      quantity: 1,
    };
  },
  props: {
    defaultQuantity: Number,
  },
  watch:{
    quantity: function(){
      this.$emit('changeProductQuantity', this.quantity);
    }
  },
  components: {
    FontAwesomeIcon,
  },
  methods: {
    increate() {
        this.quantity++;
    },

    decreate() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    },

    setDefault(){
      if(this.defaultQuantity){
        this.quantity = this.defaultQuantity;
      }
    }
  },
  created(){
    this.setDefault();
  }
};
</script>

<style>
</style>