import API from "@/api/api.js";

export async function loginUser(email, password) {
    try {
        let res = await API.post('/api/auth/login', { email: email, password: password })
        return res.data
    } catch (error) {
        throw(error)
    }
}
