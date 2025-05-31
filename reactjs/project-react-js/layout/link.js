const url = "http://localhost:8000/api";
let token = "dChhtnSH8lBF107jJ4P2XFlosOopCc7cvFGPpBiR";

export const link = axios.create({
    baseURL: url,
    headers: {
        'Authorization': `Bearer ${token}`
    }
});
