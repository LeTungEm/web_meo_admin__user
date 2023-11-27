<template>
  <PageTemplate v-if="catInfo != null" class="relative">
    <div class="lg:flex gap-10">
      <!-- image -->
      <ImageControlMolecule
        @currentImage="getCurrentImage"
        :listImageLink="catInfo.image"
      />
      <!-- info -->
      <div class="lg:w-1/2">
        <!-- link -->
        <div
          class="text-lg mb-2 inline-block text-gray-400 font-bold capitalize"
        >
          <span> Trang Chủ / Mèo Cảnh </span>
          <span class="text-black"> / {{ catInfo.category_name }} </span>
        </div>
        <!-- Cat Info -->
        <div>
          <h1 class="capitalize text-3xl font-bold">{{ catInfo.name }}</h1>
          <hr class="w-[5vw] border-b-4 my-5" />
          <div class="flex gap-5 flex-wrap">
            <price-text-atom
              class="text-2xl text-[black_!important]"
              :maxPrice="currentPrice"
              :minPrice="currentPrice"
            />
            <PriceTextWLineThroughAtom
              :minPrice="oldPrice"
              :maxPrice="oldPrice"
            />
          </div>
          <table
            class="w-full mt-2 [&>*]:[&>*]:border-[3px] [&>*]:[&>*]:border-dotted [&>*]:[&>*]:p-1"
          >
            <tr>
              <td>Tháng tuổi: {{ catInfo.age }}</td>
              <td>Bố: {{ catInfo.father }}</td>
            </tr>
            <tr>
              <td>
                Giới tính:
                {{
                  catInfo.gender == 0
                    ? "Cái"
                    : catInfo.gender == 1
                    ? "Đực"
                    : "Đực và Cái"
                }}
              </td>
              <td>Mẹ: {{ catInfo.mother }}</td>
            </tr>
            <tr>
              <td>Màu: {{ catInfo.color }}</td>
              <td>Sức khỏe: {{ catInfo.health }}</td>
            </tr>
            <tr>
              <td>Tình trạng: {{ catInfo.status }}</td>
              <td>Vận chuyển: Miễn phí khu vực TP HCM</td>
            </tr>
            <tr>
              <td>Tẩy giun: {{ catInfo.dewormmed }}</td>
              <td>Tiêm phòng: {{ catInfo.vaccination }}</td>
            </tr>
            <tr>
              <td>Nguồn gốc: {{ catInfo.origin }}</td>
              <td>Đặt điểm: {{ catInfo.characteristic }}</td>
            </tr>
          </table>
        </div>
        <!-- Buy button -->
        <div class="flex mt-5">
          <QuantityBarMolecule
            @changeProductQuantity="changeProductQuantity"
            class="w-1/2"
          />
          <div class="flex justify-center items-center w-1/2">
            <span
              :onclick="addToCart"
              class="px-[20%] py-2 rounded-3xl border font-bold text-white text-lg lg:text-xl bg-[#da8393] cursor-pointer active:bg-[#c36b7b]"
              >Đặt hàng</span
            >
          </div>
        </div>
      </div>
    </div>
    <div
      class="flex my-10 [&>*]:flex [&>*]:justify-center [&>*]:items-center [&>*]:[&>*]:flex [&>*]:[&>*]:justify-center [&>*]:[&>*]:items-center [&>*]:[&>*]:rounded-3xl [&>*]:[&>*]:border [&>*]:w-1/2 [&>*]:[&>*]:py-2 [&>*]:[&>*]:w-11/12 lg:[&>*]:[&>*]:w-1/2"
    >
      <div>
        <a :href="social.zalo" class="bg-black text-white font-bold">
          CHAT ZALO
        </a>
      </div>
      <div>
        <a
          :href="`tel:${social.phone}`"
          class="bg-red-500 text-white font-bold"
        >
          GỌI HOTLINE
        </a>
      </div>
    </div>
    <!-- description -->
    <div>
      <DropTextMolecule :defaultStatus="true" :title="'Mô tả'">
        <div class="m-5 md:m-10" v-html="catInfo.description"></div>
      </DropTextMolecule>
      <DropTextMolecule :title="'Đánh giá'">
        <CommentMolecule
          @insertComment="insertComment"
          :catInfo="catInfo"
          :comments="comments"
        />
      </DropTextMolecule>
    </div>
    <div class="flex flex-wrap gap-5 justify-center items-center">
      <div
        v-for="videoItem in listLinkVideo"
        :key="videoItem"
        v-html="videoItem"
        class="[&>*]:max-w-full mt-5 m-auto"
      ></div>
    </div>
  </PageTemplate>
