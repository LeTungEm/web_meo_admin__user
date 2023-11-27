import axios from "axios";
import { DOMAN } from "@/assets/js/config";

const PRODUCT_API_URL = `${DOMAN}/back_end/api/Controllers/SettingController.php`;

class SettingService {

    getAll() {
        let formData = new FormData();
        formData.append('action', 'getAll');
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    
    updateClientRespons(client_respons) {
        let formData = new FormData();
        formData.append('action', 'updateClientRespons');
        formData.append('client_respons', client_respons);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    updateBanner(banner) {
        let formData = new FormData();
        formData.append('action', 'updateBanner');
        formData.append('banner', banner);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new SettingService();