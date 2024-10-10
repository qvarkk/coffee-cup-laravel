import API from "@/api/api.js";

export async function get() {
    try {
        let res = await API.get('/api/admin/categories')
        return res.data
    } catch (error) {
        throw(error)
    }
}
