import axios from "axios";
import { AUTHORIZATION, BACKEND_FASTAPI } from "./constant";

const axiosInstance = axios.create({
  baseURL: BACKEND_FASTAPI,
  headers: { Authorization: AUTHORIZATION },
});

export default axiosInstance;
