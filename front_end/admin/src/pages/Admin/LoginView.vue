<template>
    <div class="flex justify-center items-center w-full h-full px-5 py-5 md:py-10">
      <div class="flex flex-col justify-center w-full md:w-2/3">
        <LogoAtom class="inline-block text-4xl lg:text-6xl mx-auto my-5 xl:my-10" />
        <div class="flex relative w-full overflow-hidden bg-gray-100 border rounded-sm xl:w-1/2 mx-auto">
          <LoginFormMolecule />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import LogoAtom from "@/components/atoms/LogoAtom.vue";
  import LoginFormMolecule from '@/components/molecules/LoginFormMolecule.vue';
  export default {
    name: "LoginView",
    components: { LogoAtom, LoginFormMolecule },
  };
  </script>
  
  <style>
  </style>