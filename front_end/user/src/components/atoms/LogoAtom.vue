<template>
  <div class="flex justify-center items-center">
    <div :onclick="comeToHome" class="text-2xl whitespace-nowrap sm:text-5xl font-bold cursor-pointer">Nan Garden</div>
  </div>
</template>

<script>
export default {
  name: "LogoAtom",
  methods:{
    comeToHome(){
      this.$router.push('/');
    },
    fotmatImage(){
      window.addEventListener(scroll, ()=>{
        
      })
    }
  }
};
</script>

<style>
</style>