import axios from "axios";
import { DOMAN } from "@/assets/js/config";

const PRODUCT_API_URL = `${DOMAN}/back_end/api/Controllers/OrderController.php`;

class OrderService {

    getAll() {
        let formData = new FormData();
        formData.append('action', 'getAll');
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    getByID(order_id) {
        let formData = new FormData();
        formData.append('action', 'getByID');
        formData.append('order_id', order_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    setIsView(order_id) {
        let formData = new FormData();
        formData.append('action', 'setIsView');
        formData.append('order_id', order_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    insertOrder(user_name, user_phone, address, total, listCat) {
        let formData = new FormData();
        formData.append('action', 'insertOrder');
        formData.append('user_name', user_name);
        formData.append('user_phone', user_phone);
        formData.append('address', address);
        formData.append('total', total);
        formData.append('listCat', listCat);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new OrderService();