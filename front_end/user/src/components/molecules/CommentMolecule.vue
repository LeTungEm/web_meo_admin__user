<template>
  <div>
    <!-- form comment -->
    <div class="flex justify-center">
      <div class="p-5 border-2 border-[#da8393] rounded-md">
        <div class="text-xl lg:text-2xl font-bold">Thêm đánh giá</div>
        <div class="text-lg font-bold mt-5">Đánh giá của bạn *</div>
        <!-- rate -->
        <div
          class="flex gap-5 [&>*]:[&>*]:text-[12px] lg:[&>*]:[&>*]:text-lg mt-5 [&>*]:hover:[&>*]:text-yellow-400 [&>*]:cursor-pointer"
        >
          <!-- One star -->
          <div
            :onclick="() => changeStar(1)"
            v-bind:class="starNumber == 1 ? '[&>*]:text-yellow-400' : ''"
          >
            <font-awesome-icon :icon="['fas', 'star']" />
          </div>
          <!-- Two star -->
          <div
            :onclick="() => changeStar(2)"
            v-bind:class="starNumber == 2 ? '[&>*]:text-yellow-400' : ''"
          >
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
          </div>
          <!-- Three star -->
          <div
            :onclick="() => changeStar(3)"
            v-bind:class="starNumber == 3 ? '[&>*]:text-yellow-400' : ''"
          >
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
          </div>
          <!-- Four star -->
          <div
            :onclick="() => changeStar(4)"
            v-bind:class="starNumber == 4 ? '[&>*]:text-yellow-400' : ''"
          >
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
          </div>
          <!-- Five star -->
          <div
            :onclick="() => changeStar(5)"
            v-bind:class="starNumber == 5 ? '[&>*]:text-yellow-400' : ''"
          >
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
            <font-awesome-icon :icon="['fas', 'star']" />
          </div>
        </div>
        <div class="text-lg font-bold mt-5">Nhận xét của bạn *</div>
        <textarea
          v-model="comment"
          rows="3"
          class="border w-full p-1 rounded-sm"
        />
        <div class="w-full [&>*]:w-1/2 flex gap-5 justify-between mt-5">
          <div>
            <div class="text-lg font-bold">Tên *</div>
            <input
              v-model="name"
              class="p-1 border rounded-sm w-full"
              type="text"
            />
          </div>
          <div>
            <div class="text-lg font-bold">Số điện thoại *</div>
            <input
              v-model="phone"
              class="p-1 border rounded-sm w-full"
              type="text"
            />
          </div>
        </div>
        <div class="flex justify-center items-center gap-5 mt-5">
          <input
            v-model="remember"
            id="saveCmtInfo"
            class="w-5 h-5"
            type="checkbox"
          />
          <label for="saveCmtInfo" class="text-lg font-bold"
            >Lưu tên và số điện thoại của tôi vào trình duyệt này cho lần bình
            luận kế tiếp.</label
          >
        </div>
        <div
          :onclick="submitForm"
          class="mt-5 text-center font-bold py-2 px-5 rounded-md border text-white bg-[#da8393]"
        >
          ĐÁNH GIÁ
        </div>
      </div>
    </div>

    <div class="mt-5">
      <div v-for="comment in comments" :key="comment" class="flex gap-5 mb-5">
        <div
          class="w-16 h-16 rounded-full border-2 flex justify-center items-center"
        >
          <font-awesome-icon class="text-2xl" :icon="['fas', 'user']" />
        </div>
        <div>
          <span class="font-bold">{{ comment.user_name }}</span
          ><br />
          <span>{{ comment.comment }}</span
          ><br />
          <span class="italic text-gray-500">{{ comment.create_date }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { decodeEmail, encodeEmail } from "@/assets/js/quickFunction";
import RatingService from "@/service/RatingService";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { mapActions } from "vuex";

export default {
  name: "CommentMolecule",
  data() {
    return {
      starNumber: 0,
      comment: "",
      name: "",
      phone: "",
      remember: true,
      listComment: [],
    };
  },
  props: {
    comments: Array,
    catInfo: Object,
  },
  methods: {
    ...mapActions(["showNotification"]),
    changeStar(num) {
      this.starNumber = num;
    },
    submitForm() {
      if (this.isFullData() && this.isPhoneCorrect() && this.isRateNotNull()) {
        this.saveData();
        this.setRemember();
      }
    },
    saveData() {
      RatingService.insertRating(
        this.comment,
        this.name,
        this.phone,
        this.starNumber,
        this.catInfo.cat_id
      ).then(() => {
        this.$emit("insertComment", {
          user_name: this.name,
          user_phone: this.phone,
          comment: this.comment,
          star_number: this.starNumber,
        });
        this.comment = "";
        this.starNumber = 0;
      });
    },
    isRateNotNull() {
      if (this.starNumber == 0) {
        this.showNotification(["Vui lòng chọn đánh giá của bạn !!!", true]);
        return false;
      }
      return true;
    },
    isPhoneCorrect() {
      if (this.phone.length != 10) {
        this.showNotification(["Số điện thoại chưa chính xác !!!", true]);
        return false;
      }
      return true;
    },
    isFullData() {
      if (
        this.name.trim() == "" ||
        this.phone.trim() == "" ||
        this.comment.trim() == ""
      ) {
        this.showNotification(["Vui lòng điền đủ thông tin !!!", true]);
        return false;
      }
      return true;
    },
    setRemember() {
      let encodeInfo;
      if (this.remember) {
        encodeInfo = JSON.stringify({
          name: this.name,
          phone: this.phone,
        });
        localStorage.setItem("USIO", encodeEmail(encodeInfo));
      }
    },
    getRemember() {
      let userInfo = localStorage.getItem("USIO");
      if (userInfo) {
        let decodeUser = decodeEmail(userInfo);
        let userObject = JSON.parse(decodeUser);
        if (Object.keys(userObject).length > 0) {
          this.name = userObject.name;
          this.phone = userObject.phone;
        }
      }
    },
  },
  components: {
    FontAwesomeIcon,
  },
  created() {
    this.listComment = this.comments;
    this.getRemember();
  },
};
</script>

<style>
</style>