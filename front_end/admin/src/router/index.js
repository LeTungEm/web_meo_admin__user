import { createRouter, createWebHistory } from 'vue-router'
// import { getEmail } from '@/assets/js/quickFunction';
// import AccountsService from '@/service/AccountsService';
import store from '../store/index'
const Login = () => import('../pages/Admin/LoginView.vue');
const Setting = () => import('../pages/Admin/SettingManagerView.vue');
const CatForm = () => import('../components/molecules/CatFormMolecule.vue');
const CatManagermentView = () => import('../pages/Admin/CatManagermentView.vue');
const OrderDetailView = () => import('../pages/Admin/OrderDetailView.vue');
const OrderManagerView = () => import('../pages/Admin/OrderManagerView.vue');


const routes = [
  {
    name: 'loginForm',
    path: '/quan-ly/',
    component: Login,
  },
  {
    name: 'SettingManager',
    path: '/quan-ly/cai-dat',
    meta: { requiresAuth: true },
    component: Setting,
  },
  {
    name: 'catFormMolecule',
    path: '/quan-ly/quan-ly-meo/:slug',
    meta: { requiresAuth: true },
    component: CatForm,
  },
  {
    name: 'catManager',
    path: '/quan-ly/quan-ly-meo',
    meta: { requiresAuth: true },
    component: CatManagermentView,
  },
  {
    name: 'OrderDetail',
    path: '/quan-ly/quan-ly-dat-hang/:orderID',
    meta: { requiresAuth: true },
    component: OrderDetailView,
  },
  {
    name: 'orderManager',
    path: '/quan-ly/quan-ly-dat-hang',
    meta: { requiresAuth: true },
    component: OrderManagerView,
  }
]

// function checkLogin(email, to, next) {
//   AccountsService.isEmailExists(email).then((res) => {
//     if (res.data.message) {
//       if (to.matched.some(route => route.name == 'admin')) {
//         if (res.data.role_id.toString() == '1') {
//           next();
//         } else {
//           next('/');
//         }
//       } else {
//         next();
//       }
//     }
//   });
// }

function checkAuthentication(to, from, next) {
  if (to.matched.some(route => route.meta.requiresAuth)) {
    // Kiểm tra trạng thái đăng nhập từ Vuex store
    // let email = getEmail();
    // if (email != null) {
    //   // checkLogin(email, to, next);
    //   // Nếu đã đăng nhập, cho phép điều hướng tiếp
    // } else {
    //   // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    //   next('/nguoi-dung/dang-nhap');
    // }
    // console.log(store.state.loginStatus = false);
    if (store.getters.getUserLoginStatus) {
      next();
    } else {
      next('/quan-ly');
    }
  } else {
    // Nếu route không yêu cầu đăng nhập, cho phép điều hướng tiếp
    next();
  }
}

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
router.beforeEach(checkAuthentication);


export default router
