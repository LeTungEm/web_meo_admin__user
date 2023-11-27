<template>
  <div>
    <div class="flex justify-between text-2xl">
      <WhiteButtonAtom
        :onclick="toCreateCatForm"
        class="py-2 px-5 text-lg mb-1"
        :text="'Thêm mới'"
      />
      <div>Sắp xếp</div>
    </div>
    <CatsTableOrganism />
  </div>
</template>
  
  <script>
// import PlantsService from "@/service/PlantsService";
import CatsTableOrganism from "@/components/organisms/CatsTableOrganism.vue";
import WhiteButtonAtom from "@/components/atoms/button/WhiteButtonAtom.vue";
// import { mapActions } from "vuex";

export default {
  components: { CatsTableOrganism, WhiteButtonAtom },
  name: "CatManagermentView",
  data() {
    return {
      cats: [],
    };
  },
  methods: {
    // ...mapActions(["showNotification"]),
    deleteProduct() {
    //   this.plants.splice(index, 1);
    },
    changePlantStatus() {
    //   this.plants[plantIndex].status = status;
    //   this.showNotification([
    //     this.plants[plantIndex].name + " đã được " + (status == 1 ? "hiển thị." : "ẩn đi."),
    //     false,
    //   ]);
    },
    // getAllPlants() {
    //   PlantsService.getAll().then((res) => {
    //     this.plants = res.data;
    //   });
    // },
    toCreateCatForm() {
      this.$router.push("/quan-ly/quan-ly-meo/0");
    },
  },
  created() {
    // this.getAllPlants();
  },
};
</script>
  
  <style>
</style>