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
