<template>
  <button class="md:whitespace-nowrap bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 duration-200">{{ text }}</button>
</template>

<script>
export default {
    name:"GreenButtonAtom",
    props:{
        text: String,
    }
}
</script>

<style>

</style>