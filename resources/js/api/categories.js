import API from "@/api/api.js";

export async function getCategories() {
    let res = await API.get('/api/admin/categories')
    return res.data
}

export async function createCategory(name) {
    let res = await API.post('/api/admin/categories', { name: name })
    return res.data
}

export async function updateCategory(id, name) {
    let res = await API.patch(`/api/admin/categories/${id}`, { name: name })
    return res.data
}

export async function deleteCategory(id) {
    let res = await API.delete(`/api/admin/categories/${id}`)
    return res.data
}
