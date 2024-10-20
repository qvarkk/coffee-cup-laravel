import API from "@/api/api.js";

export async function getFavoritedProducts() {
    return await API.get('/api/favorites')
}

export async function addFavoritedProduct(productId) {
    return await API.post(`/api/favorites/${productId}`)
}

export async function removeFavoritedProduct(productId) {
    return await API.delete(`/api/favorites/${productId}`)
}
