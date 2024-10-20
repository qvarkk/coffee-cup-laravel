import API from "@/api/api.js";

export async function getCartProducts() {
    return await API.get('/api/cart')
}

export async function addProductToCart(productId) {
    return await API.post(`/api/cart/${productId}`)
}

export async function removeProductFromCart(productId) {
    return await API.delete(`/api/cart/${productId}`)
}

export async function updateCartProduct(productId, quantity) {
    return await API.patch(`/api/cart/${productId}`, { quantity: quantity })
}
