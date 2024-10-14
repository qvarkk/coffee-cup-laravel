import API from "@/api/api.js";

export async function getCategories() {
    return await API.get('/api/admin/categories')
}

export async function createCategory(name) {
    return await API.post('/api/admin/categories', { name: name })
}

export async function updateCategory(id, name) {
    return await API.patch(`/api/admin/categories/${id}`, { name: name })
}

export async function deleteCategory(id) {
    return await API.delete(`/api/admin/categories/${id}`)
}