</template>

<script>
import PageTemplate from "@/components/templates/PageTemplate.vue";
import PriceTextAtom from "@/components/atoms/text/PriceTextAtom.vue";
import QuantityBarMolecule from "@/components/molecules/QuantityBarMolecule.vue";
import ImageControlMolecule from "@/components/molecules/ImageControlMolecule.vue";
import DropTextMolecule from "@/components/molecules/DropTextMolecule.vue";
import CommentMolecule from "@/components/molecules/CommentMolecule.vue";
import CatService from "@/service/CatService";
import PriceTextWLineThroughAtom from "@/components/atoms/text/PriceTextWLineThroughAtom.vue";
import { mapActions, mapGetters } from "vuex";
import {
  decodeEmail,
  encodeEmail,
  scrollToTop,
} from "@/assets/js/quickFunction";
import RatingService from "@/service/RatingService";

export default {
  name: "ProductDetail",
  data() {
    return {
      social: {},
      catInfo: {},
      currentPrice: 0,
      oldPrice: 0,
      listLinkVideo: [],
      currentImage: "",
      quantity: 1,
      comments: [],
    };
  },
  components: {
    PageTemplate,
    PriceTextAtom,
    QuantityBarMolecule,
    ImageControlMolecule,
    DropTextMolecule,
    CommentMolecule,
    PriceTextWLineThroughAtom,
  },
  watch: {
    "$route.params.slug": {
      immediate: true,
      handler(newParam, oldParam) {
        if (newParam !== oldParam && oldParam != undefined) {
          this.getCat();
          scrollToTop();
        }
      },
    },
  },
  computed: {
    ...mapGetters(["getSocial"]),
  },
  methods: {
    ...mapActions(["changeCartChangeNumber"]),

    insertComment(comment) {
      this.comments = [comment, ...this.comments];
    },

    getSocialLink() {
      this.social = this.getSocial;
    },

    getCat() {
      let slug = this.$route.params.slug;
      CatService.getBySlug(slug).then((res) => {
        this.catInfo = res.data;
        this.getComments(res.data.cat_id);
        this.getCurrentPrice(res.data);
        this.listLinkVideo = JSON.parse(res.data.video);
      });
    },
    getComments(cat_id) {
      RatingService.getByCatId(cat_id).then((res) => {
        this.comments = res.data;
      });
    },
    changeProductQuantity(quantity) {
      this.quantity = quantity;
    },
    getCurrentPrice(catInfo) {
      if (catInfo.new_price > 0) {
        this.oldPrice = catInfo.price;
        this.currentPrice = catInfo.new_price;
      } else {
        this.currentPrice = catInfo.price;
      }
    },
    addToCart() {
      let cartJson = localStorage.getItem("CCNN");
      let list = [];
      let productItem = this.createCartObject();
      if (cartJson != null) {
        let jsonDecode = decodeEmail(cartJson);
        list = JSON.parse(jsonDecode);
        let productPosition = this.findProductInCart(list, productItem);
        if (productPosition != null) {
          list = this.updateProductQuantityInCart(
            list,
            productPosition,
            productItem
          );
        } else {
          list.push(productItem);
          this.changeCartChangeNumber(1);
        }
      } else {
        list.push(productItem);
        this.changeCartChangeNumber(1);
      }
      let jsonString = JSON.stringify(list);
      let jsonEncode = encodeEmail(jsonString);
      localStorage.setItem("CCNN", jsonEncode);
    },
    findProductInCart(listProduct, newProduct) {
      let listIndex = null;
      listProduct.forEach((product, index) => {
        if (product.cat_id == newProduct.cat_id) {
          listIndex = index;
        }
      });
      return listIndex;
    },
    updateProductQuantityInCart(list, productPosition, productItem) {
      let newList = list;
      newList[productPosition].quantity += productItem.quantity;
      this.changeCartChangeNumber(1);
      return newList;
    },
    createCartObject() {
      return {
        cat_id: this.catInfo.cat_id,
        name: this.catInfo.name,
        slug: this.catInfo.slug,
        category_slug: this.catInfo.category_slug,
        price: this.currentPrice,
        image: this.currentImage,
        quantity: this.quantity,
      };
    },
    getCurrentImage(imageName) {
      this.currentImage = imageName;
    },
  },
  created() {
    this.getCat();
    this.getSocialLink();
  },
};
</script>

<style>
</style>