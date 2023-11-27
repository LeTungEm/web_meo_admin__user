<template>
  <ul
    class="flex justify-center [&>*]:mr-2 text-md [&>*]:border [&>*]:border-gray-500 [&>*]:rounded-full [&>*]:w-5 [&>*]:h-5 [&>*]:flex [&>*]:justify-center [&>*]:items-center md:[&>*]:w-7 md:[&>*]:h-7"
  >
    <a :href="social.facebook" target="_blank" class="hover:bg-blue-700">
      <font-awesome-icon class="text-[10px] md:text-sm" :icon="['fab', 'facebook-f']" />
    </a>
    <a :href="social.tiktok" target="_blank" class="hover:bg-sky-500">
      <font-awesome-icon class="text-[10px] md:text-sm" :icon="['fab', 'tiktok']" />
    </a>
    <a :href="social.instagram" target="_blank" class="hover:bg-yellow-500">
      <font-awesome-icon class="text-[10px] md:text-sm" :icon="['fab', 'instagram']" />
    </a>
    <a :href="social.youtube" target="_blank" class="hover:bg-pink-500">
      <font-awesome-icon class="text-[10px] md:text-sm" :icon="['fab', 'youtube']" />
    </a>
  </ul>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { mapGetters } from 'vuex';

export default {
  name: "SocialMolecule",
  data(){
    return {
      social: {},
    };
  },
  methods:{
    ...mapGetters(["getSocial"]),
    getSocialLink(){
      this.social = this.getSocial();
    }
  },
  components: {
    FontAwesomeIcon,
  },
  created(){
    this.getSocialLink();
  }
};
</script>

<style>
</style>