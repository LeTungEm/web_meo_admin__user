<template>
  <div
    class="flex justify-between flex-wrap lg:[&>*]:w-[30%] gap-5 px-[5%] py-[10%] lg:py-[3%] bg-[#da8393] text-white"
  >
    <div class="flex justify-center">
      <div>
        <div class="text-xl font-bold uppercase">Sơ lược về Nan Garden</div>
        <hr class="w-[5vw] border-b-4 my-5" />
        <p class="text-lg">
          Nan Garden, là một thiên đàng cho những người yêu mèo và muốn tìm kiếm
          một người bạn bốn chân đáng yêu. Tại cửa hàng này, bạn sẽ tìm thấy một
          sự lựa chọn đa dạng về các loài mèo, từ mèo con mới sinh ra đến mèo
          trưởng thành có kích thước nhỏ.
        </p>
      </div>
    </div>
    <div class="flex justify-center">
      <div>
        <div class="text-xl font-bold uppercase">Chính sách mua bán</div>
        <hr class="w-[5vw] border-b-4 my-5" />
        <ul class="text-lg">
          <li>Chế độ bảo hành.</li>
          <li>Chính sách mua mèo.</li>
          <li>Lưu ý khi mèo về nhà mới.</li>
        </ul>
      </div>
    </div>
    <div class="flex justify-center">
      <div>
        <div class="text-xl font-bold uppercase">Thông tin liên hệ</div>
        <hr class="w-[5vw] border-b-4 my-5" />
        <SocialMolecule class="float-left" />
        <br />
        <br />
        <div class="w-full">
          <a
            :href="`tel:${social.phone}`"
            class="bg-white w-fit flex text-red-600 font-bold items-center justify-center h-9 text-lg border rounded-2xl px-5 py-1"
          >
            0934193740
          </a>
        </div>
      </div>
    </div>
    <div
      class="fixed bottom-0 right-0 left-0 lg:hidden bg-black bg-opacity-80 h-[8vh]"
    >
      <div class="flex justify-around items-center h-full">
        <a class="animation-ring" :href="social.messenger">
          <font-awesome-icon
            class="text-xl p-2 rounded-full bg-blue-500"
            :icon="['fab', 'facebook-messenger']"
          />
        </a>
        <a
          :href="social.zalo"
          class="bg-blue-600 animation-ring flex justify-center items-center font-bold w-9 h-9 text-[10px] border rounded-md"
          >ZALO</a
        >
        <a :href="`tel:${social.phone}`">
          <font-awesome-icon
            class="animation-ring text-2xl text-red-500"
            :icon="['fas', 'phone']"
          />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import SocialMolecule from "./SocialMolecule.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { mapGetters } from "vuex";

export default {
  name: "FooterMolecule",
  data() {
    return {
      social: {},
    };
  },
  components: {
    SocialMolecule,
    FontAwesomeIcon,
  },
  methods: {
    ...mapGetters(["getSocial"]),
    getSocialLink() {
      this.social = this.getSocial();
    },
  },
  created() {
    this.getSocialLink();
  },
};
</script>

<style>
.animation-ring {
  animation: shake 0.5s infinite;
}

@keyframes shake {
  0% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(15deg);
  }
  50% {
    transform: rotate(0deg);
  }
  75% {
    transform: rotate(-15deg);
  }
  100% {
    transform: rotate(0deg);
  }
}
</style>