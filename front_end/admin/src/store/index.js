import { createStore } from 'vuex'

const store = createStore({
    state() {
        return {
            specialCategoryId: '',
            cartChangeNumber: 0,
            search: null,
            loginStatus: false,
            notificationMessage: "",
            notificationStatus: false,
            isNotificationWarning: false,
            selectedCategory: null,
            categoryName: null,
            checkoutFormStatus: false,
            social: {
                facebook: '',
                tiktok: '',
                instagram: '',
                youtube: '',
                phone: '',
                zalo: '',
                messenger: ''
            },
        };
    },
    getters: {
        getSocial(state) {
            return state.social;
        },
        getCartChangeNumber(state) {
            return state.cartChangeNumber;
        },
        getSelectedCategory(state) {
            return state.selectedCategory;
        },
        getCategoryName(state) {
            return state.categoryName;
        },
        getSearch(state) {
            return state.search;
        },
        getSpecialCategoryId(state) {
            return state.specialCategoryId;
        },
        getUserLoginStatus(state) {
            return state.loginStatus;
        },
        getNotificationStatus(state) {
            return state.notificationStatus;
        },
        getNotificationMessage(state) {
            return state.notificationMessage;
        },
        getIsNotificationWarning(state) {
            return state.isNotificationWarning;
        },
        getCheckoutFormStatus(state) {
            return state.checkoutFormStatus;
        },

    },
    mutations: {
        changeSocial(state, social) {
            state.social = social;
        },
        changeCartChangeNumber(state, cartChangeNumber) {
            state.cartChangeNumber += cartChangeNumber;
        },
        changeSelectedCategory(state, selectedCategory) {
            state.selectedCategory = selectedCategory;
        },
        changeCategoryName(state, categoryName) {
            state.categoryName = categoryName;
        },
        changeSearch(state, search) {
            state.search = search;
        },
        changeSpecialCategoryId(state, specialCategoryId) {
            state.specialCategoryId = specialCategoryId;
        },
        setUserLoginStatus(state, loginStatus) {
            state.loginStatus = loginStatus;
        },
        showNotification(state, notificationMessage) {
            state.notificationMessage = notificationMessage[0];
            state.isNotificationWarning = notificationMessage[1];
            state.notificationStatus = !state.notificationStatus;
        },
        getCheckoutFormStatus(state, checkoutFormStatus) {
            state.checkoutFormStatus = checkoutFormStatus;
        },
    },
    actions: {
        changeSocial({ commit }, social) {
            commit('changeSocial', social);
        },
        changeCartChangeNumber({ commit }, cartChangeNumber) {
            commit('changeCartChangeNumber', cartChangeNumber);
        },
        changeSelectedCategory({ commit }, selectedCategory) {
            commit('changeSelectedCategory', selectedCategory);
        },
        changeCategoryName({ commit }, categoryName) {
            commit('changeCategoryName', categoryName);
        },
        changeSearch({ commit }, search) {
            commit('changeSearch', search);
        },
        changeSpecialCategoryId({ commit }, specialCategoryId) {
            commit('changeSpecialCategoryId', specialCategoryId);
        },
        setUserLoginStatus({ commit }, loginStatus) {
            commit('setUserLoginStatus', loginStatus);
        },
        showNotification({ commit }, notificationMessage = []) {
            commit('showNotification', notificationMessage);
        },
        getCheckoutFormStatus({ commit }, checkoutFormStatus) {
            commit('getCheckoutFormStatus', checkoutFormStatus);
        },
    }
})

export default store