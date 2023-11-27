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
    getBySlug(slug) {
        let formData = new FormData();
        formData.append('action', 'getBySlug');
        formData.append('slug', slug);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new CatService();