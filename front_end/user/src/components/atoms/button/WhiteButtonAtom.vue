<template>
    <button class="bg-white border-2 border-green-700 md:whitespace-nowrap text-green-700 rounded-sm font-bold duration-200 hover:bg-green-700 hover:text-white">{{ text }}</button>
  </template>
  
  <script>
  export default {
      name:"WhiteButtonAtom",
      props:{
          text: String,
      }
  }
  </script>
  
  <style>
  
  </style>