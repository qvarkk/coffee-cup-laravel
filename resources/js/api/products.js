import API from "@/api/api.js";

export async function getProducts() {
    return await API.get('/api/admin/products')
}

export async function createProduct(product) {
    return await API.post('/api/admin/products', {
            name: product.name,
            description: product.description,
            image: product.image,
            category_id: product.category_id,
            serving: product.serving,
            in_stock: product.in_stock,
            price: product.price
        }
    )
}

export async function updateProduct(product) {
    return await API.patch(`/api/admin/products/${product.id}`, {
        name: product.name,
        description: product.description,
        image: product.image,
        category_id: product.category_id,
        serving: product.serving,
        in_stock: product.in_stock,
        price: product.price
    })
}

export async function deleteProduct(id) {
    return await API.delete(`/api/admin/products/${id}`)
}
