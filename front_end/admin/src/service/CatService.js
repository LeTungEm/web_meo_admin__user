import axios from "axios";
import { DOMAN } from "@/assets/js/config";

const PRODUCT_API_URL = `${DOMAN}/back_end/api/Controllers/CatController.php`;

class CatService {

    getAll() {
        let formData = new FormData();
        formData.append('action', 'getAll');
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    getAllCat() {
        let formData = new FormData();
        formData.append('action', 'getAllCat');
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    searchCat(search) {
        let formData = new FormData();
        formData.append('action', 'searchCat');
        formData.append('search', search);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    changeIsShow(cat_id, isShow) {
        let formData = new FormData();
        formData.append('action', 'changeIsShow');
        formData.append('cat_id', cat_id);
        formData.append('isShow', isShow);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    deleteCat(cat_id, listImage) {
        let formData = new FormData();
        formData.append('action', 'deleteCat');
        formData.append('cat_id', cat_id);
        formData.append('listImage', listImage);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    deleteImage(listImage) {
        let jsonString = JSON.stringify(listImage);
        let formData = new FormData();
        formData.append('action', 'deleteImage');
        formData.append('listImage', jsonString);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    getBySlug(slug) {
        let formData = new FormData();
        formData.append('action', 'getBySlug');
        formData.append('slug', slug);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    insertCat(cat) {
        let formData = new FormData();
        formData.append('action', 'insertCat');
        formData.append('name', cat.name);
        formData.append('slug', cat.slug);
        formData.append('age', cat.age);
        formData.append('price', cat.price);
        formData.append('new_price', cat.new_price);
        formData.append('gender', cat.gender);
        formData.append('color', cat.color);
        formData.append('status', cat.status);
        formData.append('dewormmed', cat.dewormmed);
        formData.append('origin', cat.origin);
        formData.append('father', cat.father);
        formData.append('mother', cat.mother);
        formData.append('health', cat.health);
        formData.append('vaccination', cat.vaccination);
        formData.append('characteristic', cat.characteristic);
        formData.append('description', cat.description);
        formData.append('isShow', cat.isShow);
        formData.append('image', cat.image);
        formData.append('video', cat.video);
        formData.append('category_id', cat.category_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    updateCat(cat) {
        let formData = new FormData();
        formData.append('action', 'updateCat');
        formData.append('name', cat.name);
        formData.append('slug', cat.slug);
        formData.append('age', cat.age);
        formData.append('price', cat.price);
        formData.append('new_price', cat.new_price);
        formData.append('gender', cat.gender);
        formData.append('color', cat.color);
        formData.append('status', cat.status);
        formData.append('dewormmed', cat.dewormmed);
        formData.append('origin', cat.origin);
        formData.append('father', cat.father);
        formData.append('mother', cat.mother);
        formData.append('health', cat.health);
        formData.append('vaccination', cat.vaccination);
        formData.append('characteristic', cat.characteristic);
        formData.append('description', cat.description);
        formData.append('isShow', cat.isShow);
        formData.append('image', cat.image);
        formData.append('video', cat.video);
        formData.append('category_id', cat.category_id);
        formData.append('cat_id', cat.cat_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new CatService();