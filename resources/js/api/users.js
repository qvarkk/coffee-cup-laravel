import API from "@/api/api.js";

export async function loginUser(email, password) {
    return await API.post('/api/auth/login', {email: email, password: password})
}

export async function registerUser(email, name, password, password_confirmation) {
    return await API.post('api/auth/login', {
        email: email,
        name: name,
        password: password,
        password_confirmation: password_confirmation
    })
}

export async function logoutUser() {
    let res = await API.post('api/auth/logout')
    localStorage.removeItem('access_token')
    return res
}

export async function getCurrentUser() {
    return await API.post('api/auth/me')
}

export async function getUser() {
    return await API.get('api/admin/users')
}

export async function createUser(user) {
    return await API.post('api/admin/users', {
        name: user.name,
        email: user.email,
        role: user.role
    })
}

export async function updateUser(user) {
    return await API.patch(`api/admin/users/${user.id}`, {
        user_id: user.id,
        name: user.name,
        email: user.email,
        role: user.role
    })
}

export async function deleteUser(id) {
    return await API.delete(`api/admin/users/${id}`)
}
