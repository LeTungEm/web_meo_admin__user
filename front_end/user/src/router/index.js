import { createRouter, createWebHistory } from 'vue-router'
// import { getEmail } from '@/assets/js/quickFunction';
// import AccountsService from '@/service/AccountsService';
const Home = () => import('../pages/User/HomeView.vue');
const ProductDetail = () => import('../pages/User/ProductDetail.vue');
const PolicyView = () => import('../pages/User/PolicyView.vue');


const routes = [
  {
    name: 'home',
    path: '/',
    component: Home,
  },
  {
    name: 'productDetail',
    path: '/meo-canh/:categorySlug/:slug',
    component: ProductDetail,
  },
  {
    name: 'shopByType',
    path: '/meo-canh/:categorySlug',
    component: Home,
  },
  {
    name: 'shop',
    path: '/meo-canh',
    component: Home,
  },
  {
    name: 'policy',
    path: '/chinh-sach/:pageName',
    component: PolicyView,
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
// router.beforeEach();


export default router
