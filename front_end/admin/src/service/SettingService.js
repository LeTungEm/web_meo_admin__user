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
    updateAbout(about) {
        let formData = new FormData();
        formData.append('action', 'updateAbout');
        formData.append('about', about);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    updateService(service) {
        let formData = new FormData();
        formData.append('action', 'updateService');
        formData.append('service', service);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    updatePolicy(policy) {
        let formData = new FormData();
        formData.append('action', 'updatePolicy');
        formData.append('policy', policy);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    updateExperience(experience) {
        let formData = new FormData();
        formData.append('action', 'updateExperience');
        formData.append('experience', experience);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new SettingService();