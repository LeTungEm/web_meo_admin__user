import axios from "axios";

const PRODUCT_API_URL =
    "https://provinces.open-api.vn/api/?depth=3";

class SiteService {

    getAll() {
        return axios.get(`${PRODUCT_API_URL}`);
    }
}

export default new SiteService();