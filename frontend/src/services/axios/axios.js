//axios configuration
import Axios from "axios";
const instance = Axios.create({
  baseURL: "http://localhost:80/api/",
  responseType: "json",
  timeout: 20000,
});
const axios = instance;
export { axios };
