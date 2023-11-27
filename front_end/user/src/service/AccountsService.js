import { DOMAN } from "@/assets/js/config";
import { encodeEmail } from "@/assets/js/quickFunction";
import axios from "axios";

const PRODUCT_API_URL = `${DOMAN}/back_end/api/Controllers/AccountsController.php`;

class AccountsService {

    insert(user_name, pass) {
        let formData = new FormData();
        let encodePass = encodeEmail(pass);
        formData.append('action', 'insertAccount');
        formData.append('user_name', user_name);
        formData.append('pass', encodePass);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    update(pass) {
        let formData = new FormData();
        let encodePass = encodeEmail(pass);
        formData.append('action', 'updateAccount');
        formData.append('pass', encodePass);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
    authenticate(email, password) {
        let formData = new FormData();
        let encodePass = encodeEmail(password);
        formData.append('action', 'authenticate');
        formData.append('email', email);
        formData.append('password', encodePass);
        return axios.post(`${PRODUCT_API_URL}`, formData);
    }
}

export default new AccountsService();