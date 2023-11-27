<template>
  <tr class="[&>*]:whitespace-nowrap xl:[&>*]:text-base bg-white">
    <th v-for="column in columns" :key="column" scope="col" class="px-6 py-3">
      {{ column }}
    </th>
    <th scope="col" class="px-6 py-3">
      <span class="sr-only">Edit</span>
    </th>
  </tr>
</template>

<script>
export default {
  name: "TableColumnMolecule",
  props: {
    columns: Array,
  },
};
</script>

<style>
</style>