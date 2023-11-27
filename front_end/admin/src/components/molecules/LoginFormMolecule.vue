<template>
  <form
    @submit.prevent="login"
    class="w-full duration-300 p-3 md:p-5 relative z-[2]"
  >
    <div class="flex mb-5">
      <input
        v-model="email"
        @click="() => (emailErr = false)"
        v-bind:class="emailErr ? 'border border-red-700' : ''"
        placeholder="Tên đăng nhập"
        class="border rounded-md w-full outline-0 focus:outline-2 focus:outline-green-700 py-1 lg:py-2 px-2 lg:px-4"
        type="text"
      />
    </div>
    <div class="flex mb-5 relative">
      <input
        autocomplete
        @click="() => (passWErr = false)"
        v-bind:class="passWErr ? 'border border-red-700' : ''"
        v-model="passW"
        placeholder="Mật khẩu"
        class="border rounded-md w-full outline-0 focus:outline-2 focus:outline-green-700 py-1 lg:py-2 px-2 lg:px-4"
        :type="hiddenPassW ? 'password' : 'text'"
      />
      <span
        class="flex justify-center items-center absolute top-0 right-0 bottom-0 mr-4"
      >
        <font-awesome-icon
          @click="changePassWStatus"
          :icon="['fas', `${hiddenPassW ? 'eye-slash' : 'eye'}`]"
        />
      </span>
    </div>
    <div class="flex mb-5">
      <label for="remember">Ghi nhớ đăng nhập</label>&nbsp;
      <input
        id="remember"
        v-model="remember"
        class="border outline-0 focus:outline-2 focus:outline-green-700 py-1 lg:py-2 px-2 lg:px-4"
        type="checkbox"
      />
    </div>
    <GreenButtonAtom class="w-full py-3" :text="'Đăng nhập'" />
  </form>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import GreenButtonAtom from "../atoms/button/GreenButtonAtom.vue";
import AccountsService from "@/service/AccountsService";
import { mapActions } from "vuex";
// import { encodeEmail } from "@/assets/js/quickFunction";

export default {
  name: "LoginFormMolecule",
  data() {
    return {
      hiddenPassW: true,
      email: "",
      emailErr: false,
      passW: "",
      passWErr: false,
      remember: true,
    };
  },

  components: {
    FontAwesomeIcon,
    GreenButtonAtom,
  },

  methods: {
    ...mapActions(["showNotification"]),
    ...mapActions(["setUserLoginStatus"]),

    changePassWStatus() {
      this.hiddenPassW = !this.hiddenPassW;
    },
    isFullData() {
      let result = false;
      if (this.email.trim() && this.passW.trim()) {
        result = true;
      }
      if (this.email.trim() == "") this.emailErr = true;
      if (this.passW.trim() == "") this.passWErr = true;
      return result;
    },
    authenticate() {
      AccountsService.authenticate(this.email, this.passW).then((res) => {
        console.log(res.data);
        if (res.data.message == true) {
          this.setUserLoginStatus(true);
          this.$router.push("/quan-ly/quan-ly-meo");
        }
      });
    },
    login() {
      if (this.isFullData()) {
        this.authenticate();
      } else {
        this.showNotification(["Vui lòng điền đủ thông tin !!!", true]);
      }
    },
  },
};
</script>

<style>
</style>