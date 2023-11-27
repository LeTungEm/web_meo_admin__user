<template>
  <div>
    <div>
      <SubNavBarOrganism />
      <NavBarOrganism />
      <router-view />
      <footer-molecule />
    </div>
    <NotificationAtom
      :isWarning="getIsNotificationWarning"
      :status="getNotificationStatus"
      :text="getNotificationMessage"
    />
  </div>
</template>

<script>
import SubNavBarOrganism from "./components/organisms/SubNavBarOrganism.vue";
import NavBarOrganism from "./components/organisms/NavBarOrganism.vue";
import NotificationAtom from "./components/atoms/NotificationAtom.vue";
import { mapActions, mapGetters } from "vuex";
import FooterMolecule from "./components/molecules/FooterMolecule.vue";
export default {
  name: "App",
  components: {
    NavBarOrganism,
    SubNavBarOrganism,
    NotificationAtom,
    FooterMolecule,
  },
  computed: {
    ...mapGetters(["getNotificationStatus"]),
    ...mapGetters(["getNotificationMessage"]),
    ...mapGetters(["getIsNotificationWarning"]),
  },
  methods: {
    ...mapActions(["changeSocial"]),

    setSocial() {
      this.changeSocial({
        facebook: "https://www.facebook.com/NANGardenCattery?mibextid=ZbWKwL",
        tiktok: "https://www.tiktok.com/@nangarden?_t=8gD6PUDfwP3&_r=1",
        instagram: "https://instagram.com/nangarden413?igshid=OGQ5ZDc2ODk2ZA==",
        youtube: "https://youtube.com/@nangarden?si=qZ0f89XiDYj2UP7Z",
        phone: "0934193740",
        zalo: "https://zalo.me/84934193740",
        messenger: "https://m.me/ainhan413",
      });
    },
  },
  created() {
    this.setSocial();
  },
};
</script>

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

* {
  font-family: Playfair Display, serif;
}
</style>




