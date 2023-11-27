import { DOMAN } from "@/assets/js/config";
import axios from "axios";

const PRODUCT_API_URL =
  `${DOMAN}/back_end/api/Controllers/UploadFileController.php`;

class UploadFileService {

  uploadImage(files = [], fileNames = []) {
    let formData = new FormData();
    files.forEach(file => {
      formData.append("files[]", file);
    })
    fileNames.forEach(fileName => {
      formData.append("names[]", fileName);
    })
    return axios.post(`${PRODUCT_API_URL}`,
      formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    )
  }
}

export default new UploadFileService();