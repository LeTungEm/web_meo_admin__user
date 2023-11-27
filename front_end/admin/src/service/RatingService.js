import axios from "axios";
import { DOMAN } from "@/assets/js/config";

const PRODUCT_API_URL = `${DOMAN}/back_end/api/Controllers/RatingController.php`;

class RatingService {

    getByCatId(cat_id) {
        let formData = new FormData();
        formData.append('action', 'getByCatId');
        formData.append('cat_id', cat_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    insertRating(comment, user_name, user_phone, star_number, cat_id) {
        let formData = new FormData();
        formData.append('action', 'insertRating');
        formData.append('comment', comment);
        formData.append('user_name', user_name);
        formData.append('user_phone', user_phone);
        formData.append('star_number', star_number);
        formData.append('cat_id', cat_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    deleteByCatID(cat_id) {
        let formData = new FormData();
        formData.append('action', 'deleteByCatID');
        formData.append('cat_id', cat_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new RatingService();