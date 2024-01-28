const token = localStorage.getItem("token");

export async function login(email, password) {
    const response = await fetch(`http://localhost:8000/api/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({email, password})
    });

    const data = await response.json();
    if (data['token']) localStorage.setItem("token", data['access_token']);
    return data;
};

export async function register(name, email, password, password_confirmation) {
    const response = await fetch('http://localhost:8000/api/register', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({name, email, password, password_confirmation})
    });

    const data = await response.json();
    return data;
};

export async function logout() {
    const response = await fetch('http://localhost:8000/api/logout', {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    localStorage.removeItem("token");
    return data;
};

export async function reset(email, password_new) {
    const response = await fetch(`http://localhost:8000/api/reset`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({email, password_new})
    });

    const data = await response.json();
    //
    return data;
};

export async function fetchRealEstates() {
    const response = await fetch('http://localhost:8000/api/realestates', {
        method: "GET",
        headers: {
        },
    });

    const data = await response.json();
    return data;
};

export async function showRealEstate(id) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}`, {
        method: "GET",
        headers: {
        },
    });

    const data = await response.json();
    return data;
};

export async function addRealEstate(name,price,location) {
    const response = await fetch(`http://localhost:8000/api/realestates/${name}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
        },
        body: JSON.stringify({name,price,location})
    });

    const data = await response.json();
    return data;
};

export async function deleteRealEstate(id) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function updateRealEstate(id,price,location) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}/${price}/${location}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function updateApiRealEstate(id) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}/edit/updateapi`, {
        method: "PUT",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchFavorites() {
    const response = await fetch('http://localhost:8000/api/favorites', {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function addFavorite(id) {
    const response = await fetch(`http://localhost:8000/api/favorites/add/${id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function removeFavorite(id) {
    const response = await fetch(`http://localhost:8000/api/favorites/remove/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchProfiles() {
    const response = await fetch('http://localhost:8000/api/suggested-profiles', {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function showProfile(id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/${id}`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function approveProfile(id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/${id}/approve`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function rejectProfile(id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/${id}/reject`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function addProfile(username,user_id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/create/${username}/${user_id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};