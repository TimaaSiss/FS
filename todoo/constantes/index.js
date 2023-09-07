import axios from "axios";

const api = axios.create({
 baseURL:"http://192.168.16.101/todo/apis",
 headers:{
    "Content-Type":"application/json"
 },
});

export default api;