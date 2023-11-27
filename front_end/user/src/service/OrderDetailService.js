import axios from "axios";
import { DOMAN } from "@/assets/js/config";

const PRODUCT_API_URL = `${DOMAN}/back_end/api/Controllers/OrderDetailController.php`;

class OrderDetailService {

    getAllByOrderId(order_id) {
        let formData = new FormData();
        formData.append('action', 'getAllByOrderId');
        formData.append('order_id', order_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    insertOrderDetail(order_id, listDetail) {
        let formData = new FormData();
        formData.append('action', 'insertOrderDetail');
        formData.append('order_id', order_id);
        formData.append('listDetail', listDetail);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    deleteByCatID(cat_id) {
        let formData = new FormData();
        formData.append('action', 'deleteByCatID');
        formData.append('cat_id', cat_id);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }

}

export default new OrderDetailService();