import API from "@/api/api.js";

export async function getProducts() {
    return await API.get('/api/admin/products')
}

export async function createProduct(name, description, image, category_id, serving, in_stock, price) {
    return await API.post('/api/admin/products', {
            name: name,
            description: description,
            image: image,
            category_id: category_id,
            serving: serving,
            in_stock: in_stock,
            price: price
        }
    )
}

export async function updateProduct(id, name, description, image, category_id, serving, in_stock, price) {
    return await API.patch(`/api/admin/products/${id}`, {
        name: name,
        description: description,
        image: image,
        category_id: category_id,
        serving: serving,
        in_stock: in_stock,
        price: price
    })
}

export async function deleteProduct(id) {
    return await API.delete(`/api/admin/products/${id}`)
}
